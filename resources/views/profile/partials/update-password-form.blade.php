<section>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label fw-semibold">Password Saat Ini</label>
            <input type="password"
                   name="current_password"
                   class="form-control"
                   required>

            @error('current_password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password Baru</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>

            @error('password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-shield-lock me-1"></i>
            Ubah Password
        </button>

        @if (session('status') === 'password-updated')
            <span class="text-success ms-3">Password berhasil diubah.</span>
        @endif
    </form>

</section>