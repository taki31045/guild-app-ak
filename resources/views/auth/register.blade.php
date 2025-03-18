@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url("{{ asset('images/Ancient-Roman-Colosseum2.jpg') }}");
        background-position: top;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.6);
    }
    input {
        background-color: rgba(255, 255, 255, 0.6) !important;
    }
    nav{
        background-color: rgba(255, 255, 255, 0.6);
        width: 80% !important;
        margin: auto;
    }
</style>


<div class="container">
    <div class="card w-50 m-auto" style="margin-top: 170px !important;">
        <div class="card-header text-center">{{ __('Register') }}</div>
       

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- エラー表示 --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- ユーザータイプ（フリーランス / 会社） -->
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" value="2" id="company"
                                   {{ old('role_id') == '2' ? 'checked' : '' }} onclick="toggleFields()">
                            <label class="form-check-label" for="company">
                                {{ __('Company') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" value="3" id="freelance"
                                   {{ old('role_id') == '3' ? 'checked' : '' }} onclick="toggleFields()">
                            <label class="form-check-label" for="freelance">
                                {{ __('Freelance') }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 会社向けのフィールド -->
                <div id="companyFields" style="display: none;">
                    <div class="row mb-3">
                        <label for="company_name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>
                        <div class="col-md-6">
                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="company_email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="company_password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="company_password_confirmation">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn w-100 bg-secondary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- フリーランス向けのフィールド -->
                <div id="freelanceFields" style="display: none;">
                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn w-100 bg-secondary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        let companyFields = document.getElementById('companyFields');
        let freelanceFields = document.getElementById('freelanceFields');
        let companyRadio = document.getElementById('company');
        let freelanceRadio = document.getElementById('freelance');

        if (companyRadio.checked) {
            companyFields.style.display = 'block';
            freelanceFields.style.display = 'none';
        } else if (freelanceRadio.checked) {
            companyFields.style.display = 'none';
            freelanceFields.style.display = 'block';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleFields();
    });
</script>
@endsection
