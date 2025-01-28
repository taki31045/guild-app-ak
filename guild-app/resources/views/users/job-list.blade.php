@extends('layouts.user-app')

@section('title', 'Job List')

@section('styles')
    <link rel="stylesheet" href="css/users/job-list.css">
@endsection

@section('content')
    <div class="row justify-content-center job-list">
        <div class="col-8">
            <h2>JOB LIST</h2>

            {{-- Searching --}}

            <a href="/job-details" class="text-decoration-none text-dark">
                <div class="job">
                    <div class="job-detail-container">
                        <div class="job-date">By May</div>
                        <div class="job-detail">
                            <h4>Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h4>
                            <p class="fw-bold m-0">Kredo Company</p>
                            <p class="m-0">$1000</p>
                            <p>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                            <span class="skill-tag">HTML</span>
                            <span class="skill-tag">CSS</span>
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">Javascript</span>
                        </div>
                    </div>
                    <a href="#" class="like">
                        <i class="fa-regular fa-heart fa-2x like"></i>
                    </a>
                </div>
            </a>
            <a href="/job-details" class="text-decoration-none text-dark">
                <div class="job">
                    <div class="job-detail-container">
                        <div class="job-date">By May</div>
                        <div class="job-detail">
                            <h4>Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h4>
                            <p class="fw-bold m-0">Kredo Company</p>
                            <p class="m-0">$1000</p>
                            <p>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                            <span class="skill-tag">HTML</span>
                            <span class="skill-tag">CSS</span>
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">Javascript</span>
                        </div>
                    </div>
                    <a href="#" class="like">
                        <i class="fa-regular fa-heart fa-2x like"></i>
                    </a>
                </div>
            </a>
            <a href="/job-details" class="text-decoration-none text-dark">
                <div class="job">
                    <div class="job-detail-container">
                        <div class="job-date">By May</div>
                        <div class="job-detail">
                            <h4>Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h4>
                            <p class="fw-bold m-0">Kredo Company</p>
                            <p class="m-0">$1000</p>
                            <p>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                            <span class="skill-tag">HTML</span>
                            <span class="skill-tag">CSS</span>
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">Javascript</span>
                        </div>
                    </div>
                    <a href="#" class="like">
                        <i class="fa-regular fa-heart fa-2x like"></i>
                    </a>
                </div>
            </a>
            <a href="/job-details" class="text-decoration-none text-dark">
                <div class="job">
                    <div class="job-detail-container">
                        <div class="job-date">By May</div>
                        <div class="job-detail">
                            <h4>Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h4>
                            <p class="fw-bold m-0">Kredo Company</p>
                            <p class="m-0">$1000</p>
                            <p>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                            <span class="skill-tag">HTML</span>
                            <span class="skill-tag">CSS</span>
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">Javascript</span>
                        </div>
                    </div>
                    <a href="#" class="like">
                        <i class="fa-regular fa-heart fa-2x like"></i>
                    </a>
                </div>
            </a>
        </div>
    </div>
    {{-- pagenate --}}
@endsection
