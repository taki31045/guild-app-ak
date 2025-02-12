@extends('admins.dashboard')

@section('title', 'Admin: Transaction')

@section('page-content')
    @foreach ($projects as $project)
    <div class="job-container">
        <div class="job-header">Project No.{{ $project->id }}</div>
        <div class="info">
            <span><strong>Company Name:</strong> {{ $project->company->user->username }}</span>
            <span><strong>Freelancer Name:</strong> {{ $project->application?->freelancer?->user?->name ?? 'N/A' }}</span>
            <span class="mt-3"><strong>Transaction History</strong></span>
        </div>
        
        @if($project->transactions->isEmpty())
            <p>No transactions available for this project.</p>
        @else
            <table class="transaction-table">
                <thead>
                <tr>
                    <th>DATE</th>
                    <th>INCOME ($)<br>from Company (10% Fee included)</th>
                    <th>EXPENSE ($)<br>to Freelancer</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($project->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($transaction->payee_id == $adminId)
                            {{ $transaction->amount + ($transaction->fee ?? 0) }}
                            @endif
                        </td>
                        <td>
                            @if ($transaction->payer_id == $adminId)
                            {{ $transaction->amount }}
                            @endif
                        </td>
                    </tr>
                    @endforeach 
                        
                </tbody>
            </table>
        @endif
    </div>
    @endforeach

    <!-- Total Balance -->
    <div class="card mt-4">
        <div class="card-body d-flex justify-content-between align-items-center">  
            <h5 class="card-title m-0">Admin Balance</h5>
            <p class="card-text fs-4 fw-bold m-0">${{ number_format($adminBalance, 2) }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $projects->links('pagination::bootstrap-4') }}
    </div>
@endsection