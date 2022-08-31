<div class="modal fade" id="add_menu_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Form Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="" class="needs-validation" novalidate="" method="POST" id="add_menu" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="POST">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3" >
                                <label class="col-form-label" for="recipient-name">Name</label><span class="text-danger">*</span>
                                <input class="form-control"  type="text" placeholder="Name" name="name" id="name"  required="">
                                <div class="invalid-feedback text-danger">Name wajib diisi!</div>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Parent ID</label> <span class="text-danger">*</span>
                                <select class="form-select parents" id="parent_id" name="parent_id" required="" >
                                    <option value="0" >Menu Utama</option>
                                    @foreach ($datas as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback text-danger">Parent ID wajib diisi!</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Value</label> <span class="text-danger">*</span>
                                <select class="form-select select-value" id="value" name="value"  required="" >
                                    <option value="0">Pilih Value</option>
                                    <option value="1">No. Prov</option>
                                    <option value="2">No. Kab</option>
                                </select>
                                <div class="invalid-feedback text-danger">Value wajib diisi!</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Url Website</label> <span class="text-danger">*</span>
                                <input class="form-control" type="text" placeholder="Url Website" name="url" id="url"  required="">
                                <div class="invalid-feedback text-danger">Url Website wajib diisi! jika tidak ada harap diisi dengan #</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Akses Role</label> <span class="text-danger">*</span>
                                <select class="form-select select-role" id="role" multiple="multiple" name="role[]" required="" >
                                    <option value="">Pilih Value</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback text-danger">Akses Role wajib diisi!</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Url Tableau</label> <span class="text-danger">*</span>
                                <input class="form-control" type="text" placeholder="Urlview Tableau" name="urlview" id="urlview"  required="">
                                <div class="invalid-feedback text-danger">Url Tableau wajib diisi! Jika tidak ada harap diisi dengan #</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="inputPassword3">Number</label>
                                <input class="form-control" id="no" name="no" type="number"  min="0" placeholder="Number">
                                <div class="valid-feedback ">Optional</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Site</label>
                                <select class="form-select" name="site_id" id="site_id" required="">
                                    <option selected="" disabled="" value="0">Pilih Sites</option>
                                    <option  value="1">Developers</option>
                                    <option  value="2">Sales</option>
                                </select>
                                <div class="invalid-feedback text-danger">Site wajib diisi!</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Hide</label> <span class="text-danger">*</span>
                                <select class="form-select" name="hide" id="hide"  required="">
                                    <option value="">Pilih Hide</option>
                                    <option  value="1">Sembunyikan</option>
                                    <option  value="0">Tampilkan</option>
                                </select>
                                <div class="invalid-feedback text-danger">Hide wajib diisi!</div>
                            </div>
                            <div class="mb-3 icon" >
                                <label class="col-form-label" for="recipient-name">Icon</label><span class="text-danger">*</span>
                                <input class="form-control"  type="text" placeholder="Icon" name="icon" id="icon"  >
                                <div class="invalid-feedback text-danger">Icon wajib diisi!</div>
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


