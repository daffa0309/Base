@extends('layouts.partials.app')

{{-- @section('title', 'User Management')
@endsection --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables/datatables.min.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Profile User </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Profile User </li>
@endsection


@section('content')
<div class="container-fluid">
    <div class="edit-profile">
    <div class="row">
        <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                <div class="profile-title">
                    <div class="media row g-0 align-items-center" style="margin-bottom: 30px;">
                        <img class="col-auto rounded-circle" style="width: 70px; height: 70px;" alt="" src="{{ auth()->user()->foto == null ? Storage::disk('local')->url('public/users/user.png')  : Storage::disk('local')->url('public/users/' . auth()->user()->id . '/' . auth()->user()->foto ) }}">
                        <div class="media-body col" style="margin-left: 25px;">
                            <h5 class="mb-1">{{ Auth()->user()->name }}</h5>
                            <p>{{ Auth()->user()->username }}</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-footer text-center">
                <button class="btn btn-primary btn-block" class="btn btn-primary" type="submit" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Ubah Profile</button>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-8">
        <form action="{{ route('profile.update', Auth()->user()->id) }}" method="POST" class="card" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Username:</label><span class="text-danger">*</span>
                    <input class="form-control " type="text" placeholder="Username" name="username" id="username" required="" value="{{ Auth()->user()->username }}">
                    <div class="invalid-feedback text-danger">Username wajib diisi!</div>
                </div>
                </div>
                <div class="col-sm-4 col-md-4">
                <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Name:</label><span class="text-danger">*</span>
                    <input class="form-control" type="text" placeholder="Name" name="name" id="name"  required="" value="{{ Auth()->user()->name }}">
                    <div class="invalid-feedback text-danger">Name wajib diisi!</div>
                </div>
                </div>
                <div class="col-sm-4 col-md-4">
                <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Email:</label><span class="text-danger">*</span>
                    <input class="form-control" type="text" placeholder="Email" name="email" id="email"  required="" value="{{ Auth()->user()->email }}">
                    <div class="invalid-feedback text-danger">Email wajib diisi!</div>
                </div>
                </div>
                <div class="col-sm-6 col-md-6">
                <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Whatsapp:</label>
                    <input class="form-control" type="text" placeholder="Whatsapp" name="whatsapp" id="whatsapp" value="{{ Auth()->user()->whatsapp }}" >
                    <div class="valid-feedback">Optional</div>
                </div>
                </div>
                <div class="col-sm-6 col-md-6">
                <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Slack:</label>
                    <input class="form-control" type="text" placeholder="Slack" name="slack" id="slack" value="{{ Auth()->user()->slack }}" >
                    <div class="valid-feedback">Optional</div>
                </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- Container-fluid Ends-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Foto</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('profile.store', Auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <input class="form-control photo" type="file" name="photo" aria-label="file example" required="">
                <div class="valid-feedback">Optional</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>



@endsection

@section('script')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

<script src="{{ asset('assets/js/vendors/datatables/datatables.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/tooltip.init.js') }}"></script> -->
<script src="{{asset('assets/js/logs.init.js')}}"></script>

<script>
    LogsIndex("{{ route("log.datatable") }}");
</script>
@endsection
