@extends('layouts.user-app')

@section('title', 'Project List')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/project-list.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/favorite-project.js')}}"></script>
@endsection

@section('content')
    <div class="row  justify-content-center">
        {{-- Filter --}}
        <div class="col-3">
            <div class="filter-container">
                <h3>Filter Projects</h3>
                <form  action="{{route('freelancer.project.index')}}" method="GET" class="filter-form">
                    <!-- Keyword Searching -->
                    <input type="text" name="keyword" placeholder="keyword" value="{{ request('keyword') }}">

                    <!-- Required Rank -->
                    <label for="rank">Rank</label>
                    <select name="required_rank">
                        <option value="">Select Rank</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('required_rank') == $i ? 'selected' : '' }}>
                                {{ str_repeat('★', $i) }}
                            </option>
                        @endfor
                    </select>

                    <!-- Skill -->
                    <label for="rank">Skill</label>
                    <select name="skills[]" class="select-skill" multiple>
                        <option value="" hidden>Select Skills</option>
                        @foreach($all_skills as $skill)
                            <option value="{{ $skill->id }}" {{ in_array($skill->id, request('skills', [])) ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Reward Amount -->
                    <label for="rank">Reward Amount</label>
                    <input type="number" name="min_reward" placeholder="Min Reward" value="{{ request('min_reward') }}">
                    <input type="number" name="max_reward" placeholder="Max Reward" value="{{ request('max_reward') }}">

                    <!-- Latest or Oldest -->
                    <label for="rank">Sort Order</label>
                    <select name="sort">
                        <option value="new" {{ request('sort', 'new') == 'new' ? 'selected' : '' }}>Latest</option>
                        <option value="old" {{ request('sort') == 'old' ? 'selected' : '' }}>Oldest</option>
                    </select>

                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        {{-- Project List --}}
        <div class="col-8">
            <div class="job-list">
                <h2> PROJECT LIST</h2>
                @foreach ($all_projects as $project)
                    <a href="{{route('freelancer.project-details', $project->id)}}" class="text-decoration-none text-dark">
                        <div class="job">
                            <div class="job-detail-container">
                                <div class="job-date">{{$project->deadline}}</div>
                                <div class="job-detail">
                                    <h4>{{$project->title}}</h4>
                                    <p class="fw-bold m-0">{{$project->company->user->name}}</p>
                                    <p class="m-0">${{$project->reward_amount}}</p>
                                    <p>
                                        <?php
                                            for($i = 1; $i <= $project->required_rank; $i++){
                                        ?>
                                                <i class="fa-solid fa-star"></i>
                                        <?php
                                            }
                                        ?>
                                    </p>

                                    @foreach ($project->skills as $skill)
                                        <span class="skill-tag">{{$skill->name}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <a class="favoriteBtn" data-url="{{route('freelancer.project.favorite', ['project' => $project->id])}}">
                                <i class="fa-heart fa-2x {{ $project->isFavorited() ? 'fa-solid' : 'fa-regular' }}"></i>
                            </a>
                        </div>
                    </a>
                @endforeach

                {{-- paginate --}}
                <div class="d-flex justify-content-start">
                    {{$all_projects->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
