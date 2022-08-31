<div class="modal fade" id="add_change_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_changepass" class="needs-validation" novalidate="" action="{{ route('changepassword') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="col-form-label">Password Sekarang</label>
                        <input class="form-control" type="password" name="old_password" required="" placeholder="Password" autocomplete="off">
                        <div class="invalid-feedback text-danger">Password wajib diisi!</div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Password Baru</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="Password Baru" autocomplete="off">
                        <div class="invalid-feedback text-danger">Password Baru wajib diisi!</div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Konfirmasi Password Baru</label>
                        <input class="form-control" type="password" name="confirm_password" required="" placeholder="Konfirmasi Password Baru" autocomplete="off">
                        <div class="invalid-feedback text-danger">Konfirmasi Password Baru wajib diisi!</div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
