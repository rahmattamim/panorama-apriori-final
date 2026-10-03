<section>

    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Akun yang dihapus tidak dapat dikembalikan. Semua data profil akan hilang secara permanen.
    </div>

    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusAkunModal">
        <i class="bi bi-trash me-1"></i>
        Hapus Akun
    </button>

    <!-- Modal -->
    <div class="modal fade" id="hapusAkunModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            Konfirmasi Hapus Akun
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <p>
                            Masukkan password untuk menghapus akun ini.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                            @error('password', 'userDeletion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>