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
<h3>Menu Management</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Menu Management</li>
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
                        </div>
                        <div class="justify-content-end col-2">
                            <button class="btn btn-primary" data-url="{{ route('menu.index') }}" type="button" id="create_menu">Tambah Menu</button>
                        </div>
                    </div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="display datatables" id="menu-datatable" style="width:100%">
							<thead>
								<tr>
									<th >No</th>
									<th style="width: 10%">Name</th>
									<th style="width: 5%">Ref</th>
									<th style="width: 5%">Url Website</th>
									<th style="width: 5%">Url Tableau</th>
									<th class="text-center">Parent</th>
									<th>Icon</th>
									<th class="text-center" style="width: 20%">Aksi</th>
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


@include('layouts.pages.menu._addmenu')
@include('layouts.pages.menu._detailmenu')

@endsection

@section('script')
<script src="{{ asset('assets/js/vendors/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('assets/js/vendors/datatables/datatables.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/tooltip.init.js') }}"></script> -->
<script src="{{asset('assets/js/menu.init.js')}}"></script>
<script>
    MenuIndex("{{ route("menu.datatable") }}");
</script>

<script>
    parent = $('.select-role').find('form');
    // Bind an event

    $('.select-role').select2({
        dropdownParent: $('#add_menu_modal'),
        placeholder: "Pilih Akses Role",
        tags: true,
        // tokenSeparators: [',', ' ']
    });

    $('.parents').on('change', function(){
        val = $(this).val();

        if (val != 0 ) {
            $(".icon").attr("style", "display: none");
        } else {
            $(".icon").attr("style", "display: block");
        }

        // alert(val);
    });

	// if($('[data-toggle="select2"]').length) {
    //     if($(".add_menu_modal").length) {
    //         parent = $(".add_menu_modal").find('form');
    //         $('.add_menu_modal [data-toggle="select2"]').select2({ width: '100%', dropdownParent: parent});
    //     }
    //     else {
    //         $('[data-toggle="select2"]').select2({ width: '100%' });
    //     }
    // }
</script>

@endsection
