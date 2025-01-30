@extends('layouts.company')

@section('title', 'Profile')

@section('content')
<link href="{{ asset('css/companyprofile.style.css') }}" rel="stylesheet">

<div class=" line-1 border rounded-pill p-3 shadow-lg" style="background-color: #C976DE; ">
</div>

<div class=" line-2 border rounded-pill p-3 shadow-lg text-end" style="background-color: #C976DE; ">
    <i class="text-end fa-solid fa-circle-user icon-lg"></i>
</div>

<div class=" line-3 border rounded-pill shadow-lg" style="background-color: #C976DE; ">
</div>

<div class=" line-4 border rounded-pill p-2 shadow-lg" style="background-color: #C976DE; ">
</div>

<div class="profile-container row justify-content-center">
    <div class="profile-container-1 col-11">        
        <div class="w-50 profile-1 card rounded mt-5 ps-3 py-3 me-3 float-end">
            <div class="header mb-3 fw-bold">Company profile</div>
                <table class="company-profile">
                    <tbody>
                        <tr>
                            <td>Company name</td>
                            <td>kredo</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>krd2025@kredo.co.jp</td>
                        </tr>
                        <tr>
                            <td>website</td>
                            <td>www.kredo.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>   
        <div class="col-1 mt-5 float-end">
            <i class="fa-solid fa-pen-to-square icon-sm"></i>
        </div>
    </div>
        
    <div class="profile-container-2 row justify-content-center">
            <div class="col-10 float-start mx-5 mt-5">
                <div class="card rounded w-75 m-5 p-3">
                        <table class="profile-2">
                            <tbody>
                            <tr>
                                <td>Representative:</td>
                                <td>Ryunosuke</td>
                            </tr>
                            <tr>
                                <td>Number of Employees:</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>Capital:</td>
                                <td>$1,000</td>
                            </tr>
                            <tr>
                                <td>Annual Sales:</td>
                                <td>$1,000</td>
                            </tr>
                            <tr>
                                <td>Address(Prefecture):</td>
                                <td>Tokyo</td>
                            </tr>
                            <tr>
                                <td>Business Description:</td>
                                <td>Management of an online programming academy and IT-focused study abroad programs.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">  
        <div class="card-body">
            <!-- Contents of Tab -->
            <div class="job-container">
                <input type="radio" id="job-history" name="tab-group" checked>
                <input type="radio" id="payment-history" name="tab-group">
                <div class="tab-menu">
                    <label for="job-history" class="tab-label">Job History</label>
                    <label for="payment-history" class="tab-label">Payment History</label>
                    </div>
                    <div class="tab-content">
                        
                            <div class="tab-pane job-history">
                                <div class="job-history-contents w-100">
                                    <div class="job-date">By May</div>
                                    <div class="job-details">
                                        <h3 class="h5 m-0">Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h3>
                                        <p class="fw-bold m-0">Kredo Company</p>
                                        <p class="m-0">$1000</p>
                                        <p>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-history-contents w-100">
                                    <div class="job-date">By May</div>
                                    <div class="job-details">
                                        <h3 class="h5 m-0">Very simple Sketchup Plugin to connect with our Webapp Oauth ....</h3>
                                        <p class="fw-bold m-0">Kredo Company</p>
                                        <p class="m-0">$1000</p>
                                        <p>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        
                <!-- Payment History -->
                            <div class="tab-pane payment-history">
                                <table class="table table-bordered w-75">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>JOB No.</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-01-03</td>
                                            <td>003</td>
                                            <td>$1200</td>
                                        </tr>
                                        <tr>
                                            <td>2025-01-04</td>
                                            <td>004</td>
                                            <td>$1700</td>
                                        </tr>
                                        <tr>
                                            <td>2025-01-05</td>
                                            <td>005</td>
                                            <td>$1500</td>
                                        </tr>
                                        <tr>
                                            <td>2025-01-06</td>
                                            <td>005</td>
                                            <td>$1500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>        

@endsection