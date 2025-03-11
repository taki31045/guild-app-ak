@extends('layouts.company')

@section('title', 'Freelancer List')

@section('content')


<style>
    body {
        background-color: #F4EEE0;

    }
    h1 {
        color: rgba(66, 66, 66, 0.9);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-weight: bold;
        margin-right: 100px;
    }

    .freelancer-container {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 0;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
    }
    .freelancer-container::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
    }
    .freelancer-card {
        flex: 0 0 25%; /* 3枚表示（100% / 3） */
        max-width: 30%;
        background-color: rgba(66, 66, 66, 0.8); /* 背景色を薄く */
        color: #F4EEE0;
        border-radius: 10px;
    }
    .freelancer-card img {
        width: 100%; /* カードの幅いっぱいにする */
        height: 250px; /* 固定の高さ */
        object-fit: cover; /* 画像をトリミングして調整 */
        border-radius: 10px; /* 角を丸くする（任意） */
    }



</style>

<div class="mt-5">
    <h1 class="float-end">Meet the Freelancer</h1>
    <form  action="{{ route('company.freelancer.list')}}" method="GET" >

        <!-- Required Rank -->
        <label for="rank" class="ms-5">Rank</label>
        <select name="required_rank" class="me-3">
            <option value="">Select Rank</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ request('required_rank') == $i ? 'selected' : '' }}>
                    {{ str_repeat('★', $i) }}
                </option>
            @endfor
        </select>

        <!-- Skill -->

            <label for="rank">Skill</label>
            <select name="skills[]" class="select-skill me-3" multiple>
                <option value="" hidden>Select Skills</option>
                @foreach($all_skills as $skill)
                <option value="{{ $skill->id }}" {{ in_array($skill->id, request('skills', [])) ? 'selected' : '' }}>
                    {{ $skill->name }}
                </option>
                @endforeach
            </select>



        <!-- Latest or Oldest -->

            <label for="rank">Sort Order</label>
            <select name="sort" class="me-3">
                <option value="new" {{ request('sort', 'new') == 'new' ? 'selected' : '' }}>Latest</option>
                <option value="old" {{ request('sort') == 'old' ? 'selected' : '' }}>Oldest</option>
            </select>

        <button type="submit">Search</button>
    </form>
</div>

<div class="freelancer-container mt-5">
@foreach ($freelancers as $freelancer)
<div class="card freelancer-card">
    <div class="border p-2 m-3">
        @if($freelancer->user->avatar)
            <img src="{{ $freelancer->user->avatar }}" class="card-img-top" alt="Freelancer Image">
        @else
            <img src="{{ asset('images/image 3 (1).png')}}" class="card-img-top" alt="Freelancer Image">
        @endif
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-6">
        <h5 class="card-title">{{ $freelancer->user->name }}</h5>
    </div>
    <div class="col-6 d-flex justify-content-end">
        <a class="favoriteBtn me-1" data-id="{{ $freelancer->id }}">
            <i class="{{ auth()->check() && auth()->user()->company->favoriteFreelancers->contains($freelancer->id) ? 'fa-solid text-red-500' : 'fa-regular' }} fa-heart fa-2x"></i>
        </a>
        <a href="{{ route('company.contact.with_freelancer', ['id' => $freelancer['user_id']])}}" class="btn btn-sm btn-outline-secondary ">Message</a>

    </div>
</div>






        <p class="paragraph">{{ $freelancer->user->email }}</p>
        <p>
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $freelancer->rank)
                    <span class="text-warning">&#9733;</span> <!-- 塗りつぶしの星 -->
                @else
                    <span class="text-secondary">&#9734;</span> <!-- 空の星 -->
                @endif
            @endfor
        </p>
        <div class="d-flex flex-wrap ms-4">
            @php
                // スキルを配列化し、6個に満たない場合は空白で埋める
                $skills = $freelancer->skills->pluck('name')->toArray();
                $skills = array_pad($skills, 6, 'No Skill'); // 足りない分は「No Skill」で埋める
            @endphp

            @foreach ($skills as $skill)
                <p class="bg-secondary p-2 text-white me-1 rounded">
                    {{ $skill }}
                </p>
            @endforeach

        </div>
    </div>
</div>
@endforeach
</div>

<script src="{{asset('js/favorite-freelancer.js')}}"></script>
@endsection