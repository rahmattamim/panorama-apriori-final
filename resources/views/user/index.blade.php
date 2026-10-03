@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">


    <hr>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Kelola User</h2>

        <a href="{{ route('user.create') }}" class="btn btn-success">
            + Tambah User
        </a>

    </div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>

        @foreach($users as $user)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>

                <td>
                    <a href="{{ route('user.edit',$user->id) }}"
                        class="btn btn-warning btn-sm">

                        Edit

                    </a>
                </td>

                <td>
                    <a href="{{ route('user.edit', $user->id) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('user.destroy', $user->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection