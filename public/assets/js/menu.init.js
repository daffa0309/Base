function MenuIndex(urlDatatable) {
    $(document).ready(function(){
        var table = $("#menu-datatable").DataTable({
            // bLengthChange: false,
            dom: 'lBfrtip',
            buttons: {
                dom: {
                    button: {
                      className: ''
                    }
                  },
                  buttons: [
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        },
                        className: 'btn btn-primary btn-sm'
                    },
                    // 'copy', 'excel', 'pdf', 'csv', 'print'
                ],
            },
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
                {data: 'name', name: 'name'},
                {data: 'ref', name: 'ref'},
                {data: 'url', name: 'url'},
                {data: 'urlview', name: 'urlview', searchable: false},
                {data: 'parent_id', name: 'parent_id'},
                {data: 'icon', name: 'icon'},
                {data: 'action', name: 'action',  orderable: false, searchable: false},
                // {data: 'created_at', name: 'created_at', searchable: false, visible: false}
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                // { "width": "20%", "targets": 1 },
                { "width": "15%", "targets": 3 },
                { "width": "20%", "targets": 4 },
                { "width": "5%", "targets": 5 },
                { "width": "5%", "targets": 6 },
                { "width": "50%", "targets": 6 },
            ],
            'searchDelay': 1000,
            scrollX:!0,
            language: {
                paginate: {previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}
            },
        });

        drawDatatable("#menu-datatable");
    });

    $('table').delegate('.btn-detail','click', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        // alert(url);
        var p = '';

        $(".td-role").empty();


        $.get(url)
            .done(function (data) {
                $(".td-name").html(data.name);
                $(".td-ref").html(data.ref);
                $(".td-email").html(data.email);
                $(".td-url").html(data.url);
                $(".td-urlview").html(data.urlview);
                $(".td-parent").html(data.parent_id);
                $(".td-value").html(data.value);
                $(".td-site_id").html(data.site_id);
                $(".td-no").html(data.no);
                $.each(data.role_name, function (key, value) {
                    if (key >= 0) {
                        p =  value.name + ' ,'
                    }
                    $(".td-role").append(p);
                    // console.log(p);
                });
                // $(".td-role").html(data.role_name);
                // alert(data.role_name);

                $('#detail_menu_modal').modal('show');
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
}

$(document).ready(function() {

    $('#create_menu').on('click', function (e) {
        e.preventDefault();

        resetFormValidation('#add_menu');
        // resetFormValidation('#add_menu');
        let url = $(this).data('url');
        // alert(url);
        $('#add_menu').attr('action', url);
        $('#_method').val('POST');

        $('#add_menu_modal').modal('show');
    });
});


// function RoleIndex(roleUrl) {
//     $(document).ready(function () {
//         $('.select-role').select2({
//             width: '100%',
//             ajax: {
//                 url: roleUrl,
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

    // $('table').delegate('.btn-edit','click', function (e) {
    //     e.preventDefault();

    //     let url = $(this).data('url');
    //     $.get(url)
    //         .done(function (data) {
    //             $("input#name").val(data.name);
    //             $("input#ref").val(data.ref);
    //             $("input#url").val(data.url);
    //             $("input#urlview").val(data.urlview);
    //             $("input#icon").val(data.icon);

    //             $("#parent_id option:selected").val(data.parent_id);

    //             $('#add_menu').attr('action', url);
    //             $('#_method').val('PATCH');

    //             $('#add_menu_modal').modal('show');
    //         })
    //         .fail(function (data) {
    //             Swal.fire({
    //                 title:"Oops!",
    //                 text:data.responseJSON,
    //                 type:"error",
    //                 confirmButtonClass:"btn btn-primary mt-2"
    //             });
    //         });
    // });

