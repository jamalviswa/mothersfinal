<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link rel="icon" href="{{ URL::asset('/admin/img/load.png') }}" type="image/png" sizes="16x16">
        <link href="{{ URL::asset('/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('/admin/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('/admin/css/validationEngine.jquery.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('/admin/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('/admin/css/custom.css') }}" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
WebFont.load({
    google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
    active: function () {
        sessionStorage.fonts = true;
    }
});
        </script>

        <script src="{{ URL::asset('/admin/js/vendors.bundle.js') }}"></script>
        <script src="{{ URL::asset('/admin/js/scripts.bundle.js') }}"></script>
        <script src="{{ URL::asset('/admin/js/login.js') }}"></script>
        <script src="{{ URL::asset('/admin/js/sweetalert.min.js') }}"></script>
        <script src="{{ URL::asset('/admin/js/jquery.validationEngine.js') }}"></script>
        <script src="{{ URL::asset('/admin/js/jquery.validationEngine-en.js') }}"></script>
        <title>Mother's Village</title>
    </head>
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <?php
        if (session()->has('message')) {
            $success = session()->get('message');
            $type = session()->get('alert-class');
            ?>
            <script>
    swal("Failed!", "<?php echo $success; ?>", "<?php echo $type; ?>");
            </script>
        <?php }
        ?>
        @yield('content')
    </body>
    <script>
        $('.validation-form').validationEngine({promptPosition: "bottomLeft", scroll: false});
    </script>
    <!-- begin::Quick Nav -->
</html>