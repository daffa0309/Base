<script>
    @if(Session::has('error-message'))
        $.toast().reset('all');
        $.toast({
            heading: "Oops!",
            text: "{{ Session::get('error-message') }}",
            position: 'top-right',
            loaderBg: '#bf441d',
            icon: 'error',
            hideAfter: 5000,
            stack: 1
        });
    @elseif(Session::has('success-message'))
        $.toast().reset('all');
        $.toast({
            heading: "Yeay!",
            text: "{{ Session::get('success-message') }}",
            position: 'top-right',
            loaderBg: '#1ABC9C',
            icon: 'success',
            hideAfter: 5000,
            stack: 1
        });
    @endif
</script>
