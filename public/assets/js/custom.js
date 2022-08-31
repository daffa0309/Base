function drawDatatable(selector) {
    $(selector).on('draw.dt', function () {
        if($('[data-toggle="tooltip"]').length > 0) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

function resetFormValidation(selector) {
    form = $(selector);

    $(selector).trigger('reset');
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.is-valid').removeClass('is-valid');
    form.find('.select2-container-error').removeClass('select2-container-error');
    form.find('span.invalid-feedback').remove();
}

$(document).on('click', '.btn-confirm', function (e) {

    e.preventDefault();

    form = $(this).parents('form');
    // alert(form);
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "apakah anda ingin melanjutkan proses ini?",
        icon: "warning",
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
