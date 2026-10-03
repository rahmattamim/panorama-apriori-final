@extends('layouts.dashboard')

@section('content')

<h2>Parameter Apriori</h2>

<p class="text-muted">
    Atur nilai minimum support dan minimum confidence untuk proses Apriori.
</p>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('parameter-apriori.update') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">
            Minimum Support (%)
        </label>

        <input
            type="number"
            name="min_support"
            class="form-control"
            min="0"
            max="100"
            step="0.01"
            value="{{ $parameter->min_support ?? 20 }}"
            required
        >

        <small class="text-muted">
            Contoh: 20 berarti minimal support 20%.
        </small>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Minimum Confidence (%)
        </label>

        <input
            type="number"
            name="min_confidence"
            class="form-control"
            min="0"
            max="100"
            step="0.01"
            value="{{ $parameter->min_confidence ?? 60 }}"
            required
        >

        <small class="text-muted">
            Contoh: 60 berarti minimal confidence 60%.
        </small>
    </div>

    <button type="submit" class="btn btn-success">
        Simpan Parameter
    </button>

</form>

@endsection