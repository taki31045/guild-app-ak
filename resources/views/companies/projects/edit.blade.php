@extends('layouts.company')

@section('title', 'Edit')

@section('content')

<style>
    .star {
        font-size: 2rem;
        color: gray;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star.active {
        color: gold;
    }

    .card{
        background-color: #F4EEE0;
    }
</style>
    <div class="create-container justify-center-content">
        <div class="card rounded  w-50 m-auto mt-3">
            <form action="{{ route('company.project.update',$project->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="mt-3 w-75 m-auto">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $project->title}}">
                </div>

                <div class="mt-3 w-75 m-auto">
                    <label class="form-label d-block">Required Rank</label>
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="required_rank" id="rank-{{ $i }}" value="{{ $i }}" class="d-none" @if($project->required_rank == $i) checked @endif>
                            <label for="rank-{{ $i }}" class="star" data-value="{{ $i }}">★</label>
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
        
                <button type="submit" class="btn btn-secondary mt-3 mb-2"
                style="width: 300px; display: block; margin-left: auto; margin-right: auto;">
                Submit
            </button>
            
            </form>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star");
        const radios = document.querySelectorAll("input[name='required_rank']");

        // 初期状態で選択されている星をゴールドにする
        const selectedValue = document.querySelector("input[name='required_rank']:checked");
        if (selectedValue) {
            let value = selectedValue.value;
            stars.forEach(s => {
                if (s.getAttribute("data-value") <= value) {
                    s.classList.add("active");
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener("click", function() {
                let value = this.getAttribute("data-value");

                // ラジオボタンに値をセット
                radios[value - 1].checked = true;

                // 色の変更（左から選択された星までゴールドにする）
                stars.forEach(s => {
                    if (s.getAttribute("data-value") <= value) {
                        s.classList.add("active");
                    } else {
                        s.classList.remove("active");
                    }
                });
            });
        });
    });
</script>
@endsection
