@extends('layouts.dashboard')

@section('content')

<h2>Edit User</h2>

<form action="{{ route('user.update',$user->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control"
               value="{{ $user->email }}">
    </div>

    <div class="mb-3">
        <label>Password Baru (Kosongkan jika tidak diganti)</label>
        <input type="password"
               name="password"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>

        <select name="role" class="form-control">

            <option value="owner"
                {{ $user->role=='owner' ? 'selected' : '' }}>
                Owner
            </option>

            <option value="user"
                {{ $user->role=='user' ? 'selected' : '' }}>
                User
            </option>

        </select>

    </div>

    <button class="btn btn-success">
        Update
    </button>

    <a href="{{ route('user.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection