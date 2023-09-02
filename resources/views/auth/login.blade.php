@extends('layouts.io')

@section('header')
    <h1 class="h2">Selamat Datang kembali di Lab FTI!</h1>
    <p class="lead">
        Silakan masuk menggunakan username dan password Anda.
    </p>
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-10">
                <button type="submit" class="btn btn-primary float-end">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
        <p class="text-center mt-3 mb-0">
            <span>Baru pertama kali?</span>
            <a href="{{ route('register') }}">
                <span>Buat akun baru</span>
            </a>
        </p>
        <p class="text-center mt-0">
            <span>Kembali ke</span>
            <a href="/">
                <span>Beranda</span>
            </a>
        </p>
    </form>
@endsection
