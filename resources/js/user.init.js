function UserIndex(urlDatatable){
    $(document).ready(function(){
        var table = $("#user-datatable").DataTable({
            "lengthMenu": [
                [ 10, 25, 50, 100, -1 ],
                [ '10', '25', '50', '100','All' ]
            ],
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: urlDatatable,
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'username', name: 'username'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role_id', name: 'role_id', searchable: false},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false,visible:true, searchable: false,  exportable: false, printable:false},
                // {data: 'created_at', name: 'created_at', searchable: false, visible: false, exportable: false, printable:false}
            ],
            'searchDelay': 1000,
            scrollX:!0,
            language: {
                paginate: {previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}
            },
        });


        drawDatatable("#user-datatable");

        $('table').delegate('.btn-detail', 'click',  function(e){
            e.preventDefault();
            let url = $(this).data('url');
            // alert(url);

            $.get(url)
                .done(function (data) {
                    $(".td-name").html(data.name);
                    $(".td-username").html(data.username);
                    $(".td-email").html(data.email);
                    $(".td-foto").html(data.foto);
                    $(".td-whatsapp").html(data.whatsapp);
                    $(".td-slack").html(data.slack);
                    $(".td-status").html(data.status);
                    $(".td-value").html(data.value);
                    $(".td-role_id").html(data.role_name.name);

                    $('#detail_user_modal').modal('show');
                })
                .fail(function (data) {
                    Swal.fire({
                        title:"Oops!",
                        text:data.responseJSON,
                        type:"error",
                        confirmButtonClass:"btn btn-primary mt-2"
                    });
                });
        });

        $('table').delegate('.btn-edit','click', function (e) {
            e.preventDefault();

            resetFormValidation('#add_user');

            let url = $(this).data('url');
            // alert(url);

            $.get(url)
                .done(function (data) {
                    // $("input#foto").val(data.foto);
                    $("input#username").val(data.username);
                    $("input#name").val(data.name);
                    $("input#email").val(data.email);
                    $("input#whatsapp").val(data.whatsapp);
                    $("input#slack").val(data.slack);
                    $("#role_id").val(data.role_id);
                    $("#value").val(data.value);

                    $('#add_user').attr('action', url);
                    $('#_method').val('PATCH');

                    $('#add_user_modal').modal('show');
                })
                .fail(function (data) {
                    Swal.fire({
                        title:"Oops!",
                        text:data.responseJSON,
                        type:"error",
                        confirmButtonClass:"btn btn-primary mt-2"
                    });
                });
        });


        $('.btn-confirm').on('click', function (e) {

            e.preventDefault();

            form = $(this).parents('form');

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "apakah anda ingin melanjutkan proses ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Tidak",
                confirmButtonText: "Ya, lanjutkan!"
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                }
            });
        });

    });
}


$(document).ready(function() {

    $('#create_user').on('click', function (e) {
        e.preventDefault();

        resetFormValidation('#add_user');
        let url = $(this).data('url');
        // alert(url);
        $('#add_user').attr('action', url);
        $('#_method').val('POST');

        $('#add_user_modal').modal('show');
    });
});


// function CompanyIndex (ownerUrl) {
//     $(document).ready(function () {

//         $('.select-owner').select2({
//             width: '100%',
//             ajax: {
//                 url: ownerUrl,
//                 dataType: 'json',
//                 data: function(params) {
//                     return {
//                         name: params.term || '',
//                         page: params.page || 1
//                     }
//                 },
//                 cache: false,
//                 delay: 300
//             }
//         });
//     })
// }
