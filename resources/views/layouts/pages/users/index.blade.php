@extends('layouts.partials.app')

{{-- @section('title', 'User Management')
@endsection --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables/datatables.min.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>User Management</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">User Management</li>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- Zero Configuration  Starts-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">

                    <div class="row">
                        <form action="{{ route('user.export') }}" method="POST"  class="form-inline row align-items-center" >
                            @csrf
                            <div class="col-md-3 px-2 py-2">
                                <select class="form-select" size="1" name="filter">
                                    <option>Export PDF Filter by Role</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit" id="ad">Export PDF</button>
                            </div>
                            <div class="col-sm-4 text-end "  >
                                <button class="btn btn-primary" data-url="{{ route('user.index') }}" type="button" id="create_user">Tambah User</button>
                            </div>
                        </form>
                    </div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
                        {{-- <form action="" class="form-inline">
                            <div class="col-md-3 px-2 py-2">
                                <select class="form-select" size="1">
                                    <option>Export PDF Filter by Role</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="button" id="create_user">Export PDF</button>
                            </div>
                        </form> --}}

						<table class="display datatables" id="user-datatable" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Status</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
                            {{-- <tbody>
                                @foreach ($datas as $item)
                                <tr>
                                    <td>No</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role_id }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-center">Aksi</td>
                                </tr>
                                @endforeach
                            </tbody> --}}
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Zero Configuration  Ends-->
		<!-- Feature Unable /Disable Order Starts-->
	</div>
</div>

@include('layouts.pages.users._adduser')
@include('layouts.pages.users._detailuser')

@endsection

@section('script')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

<script src="{{ asset('assets/js/vendors/datatables/datatables.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/tooltip.init.js') }}"></script> -->
<script src="{{asset('assets/js/user.init.js')}}"></script>
<script>
    UserIndex("{{ route("user.datatable") }}");
</script>
@endsection
