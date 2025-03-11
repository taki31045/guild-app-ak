@extends('layouts.company')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background-color: #F4EEE0;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    /* タイトルの強調 */
    h1 {
        color: rgba(66, 66, 66, 0.9);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-weight: bold;
    }

    /* カードのスタイル */
    .card {
        border: none;
        transition: 0.3s ease-in-out;
        border-radius: 30px;
        background-color: rgba(66, 66, 66, 0.9);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 10px 10px 20px rgba(13, 2, 27, 0.8);
    }

    .card-header, .card-body {
        color: #F4EEE0;

        border: none;
    }

    /* ステータスバッジの強調 */
    .status-badge {
        min-width: 100px;
        text-align: center;
        border-radius: 8px;
        padding: 8px 12px;
        background-color: #C976DE;
        color: white;
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
        font-weight: bold;
    }

    /* 価格の強調 */
    .fw-bold {
        font-size: 1.2rem;
    }

    /* アクションボタン */
    .actions a {
        text-decoration: none;
        margin-right: 10px;
    }

    /* 星評価のデザイン */
    .star {
        font-size: 18px;
        cursor: default;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h1>Stay on Top of Your Current Job Contracts</h1>
        </div>
        <div class="col-6">
            <h1>Stay on Schedule!</h1>
            <p class="mb-5">Keep track of milestones, review pending tasks, and ensure projects are delivered on time. Your success starts with great project management!</p>
        </div>
    </div>

    <div class="row mt-1">
        @php
            $projects_progress = array_pad($projects_progress, 6, null);
        @endphp

        @foreach ($projects_progress as $project_progress)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 text-uppercase">
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
                                <div class="status-badge">
                                    {{ $project_progress['application']['status'] == 'resulted' ? 'freelancer checking' : $project_progress['application']['status'] }}
                                </div>
                            @endif
                        </div>

                        @if ($project_progress)
                            <div class="actions mt-3 d-flex justify-content-center">
                                @if ($project_progress['application']['status'] == 'requested')
                                    <a href="{{ route('company.paypal.payment', ['price' => $project_progress['reward_amount'], 'id' => $project_progress['id']]) }}" class="btn btn-sm btn-primary">PayPalで支払う</a>
                                    <a href="{{ route('company.project.status.decline', ['id' => $project_progress])}}" class="btn btn-sm btn-outline-danger">Decline</a>
                                    <a href="{{ route('company.contact.with_freelancer', ['id' => $project_progress['application']['freelancer']['user_id']])}}" class="btn btn-sm btn-outline-secondary">Message</a>
                                @elseif ($project_progress['application']['status'] == 'submitted')
                                    <a href="{{ route('company.evaluation.evaluation', $project_progress['id']) }}" class="btn btn-sm btn-success">Accept</a>
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

<script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>

@endsection