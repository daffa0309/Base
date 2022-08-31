@extends('layouts.partials.app')

{{-- @section('title', 'User Management')
@endsection --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables/datatables.min.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Log Data</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Log Data</li>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- Zero Configuration  Starts-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="display datatables" id="custom-button" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Activity</th>
									<th>Module</th>
									<th>Url</th>
									<th>From</th>
									<th>Date</th>
									{{-- <th class="text-center">Aksi</th> --}}
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Zero Configuration  Ends-->
		<!-- Feature Unable /Disable Order Starts-->
	</div>
</div>

{{-- @include('layouts.pages.users._adduser') --}}
{{-- @include('layouts.pages.users._detailuser') --}}

@endsection

@section('script')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

<script src="{{ asset('assets/js/vendors/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/js/logs.init.js') }}"></script>

<script>
    LogsIndex("{{ route("log.datatable") }}");
</script>
@endsection
