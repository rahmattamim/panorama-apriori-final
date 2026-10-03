@extends('layouts.landing')

@section('title', 'Login')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center" style="min-height:100vh;">

        <div class="col-md-5">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-5">

                    <h2 class="text-center fw-bold text-success">
                        TOKO PANORAMA
                    </h2>

                    <p class="text-center text-muted mb-4">
                        Sistem Data Mining Algoritma Apriori
                    </p>

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember">

                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>

                        </div>

                        <button class="btn btn-success w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection