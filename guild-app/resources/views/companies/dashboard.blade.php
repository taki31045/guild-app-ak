@extends('layouts.company')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background-color: #F4EEE0;
    }

    .card {
        border: none;
        transition: 0.3s ease-in-out;
        border-radius: 30px;
        background-color: rgba(66, 66, 66, 0.8); /* 背景色を薄く */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-header, .card-body {
        color: #F4EEE0;
        border: none;
    }

    .status-badge {
        min-width: 90px;
        text-align: center;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .actions a {
        text-decoration: none;
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Stay on Top of Your Current Job Contracts</h1>
        </div>
        <div class="col-6">
            <h1>Stay on Schedule!</h1>
            <p class="mb-5">Keep track of milestones, review pending tasks, and ensure projects are delivered on time. Your success starts with great project management!</p>
        </div>
    </div>

    <div class="row mt-4">
        @php
            // 必ず6件のカードを表示するため、配列を6つにパディング
            $projects_progress = array_pad($projects_progress, 6, null);
        @endphp

        @foreach ($projects_progress as $project_progress)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 text-truncate">
                            {{ $project_progress ? $project_progress['title'] : 'No Project' }}
                        </h5>
                        
                    </div>
                    <div class="card-body">
                        <p class="text-truncate">
                            {{ $project_progress ? $project_progress['description'] : 'No description available.' }}
                        </p>
                        <p>Freelancer: {{ $project_progress ? $project_progress['application']['freelancer']['user']['name'] : 'N/A' }}</p>
                        <span class="fw-bold">Price: {{ $project_progress ? $project_progress['reward_amount'] : '-' }}</span>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span>Deadline: {{ $project_progress ? \Carbon\Carbon::parse($project_progress['deadline'])->format('m/d') : '-' }}</span>
                            @for ($i = 1; $i <= 5; $i++)
                            <label for="rank-{{ $i }}" class="star {{ $project_progress && $i <= ($project_progress['required_rank'] ?? 0) ? 'text-warning' : 'text-muted' }}">★</label>

                        
                        @endfor

                            @if ($project_progress)
                            @if($project_progress['application']['status'] == 'resulted')
                            <div class="status-badge text-white" style="background-color: #C976DE;">
                                freelancer checking
                            </div>
                            @else
                                <div class="status-badge text-white" style="background-color: #C976DE;">
                                    {{ $project_progress['application']['status'] }}
                                </div>
                            @endif
                            @endif
                        </div>

                        @if ($project_progress)
                            <div class="actions mt-3 d-flex">
                                @if ($project_progress['application']['status'] == 'requested')
                                    <a href="{{ route('company.paypal.payment', ['price' => $project_progress['reward_amount'], 'id' => $project_progress['id']]) }}" class="btn btn-sm btn-primary">PayPalで支払う</a>
                                    <a href="{{ route('company.decline', ['id' => $project_progress])}}" class="btn btn-sm btn-outline-danger">Decline</a>
                                    <a href="{{ route('company.message', ['id' => $project_progress['application']['freelancer']['user_id']])}}" class="btn btn-sm btn-outline-secondary">Message</a>
                                @elseif ($project_progress['application']['status'] == 'submitted')
                                    <a href="{{ route('company.evaluation', $project_progress['id']) }}" class="btn btn-sm btn-success">Accept</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger">Decline</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    {{-- <div class="content border m-auto mt-5" style="height: 500px; width: 1000px; ">
        <div class="row h-100">
            <div class="col-4" style="background-image: url('{{ asset('images/on going.jpg') }}');">
            </div>
            <div class="col-8">
                @foreach ($projects_progress as $project_progress)
                <div class="row border rounded p-3 shadow-sm">
                    <!-- First Column: Placeholder or Icon -->
                    <div class="border bg-light  d-flex justify-content-center align-items-center" 
                             style="width: 50px; height: 50px; font-size: 0.9rem; font-weight: bold; color: #333;">
                            {{ \Carbon\Carbon::parse($project_progress->deadline)->format('m/d') }}
                        </div>
                
                    <!-- Second Column: Title, Name, and Price -->
                    <div class="col-8">
                        <h2 class="fs-4 fw-bold text-dark mb-1">{{ $project_progress->title }}</h2>
                        <a href="#" class="text-decoration-none text-primary">{{ $project_progress->application->freelancer->user->name}}</a>
                      
                        <div class="d-flex align-items-center mt-2">
                            <p class="mb-0 me-2 text-muted fw-bold">Price: {{ $project_progress->reward_amount }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                            <label for="rank-{{ $i }}" class="star {{ $i <= $project_progress->required_rank ? 'text-warning' : 'text-muted' }}">★</label>
                        @endfor
                        </div>
                    </div>
                
                    <!-- Third Column: Status -->
                    <div class="col-2 d-flex align-items-center justify-content-center flex-column">
                        <div class="border text-white text-center rounded p-2 mb-3" style="min-width: 80px; background-color: #C976DE;">
                            {{ $project_progress->application->status}}
                        </div>
                        @if ($project_progress->application->status == 'requested')
                            <div class="d-flex">
                                <a href="{{ route('company.paypal.payment', ['price' => $project_progress->reward_amount, 'id' => $project_progress->id]) }}">PayPalで支払う</a>
                                <a href="#"class="me-2">Decline</a>
                                <a href="#" class="">Message</a>
                            </div>
                        @elseif($project_progress->application->status == 'ongoing')
                        @elseif($project_progress->application->status == 'submitted')
                        <div class="d-flex">
                            <a href="{{ route('company.evaluation',$project_progress->id)}}" class="me-2">Accept</a>
                            <a href="#" class="">Decline</a>
                        </div>
                        @endif
                    </div>
                </div>
                    
                @endforeach

                </div>
            </div>
        </div> --}}


      

        

{{-- 



    <div class="content border m-auto mt-5" style="height: 500px; width: 1000px;">
        <div class="row h-100">
            <div class="col-8">
                @foreach ($projects as $project)
                <div class="row border rounded p-3 shadow-sm">
                    <!-- First Column: Placeholder or Icon -->
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <div class="border bg-light  d-flex justify-content-center align-items-center" 
                             style="width: 50px; height: 50px; font-size: 0.9rem; font-weight: bold; color: #333;">
                            {{ \Carbon\Carbon::parse($project->deadline)->format('m/d') }}
                        </div>
                    </div>
                
                    <!-- Second Column: Title, Name, and Price -->
                    <div class="col-7">
                        <h2 class="fs-4 fw-bold text-dark mb-1">{{ $project->title }}</h2>
                        <div class="d-flex align-items-center mt-2">
                            <p class="mb-0 me-2 text-muted fw-bold">price : {{ $project->reward_amount }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                            <label for="rank-{{ $i }}" class="star {{ $i <= $project->required_rank ? 'text-warning' : 'text-muted' }}">★</label>
                        @endfor
                        
                        </div>
                    </div>
                
                    <!-- Third Column: Status -->
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <div class="b border bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <span>33</span>
                        </div>
                        
                        <a href="{{ route('company.edit', $project->id)}}"><i class="fa-solid fa-pen-to-square me-3 fa-2x"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#delete-project-{{ $project->id }}"><i class="fa-solid fa-trash-can fa-2x"></i></button>
                        @include('companies.modal.delete')
                        
                        
                    </div>
                </div>

                @endforeach
                
            </div>

               
                <div class="col-4" style="background-image: url('{{ asset('images/job list.jpg') }}');">
                </div>
                </div>
            </div>






            <div class="scrolling-container m-auto mt-5">
                <div class="scrolling-contents">
                    <!-- Add more items as needed -->
                    @foreach ($favoriteFreelancers as $freelancer)
                    <div class="items card">
                        <img src="{{ asset('images/ae2944c609a05d17f8a8d016654bb03e.jpg') }}" alt="33" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title">{{ $freelancer->freelancer->user->name }}</h2>
                            <p>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $freelancer->freelancer->rank)
                                        <span class="text-warning">&#9733;</span> <!-- 塗りつぶしの星 -->
                                    @else
                                        <span class="text-secondary">&#9734;</span> <!-- 空の星 -->
                                    @endif
                                @endfor
                            </p>
                            <p class="paragraph">{{ $freelancer->freelancer->user->email }}</p>
                
                            <!-- スキルの数を6個に固定 -->
                            <div class="d-flex flex-wrap ms-4">
                                @php
                                    // スキルを配列化し、6個に満たない場合は空白で埋める
                                    $skills = $freelancer->freelancer->skills->pluck('name')->toArray();
                                    $skills = array_pad($skills,6, ''); // 足りない分は空白で埋める
                                @endphp
                
                                @foreach ($skills as $skill)
                                    <p class="bg-secondary p-2 text-white me-1 rounded">
                                        {{ $skill ?: ' No Skill' }} <!-- 空白の時はスペースを入れる -->
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                
                </div>
            </div>

    <div class="container mt-5" style="margin-left: 480px;">
        <form action="##" method="post">
            <label for="message" class="d-block">message</label>
            <textarea name="message" id="message" cols="60" rows="10"></textarea>
            <button type="submit" class="btn btn-outline-secondary d-block ">submit</button>
        </form>
    </div> --}}
            
            
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>

    
@endsection