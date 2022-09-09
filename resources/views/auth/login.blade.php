@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    @error('email')
                                        <span class="h6" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-6">
                                    <div class="form-outline">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required
                                            autocomplete="current-password">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    @error('password')
                                        <span class="h6" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
