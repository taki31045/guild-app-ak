@extends('layouts.company')

@section('title', 'Edit')

@section('content')

<style>
    /* .rating {
        display: flex;
        justify-content: flex-start;
    } */
    .star {
        font-size: 2rem;
        color: gray;
        cursor: pointer;
        transition: color 0.2s;/*色が変化するときの時間の設定　*/
    }
    
    input[type="radio"]:checked ~ label {
        color: gold;
    }
    /* inputの要素をターゲットにしている。チェックされたときに適用で、その一般兄弟であるlabelに指定できる */
</style>
<div class=" in-4 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" in-5 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" in-6 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
    <div class="create-container justify-center-content">
        <div class="card rounded  w-50 m-auto mt-3">

                

            <form action="{{ route('company.update',$project->id)}}" method="post">
                @csrf
                @method('POST')
                <div class="mt-3 w-75 m-auto">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $project->title}}">
                </div>

                <div class="mt-3 w-75 m-auto">
                    <label class="form-label d-block">Required Rank</label>
                    <div class="rating">
                        @for ($i =  1; $i <= 5 ; $i++)
                        <input type="radio" name="required_rank" id="rank-{{ $i }}" value="{{ $i }}" class="d-none"      @if ($project->required_rank == $i) checked @endif>
                        <label for="rank-{{ $i }}" class="star">★</label>
                        @endfor
                    </div>
                </div>

                <div class="row w-75 m-auto">
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="reward_amount" class="form-label">Price</label>
                            <input type="number" name="reward_amount" id="reward_amount" class="form-control" value="{{ $project->reward_amount}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" value="{{ $project->deadline}}">
                        </div>
                    </div>
                </div>

                <div class="mt-3 w-75 m-auto" >
                    <label for="required_skills" class="form-label d-block">required skills</label>
                    @foreach ($skills as $skill)
 
                    <input type="checkbox" class="btn-check" name="skill[]" id="{{ $skill->name }}" value="{{ $skill->id }}"    @if ($project->skills->contains($skill->id)) checked @endif>
                    <label class="btn btn-outline-secondary" for="{{ $skill->name }}">{{ $skill->name }}</label>
                    @endforeach

                        <input type="text"  class="form-control w-25 mt-2" placeholder="else skills" name="else_skills">
                </div>

                <div class="mt-3 w-75 m-auto">

                    <label for="description" class="form-label ">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $project->description }}</textarea>
                </div>
        
                <button type="submit" class="btn btn-secondary mt-3 mb-2" style="margin-left: 150px; padding: 0px 200px; ">submit</button>
                    
            </form>
        </div>
    </div>
@endsection