@extends('layouts.partials.app')

{{-- @section('title', 'User Management')
@endsection --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2/select2.min.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Menu</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Edit Menu</li>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- Zero Configuration  Starts-->
		<div class="col-sm-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h5>Custom styles</h5><span>For custom Bootstrap form validation messages, you’ll need to add the <code class="text-danger">novalidate</code> boolean attribute to your <code class="text-danger">&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. Try to submit the form below; our JavaScript will intercept the submit button and relay feedback to you.</span><span>When attempting to submit, you’ll see the <code class="text-danger">:invalid </code> and <code class="text-danger">:valid </code> styles applied to your form controls.</span>
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('menu.update', $menu->id) }}" class="needs-validation" novalidate="" method="POST" >
                        @csrf
                        @method('PATCH')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ $menu->name }}" required="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="parent_id">Parent</label>
                                <select class="form-select parents" id="parent_id" name="parent_id" required="">
                                    <option value="0">Menu Utama</option>
                                    @foreach ($parent as $item)
                                        <option  value="{{ $item->id }}" {{ $menu->parent_id == $item->id ? 'selected' : '' }}>{{  $item->name  }}</option>
                                    @endforeach
                                </select>

                                {{-- <input class="form-control" id="parent_id" name="parent_id" type="text" value="{{ $menu->parent_id }}" required="">
                                <div class="valid-feedback">Looks good!</div> --}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="url">Url Website</label>
                                <input class="form-control" id="url" name="url" type="text" value="{{ $menu->url }}" required="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="urlview">Url Tableau</label>
                                <input class="form-control" id="urlview" name="urlview" type="text" value="{{ $menu->urlview }}" required="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="site_id">Site</label>
                                <select class="form-select" id="site_id" name="site_id" required="" >
                                    <option value="0">Pilih Site</option>
                                    <option value="1" {{ $menu->site_id == 1 ? 'selected' : '' }}>No. Prov</option>
                                    <option value="2" {{ $menu->site_id == 2 ? 'selected' : '' }}>No. Kab</option>
                                </select>

                                {{-- <input class="form-control" id="site_id" name="site_id" type="text" value="{{ $menu->site_id }}" required="">
                                <div class="valid-feedback">Looks good!</div> --}}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="no">No</label>
                                <input class="form-control" id="no" type="number" name="no" min="0" value="{{ $menu->no }}" required="">
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="hide">Hide</label>
                                <select class="form-select" id="hide" name="hide" required="" >
                                    <option value="99">Pilih Site</option>
                                    <option value="1" {{ $menu->hide == 1 ? 'selected' : '' }}>Ditampilkan</option>
                                    <option value="0" {{ $menu->hide == 0 ? 'selected' : '' }}>Tersembunyi</option>
                                </select>
                                {{-- <input class="form-control" id="hide" type="text" name="hide" value="{{ $menu->hide }}" required=""> --}}
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                                <div class="col-md-3 icon">
                                    <label class="form-label" for="icon">Icon</label>
                                    <input class="form-control" id="icon" name="icon" type="text" value="{{ $menu->icon }}" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            <div class="col-md-12">
                                <label class="form-label" for="role">Akses Role</label>
                                <select class="form-select select-role" id="role" multiple="multiple" name="role[]" required="" >
                                    <option value="">Pilih Akses Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $menu->roles->where('id', $role->id)->count() > 0 ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary mt-1" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
		</div>
		<!-- Zero Configuration  Ends-->
		<!-- Feature Unable /Disable Order Starts-->
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/vendors/select2/select2.full.min.js') }}"></script>

<script>
    parent = $('.select-role').find('form');
    $('.select-role').select2({
        // dropdownParent: $('#role'),
        placeholder: "Pilih Akses Role",
        tags: true,
    });

</script>


@endsection
