@extends('admins.dashboard')

@section('title', 'Admin: Project')

@section('page-content')
<div class="container">
    <div class="row card align-items-center pt-2 ms-5">
        <div class="col-12">
            @foreach ($all_projects as $project)
            <div class="card my-3">
                <table class="table table-borderless align-middle text-secondary my-2" style="line-height: 1;">
                    <tr>
                        <td style="width: 20px"></td>
                        <td rowspan="3" style="width: 100px;" class="bg-secondary text-center">{{ $project->formatted_deadline }}</td>
                        <td colspan="2" class="ps-4">
                            @if ($project->trashed())  
                                {{ \Str::limit($project->title, 60) }} 
                            @else
                            <a href="{{ route('company.project.detail', $project->id) }}" class="text-decoration-none text-dark" title="{{ $project->title }}">
                            {{ \Str::limit($project->title, 60) }} 
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20px"></td>
                        <td colspan="2" class="ps-4">
                            @if ($project->trashed())
                            {{ $project->company->user->username }}
                            @else
                            <a href="{{ route('company.profile.profile',$project->company->user->id) }}" class="text-decoration-none text-dark">
                                {{ $project->company->user->username }}
                                </a>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 20px"></td>
                        <td class="ps-4">
                            ${{ $project->reward_amount }}
                            <span class="ps-3">
                                @for ($i = 1; $i <= $project->required_rank; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            @if ($project->trashed())
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
                                    @if ($project->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-project-{{ $project->id }}">
                                            <i class="fa-solid fa-unlock"></i> Activate ID:{{ $project->id }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-project-{{ $project->id }}">
                                            <i class="fa-solid fa-lock"></i> Deactivate ID:{{ $project->id }}
                                        </button>
                                    @endif                                    
                                </div>
                            </div>
                            {{-- Include the modal here --}}
                            @include('admins.modal.project') 
                        </td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $all_projects->links('pagination::bootstrap-4') }}
</div>
@endsection