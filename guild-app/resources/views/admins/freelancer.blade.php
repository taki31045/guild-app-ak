@extends('admins.dashboard')

@section('title', 'Admin: Freelancer')

@section('page-content')
<div class="container">
    <div class="ms-5">
        <div class="col-12 card border-secondary align-items-center pt-4">
            <div class="card-body">
            @foreach ($all_freelancers as $freelancer)
            <div class="col-12 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td rowspan="4"  style="width: 150px;"><i class="fa-solid fa-circle-user icon-lg"></i></td>
                        <td style="width: 100px;">Name</td>
                        <td style="width: 200px;">{{$freelancer->user->name }}</td>
                        <td>
                        @if ($freelancer->trashed())
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
                                    @if ($freelancer->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $freelancer->user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $freelancer->user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $freelancer->user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $freelancer->user->name }}
                                        </button>
                                    @endif                                    
                                </div>
                            </div>
                            {{-- Include the modal here --}} 
                            @include('admins.modal.freelancer') 
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Email</td>
                        <td style="width: 200px;">{{$freelancer->user->email }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Rank:</td>
                        <td style="width: 200px;">
                            @for ($i = 1; $i <= $freelancer->rank; $i++)
                            <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" style="width: 50px;">
                            @foreach ($freelancer->skills as $skill)
                            <button class="badge text-bg-secondary">{{ $skill->name }}</button>&nbsp;
                            @endforeach                            
                        </td>
                    </tr>            
                </table>
            </div>
            @endforeach
        </div>
        
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $all_freelancers->links('pagination::bootstrap-4') }}
</div>

@endsection