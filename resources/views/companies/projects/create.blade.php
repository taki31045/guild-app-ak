@extends('layouts.company')

@section('title', 'Create')

@section('content')
<style>
    body {
        background-color: #F4EEE0;
    }
    .card {
        background-color: #F4EEE0;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        padding: 20px;
    }
    .star {
        font-size: 2rem;
        color: gray;
        cursor: pointer;
        transition: color 0.2s, transform 0.2s;
    }
    .star.active {
        color: gold;
        transform: scale(1.1);
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        width: 70%;
        padding: 12px 0;
        border-radius: 25px;
        font-size: 1.1rem;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        transition: 0.3s;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
    }
</style>

<div class="create-container justify-center-content">
    <div class="card rounded w-50 m-auto mt-4">
        <form action="{{ route('company.project.create')}}" method="post">
            @csrf
            @method('POST')
            
            <div class="mt-3 w-75 m-auto">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control shadow-sm" placeholder="Enter title">
                @error('title')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3 w-75 m-auto">
                <label class="form-label d-block">Required Rank</label>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" name="required_rank" id="rank-{{ $i }}" value="{{ $i }}" class="d-none">
                        <label for="rank-{{ $i }}" class="star" data-value="{{ $i }}">★</label>
                    @endfor
                </div>
                @error('required_rank')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="row w-75 m-auto">
                <div class="col-6">
                    <div class="mt-3">
                        <label for="reward_amount" class="form-label">Price</label>
                        <input type="number" name="reward_amount" id="reward_amount" class="form-control shadow-sm" placeholder="Enter price">
                    </div>
                    @error('reward_amount')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="mt-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control shadow-sm">
                    </div>
                    @error('deadline')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-3 w-75 m-auto">
                <label for="required_skills" class="form-label d-block">Required Skills</label>
                @foreach ($skills as $skill)
                    <input type="checkbox" class="btn-check" name="skill[]" id="{{ $skill->name }}" value="{{ $skill->id }}">
                    <label class="btn btn-outline-secondary shadow-sm" for="{{ $skill->name }}">{{ $skill->name }}</label>
                @endforeach
                <input type="text" class="form-control w-25 mt-2 shadow-sm" placeholder="Other skills" name="else_skills">
                @error('skill')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3 w-75 m-auto">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control shadow-sm"></textarea>
                @error('description')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-secondary mt-4 mb-3">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star");
        const radios = document.querySelectorAll("input[name='required_rank']");

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
