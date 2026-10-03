@extends('layouts.dashboard')

@section('title', 'Profil')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        <i class="bi bi-person-circle text-success"></i>
        Profil Saya
    </h2>

    <div class="row">

        {{-- Update Profil --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    Informasi Profil
                </div>
                <div class="card-body">

                    @include('profile.partials.update-profile-information-form')

                </div>
            </div>
        </div>

        {{-- Ganti Password --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    Ubah Password
                </div>
                <div class="card-body">

                    @include('profile.partials.update-password-form')

                </div>
            </div>
        </div>

    </div>

    {{-- Hapus Akun --}}
    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white">
            Hapus Akun
        </div>
        <div class="card-body">

            @include('profile.partials.delete-user-form')

        </div>
    </div>

</div>

@endsection