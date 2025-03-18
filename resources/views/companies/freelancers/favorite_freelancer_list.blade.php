@extends('layouts.company')

@section('title', '')

@section('content')

<style>
    body {
        background-color: #F4EEE0;
    }
    h1 {
        color: rgba(66, 66, 66, 0.9);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-weight: bold;
    }
    .freelancer-container {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 0;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
        margin-top: -10px;
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
    width: 100%; /* カードの幅いっぱいに調整 */
    height: 250px; /* 高さを統一 */
    object-fit: cover; /* 画像をトリミングして均一に表示 */
    border-radius: 10px; /* 角を少し丸める */
}
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h1>Meet the Best Freelancers for Your Projects</h1>
            <a href="{{ route('company.freelancer.list')}}" class="btn btn-sm btn-outline-secondary">list</a>
        </div>
        <div class="col-6">
            <h1>Top Talent, Top Results</h1>
            <p class="mb-5">Our top freelancers are vetted, highly skilled, and ready to bring your ideas to life. Find the perfect match for your project today.</p>
        </div>
    </div>
</div>

    @php
        // フリーランサーの数が3未満なら、ダミーオブジェクトを追加
        while(count($favoriteFreelancers) < 4) {
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
    asset('images/image 3 (1).png'),
    asset('images/image 1 (2).png'),
    asset('images/image 2.png'),
];
@endphp

<div class="freelancer-container">
@foreach ($favoriteFreelancers as $freelancer)
<div class="card freelancer-card">
    <div class="border p-2 m-3">
        @if (isset($freelancer->freelancer->user->avatar) && $freelancer->freelancer->user->avatar)
        <img src="{{ $freelancer->freelancer->user->avatar }}" class="card-img-top" alt="Freelancer Image">
    @else
        <img src="{{ $customImages[$loop->index % count($customImages)] }}" class="card-img-top" alt="Freelancer Image">
    @endif
    </div>
    <div class="card-body">
        @if(isset($freelancer->freelancer->user->id))
        <div class="row">
            <div class="col-6">
            <a href="{{ route('company.freelancer.profile.show', $freelancer->freelancer->user->id)}}" class="card-title">{{ $freelancer->freelancer->user->name }}</a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="{{ route('company.contact.with_freelancer',  $freelancer->freelancer->user->id)}}" class="btn btn-sm btn-outline-secondary ">Message</a>
        </div>
    </div>
    @else
        <p>No profile found</p>
    @endif
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
<script src="{{asset('js/favorite-freelancer.js')}}"></script>
@endsection
