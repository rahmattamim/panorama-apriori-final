@extends('layouts.dashboard')

@section('content')

<h2>Tambah User</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>

        <select name="role" class="form-control">
            <option value="owner">Owner</option>
            <option value="user">User</option>
        </select>
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

    <a href="{{ route('user.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection