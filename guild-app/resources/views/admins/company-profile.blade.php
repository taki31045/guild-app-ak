@extends('layouts.admin')

@section('title', 'Admin company-profile')

@section('content')
<link href="{{ asset('css/admins/company-profile.css') }}" rel="stylesheet">

<div class="profile-container row justify-content-center align-items-center">
    <div class="col-2 text-center">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
        @else
            <i class="fa-solid fa-circle-user icon-lg"></i>
        @endif
    </div>
    <div class="profile-container-1 col-4">        
        <div class="profile-1 card rounded ps-3 py-3">
            <div class="header fw-bold">Company profile</div>
                <table class="company-profile">
                    <tbody>
                        <tr>
                            <td>Company name</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>website</td>
                            <td>{{ $user->company->website }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        
    <div class="profile-container-2 row justify-content-center">
            <div class="col-6">
                <div class="card rounded my-4 p-3">
                        <table class="profile-2">
                            <tbody>
                            <tr>
                                <td>Representative:</td>
                                <td>{{ $company->representative }}</td>
                            </tr>
                            <tr>
                                <td>Number of Employees:</td>
                                <td>{{ $company->employee }}</td>
                            </tr>
                            <tr>
                                <td>Capital($):</td>
                                <td>{{ $company->capital }}</td>
                            </tr>
                            <tr>
                                <td>Annual Sales($):</td>
                                <td>{{ $company->annualsales }}</td>
                            </tr>
                            <tr>
                                <td>Address(Prefecture):</td>
                                <td>{{ $company->address }}</td>
                            </tr>
                            <tr>
                                <td>Business Description:</td>
                                <td>{{ $company->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">  
        <div class="card-body">
            <!-- Contents of Tab -->
            <div class="project-container">
                <input type="radio" id="project-history" name="tab-group" checked>
                <input type="radio" id="payment-history" name="tab-group">
                <div class="tab-menu">
                    <label for="project-history" class="tab-label">Project History</label>
                    <label for="payment-history" class="tab-label">Payment History</label>
                </div>
                <div class="tab-content">
                    <!-- Project History -->
                    <div class="tab-pane project-history">
                    @foreach ($projects as $project)
                        <div class="project-history-contents w-100">
                            <div class="project-date">{{ $project->formatted_deadline }}</div>
                            <div class="project-details">
                                <h3 class="h5 m-0"><a href="{{ route('freelancer.project-details', $project->id) }}" class="text-decoration-none text-dark" title="{{ $project->title }}">
                                    {{ \Str::limit($project->title, 60) }} 
                                    </a></h3>
                                <p class="fw-bold m-0">{{ $project->company->user->username }}</p>
                                <p class="m-0">${{ $project->reward_amount }}</p>
                                <p>
                                    @for ($i = 1; $i <= $project->required_rank; $i++)
                                    <i class="fa-solid fa-star text-warning"></i>
                                    @endfor
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                            
                    <!-- Payment History -->
                    <div class="tab-pane payment-history">
                        <table class="table table-bordered w-75">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>PROJECT ID: </th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    <td>{{ $transaction->project->id }}</td>
                                    <td>{{ $transaction->amount  + ($transaction->fee ?? 0) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
