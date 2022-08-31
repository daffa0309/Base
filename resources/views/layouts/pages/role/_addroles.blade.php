<div class="modal fade" id="add_role_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Tambah Role</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="" class="needs-validation" novalidate="" method="POST" id="add_role" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="POST">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Name</label> <span class="text-danger">*</span>
                                <input class="form-control " type="text" placeholder="Name" name="name" id="name" required="">
                                <div class="invalid-feedback text-danger">Name wajib diisi!</div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


