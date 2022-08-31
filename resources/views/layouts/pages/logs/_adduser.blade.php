<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Form User</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="" class="needs-validation" novalidate="" method="POST" id="add_user" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="POST">
                    <div class="row">
                        <div class="col-md-6">


                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Username:</label><span class="text-danger">*</span>
                                <input class="form-control " type="text" placeholder="Username" name="username" id="username" required="">
                                <div class="invalid-feedback text-danger">Username wajib diisi!</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Name:</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" placeholder="Name" name="name" id="name"  required="">
                                <div class="invalid-feedback text-danger">Name wajib diisi!</div>

                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Email:</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" placeholder="Email" name="email" id="email"  required="">
                                <div class="invalid-feedback text-danger">Email wajib diisi!</div>

                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Whatsapp:</label>
                            <input class="form-control" type="text" placeholder="Whatsapp" name="whatsapp" id="whatsapp"  >
                            <div class="valid-feedback">Optional</div>

                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Slack:</label>
                            <input class="form-control" type="text" placeholder="Slack" name="slack" id="slack"  >
                            <div class="valid-feedback">Optional</div>

                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Role:</label><span class="text-danger">*</span>
                            <select class="form-select select-role" id="role_id" name="role_id" required="">
                                <option selected="" disabled="" value="">Pilih Role..</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback text-danger">Role wajib diisi!</div>

                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Value:</label> <span class="text-danger">*</span>
                            <select class="form-select select-value" id="value" name="value"  required="" >
                                <option value="0">Pilih Value</option>
                                <option value="No. Provinsi">No. Provinsi</option>
                                <option value="No. Kabupaten">No. Kabupaten</option>
                            </select>
                            <div class="invalid-feedback text-danger">Value wajib diisi!</div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Value:</label><span class="text-danger">*</span>
                            <select class="form-select select-role" id="value" name="value" required="">
                                <option selected="" disabled="" value="0">Pilih Value..</option>
                                <option  value="1">No. Prov</option>
                                <option  value="2">No. Kab</option>
                            </select>
                            <div class="invalid-feedback">Looks good!</div>

                        </div> --}}
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


