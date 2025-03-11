@extends($layout)

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card p-4 border-3 shadow-lg text-center bg-transparent" style="border-color: #5b4636">
            <div class="card-header fs-4 fw-bold bg-transparent"
                style="color: #5b4636; border-bottom: 2px solid #5b4636;">
                {{ __('Verify Your Email Address') }}
            </div>

            <div class="card-body" style="color: #3a2d1f;">
                @if (session('resent'))
                    <div class="alert alert-success text-dark border-0"
                        style="background: rgba(150, 200, 150, 0.5);">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p class="fs-5">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p class="fs-6">{{ __('If you did not receive the email') }},</p>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn shadow-sm px-4 py-2"
                        style="background: #5b4636; color: white; border-radius: 8px; border: 1px solid #3a2d1f;">
                        {{ __('Click here to request another') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
