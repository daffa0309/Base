function MenuIndex(urlDatatable) {
    $(document).ready(function(){
        var table = $("#menu-datatable").DataTable({
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
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false, visible: false}
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

    $('#create_roles').on('click', function (e) {
        e.preventDefault();

        resetFormValidation('#add_role');
        let url = $(this).data('url');
        // alert(url);
        $('#add_role').attr('action', url);
        $('#_method').val('POST');

        $('#add_role_modal').modal('show');
    });
});

$('.btn-edit').on('click', function (e) {
    e.preventDefault();

    let url = $(this).data('url');
    // alert(url);

    $.get(url)
        .done(function (data) {
            $("input#name").val(data.name);
            $('#add_role').attr('action', url);
            $('#_method').val('PATCH');

            $('#add_role_modal').modal('show');
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

