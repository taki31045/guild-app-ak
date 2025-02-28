@extends('layouts.company')

@section('title', '')

@section('content')
<link rel="stylesheet" href="{{ asset('css/company.style.css')}}"> 

<style>
    body {
        background-color: #F4EEE0;
    }
    .freelancer-container {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 10px;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
    }
    .freelancer-container::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
    }
    .freelancer-card {
        flex: 0 0 30%; /* 3枚表示（100% / 3） */
        max-width: 30%;
        background-color: rgba(66, 66, 66, 0.8); /* 背景色を薄く */
        color: #F4EEE0;
        border-radius: 10px;

    }
</style>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h2>Meet the Best Freelancers for Your Projects</h2>
        </div>
        <div class="col-6">
            <h2>Top Talent, Top Results</h2>
            <p class="mb-5">Our top freelancers are vetted, highly skilled, and ready to bring your ideas to life. Find the perfect match for your project today.</p>
        </div>
    </div>

    @php
        // フリーランサーの数が3未満なら、ダミーオブジェクトを追加
        while(count($favoriteFreelancers) < 3) {
            $favoriteFreelancers[] = (object)[
                'freelancer' => (object)[
                    'user' => (object)[
                        'name' => 'Unknown Freelancer',
                        'email' => 'N/A',
                    ],
                    'rank' => 0,
                    'skills' => collect([]) // 空のスキルリスト
                ]
            ];
        }
    @endphp

@php
// 変更したい画像のパスを配列で用意
$customImages = [
    asset('images/image 3.png'),
    asset('images/image 1 (1).png'),
    asset('images/image 2.png'),
];
@endphp

<div class="freelancer-container">
@foreach ($favoriteFreelancers as $freelancer)
<div class="card freelancer-card">
    <div class="border p-2 m-3">
        @if ($loop->index < 3) 
            <!-- 最初の3人は特定の画像を適用 -->
            <img src="{{ $customImages[$loop->index] }}" class="card-img-top" alt="Freelancer Image">
        @else
            <!-- それ以降はデフォルト画像 -->
            <img src="{{ asset('images/image-placeholder.png')}}" class="card-img-top" alt="Freelancer Image">
        @endif
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $freelancer->freelancer->user->name }}</h5>
        <p class="paragraph">{{ $freelancer->freelancer->user->email }}</p>
        <p>
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $freelancer->freelancer->rank)
                    <span class="text-warning">&#9733;</span> <!-- 塗りつぶしの星 -->
                @else
                    <span class="text-secondary">&#9734;</span> <!-- 空の星 -->
                @endif
            @endfor
        </p>
        <div class="d-flex flex-wrap ms-4">
            @php
                // スキルを配列化し、6個に満たない場合は空白で埋める
                $skills = $freelancer->freelancer->skills->pluck('name')->toArray();
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
@endsection
