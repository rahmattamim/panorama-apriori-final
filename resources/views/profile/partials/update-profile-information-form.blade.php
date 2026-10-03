<section>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle me-1"></i>
            Simpan Perubahan
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success ms-3">Berhasil disimpan.</span>
        @endif
    </form>

</section>