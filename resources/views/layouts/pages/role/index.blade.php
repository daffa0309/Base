@extends('layouts.partials.app')

{{-- @section('title', 'User Management')
@endsection --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables/datatables.min.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>User Roles</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">User Roles</li>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- Zero Configuration  Starts-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            {{-- <button class="btn btn-primary" type="button" >Export PDF</button> --}}
                            {{-- <button class="btn btn-primary" type="button" >Open modal for @mdo</button> --}}
                        </div>
                        <div class="justify-content-end col-2">

                            <button class="btn btn-primary" data-url="{{ route('role.index') }}" type="button" id="create_roles">Tambah Role</button>
                        </div>
                    </div>


                    {{--<h5>Zero Configuration</h5>
					<span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span> --}}
				</div>
				<div class="card-body">
					<div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 45%">Name</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td  class="text-center">
                                            {{-- <a href='javascript:void(0);' style='margin:3px'  class='btn btn-primary btn-detail btn-xs'>Detail</a> --}}
                                            <a href='javascript:void(0);' style='margin:3px' data-url = {{route('role.detail', $data->id)}}  class='btn btn-warning btn-edit btn-xs'>Edit</a>
                                            <form action="{{ route('role.destroy', $data->id) }}" method="POST" enctype="multipart/form-data" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <a href='javascript:void(0);' style='margin:3px'  class='btn btn-danger btn-confirm btn-delete btn-xs'>Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
		<!-- Zero Configuration  Ends-->
		<!-- Feature Unable /Disable Order Starts-->
	</div>
</div>

@include('layouts.pages.role._addroles')
@include('layouts.pages.role._detailroles')

@endsection

@section('script')

<script src="{{asset('assets/js/role.init.js')}}"></script>
<script>
    parent = $('.select-role').find('form');
    // Bind an event

    $('.select-role').select2({
        dropdownParent: $('#add_menu_modal'),
        placeholder: "Pilih Akses Role",
        tags: true,
        // tokenSeparators: [',', ' ']
    });


</script>

@endsection
