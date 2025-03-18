@extends('admins.dashboard')

@section('title', 'Admin: Company')

@section('page-content')
<div class="container">
    <div class="ms-5">
        <div class="col-12 card align-items-center pt-4">
            <div class="card-body">
            @foreach ($all_companies as $company)
            <div class="col-12 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td rowspan="4" class="mx-5">
                            @if ($company->user->avatar)
                                <img src="{{ $company->user->avatar }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-circle-user icon-lg"></i>
                            @endif
                        </td>
                        <td style="width: 150px;">Company name:</td>
                        <td>
                            @if ($company->trashed())
                                {{ $company->user->username }}
                            @else
                            <a href="{{ route('company.profile.profile',$company->user->id) }}" class="text-decoration-none text-dark">
                                {{ $company->user->username }} </a>
                                
                            @endif
                            </td>
                        <td>
                        @if ($company->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                        @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                            
                                <div class="dropdown-menu">
                                    @if ($company->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $company->user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $company->user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $company->user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $company->user->name }}
                                        </button>
                                    @endif                                    
                                </div>
                            </div>
                            {{-- Include the modal here --}} 
                            @include('admins.modal.company') 
                        </td>    
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Email:</td>
                        <td>{{ $company->user->email }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Website:</td>
                        <td>{{ $company->website }}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $all_companies->links('pagination::bootstrap-4') }}
</div>
@endsection