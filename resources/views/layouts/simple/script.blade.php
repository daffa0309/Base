<script src="{{ asset('assets/js/vendors/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/vendors/feather-icons/feather.min.js') }}"></script>
<script>
    feather.replace()
</script>
<!-- scrollbar js-->
<script src="{{ asset('assets/js/vendors/simplebar/simplebar.min.js') }}"></script>
<script>

</script>

<!-- Validation jquery-->
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/vendors/sweetalert/sweetalert.all.js') }}"></script>

<!-- Plugins JS start-->
<script id="menu" src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@yield('script')

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
$(document).ready(function() {
    $('#changepass').on('click', function (e) {
        e.preventDefault();
        resetFormValidation('#form_changepass');

        $('#add_change_modal').modal('show');
    });
});

</script>
