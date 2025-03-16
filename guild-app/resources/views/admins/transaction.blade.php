@extends('admins.dashboard')

@section('title', 'Admin: Transaction')

@section('page-content')
    @foreach ($projects as $project)
    <div class="job-container">
        <div class="job-header">Project No.{{ $project->id }} : {{ $project->title }}</div>
        <div class="info">
            <span><strong>Company Name:</strong> {{ $project->company->user->username }}</span>
            <span><strong>Freelancer Name:</strong>  
                {{ $project->freelancerPayee?->username ?? 'N/A' }}
            </span>
            <span class="mt-4 fw-bold fs-5"><strong>Transaction History</strong></span>
        </div>
        
            <table class="transaction-table">
                <thead>
                <tr>
                    <th>DATE</th>
                    <th>TRANSACTION ($)</th>
                    <th>TYPE</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($project->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($transaction->payee_id == $adminId)
                            {{ $transaction->amount + $transaction->fee }}
                            @else
                            {{ -($transaction->amount + $transaction->fee) }}
                            @endif
                        </td>
                        <td>{{ $transaction->type }}</td>
                    </tr>
                    @endforeach 
                        
                </tbody>
            </table>
    </div>
    @endforeach

    <!-- Total Balance -->
    <div class="card mt-4">
        <div class="card-body row justify-content-center align-items-center">
            <div class="col-6 text-center">
                <p class="card-text fs-5 m-0">Total Fee Revenue: <strong> ${{ number_format($totalFeeRevenue, 2) }}</strong></p>
                <p class="card-text fs-5 m-0">Escrow Balance: <strong> ${{ number_format($escrowBalance, 2) }}</strong></p>
            </div>
            <div class="col-6 d-flex justify-content-center">  
                <p class="fs-4 m-0">Balance:</p>
                <p class="card-text fs-4 fw-bold m-0">${{ number_format($balance, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $projects->links('pagination::bootstrap-4') }}
    </div>
@endsection