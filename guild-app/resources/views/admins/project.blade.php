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
                            <a href="{{ route('company.project.detail', $project->id) }}" class="text-decoration-none text-dark" title="{{ $project->title }}">
                            {{ \Str::limit($project->title, 60) }} 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20px"></td>
                        <td colspan="2" class="ps-4">
                            <a href="{{ route('company.profile.profile',$project->company->user->id) }}" class="text-decoration-none text-dark">
                                {{ $project->company->user->username }}
                                </a>
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