@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:120px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Verification link has been sent to your email.') }}
                        </div>
                    @endif

                    {{ __('Please check your email to verify') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to recive another link') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
