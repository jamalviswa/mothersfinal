<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link href="{{ URL::asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/validationEngine.jquery.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ URL::asset('css/jquery.emojipicker.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/jquery.emojipicker.tw.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
WebFont.load({
    google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
    active: function () {
        sessionStorage.fonts = true;
    }
});
        </script>

        <script src="{{ URL::asset('js/vendors.bundle.js') }}"></script>
        <script src="{{ URL::asset('js/scripts.bundle.js') }}"></script>
        <script src="{{ URL::asset('js/login.js') }}"></script>
        <script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.validationEngine.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.validationEngine-en.js') }}"></script>

        <script src="{{ URL::asset('js/jquery.emojipicker.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.emojis.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.min.js"></script>
        <title>Love Express - Admin</title>
    </head>

    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default "  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <!-- END: Header -->
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->

                <?php
                if (session()->has('message')) {
                    $success = session()->get('message');
                    $type = session()->get('alert-class');
                    ?>
                    <script>
    swal("Success!", "<?php echo $success; ?>", "<?php echo $type; ?>");
                    </script>
                <?php }
                ?>
                @yield('content');
                <!-- end:: Body -->
                <!-- begin::Footer -->
            </div>
            <!-- end::Footer -->
        </div>

        <!-- end::Quick Sidebar -->
        <!-- begin::Scroll Top -->

        <!-- begin::Quick Nav -->
        <!-- Modal -->

    </body>
    <style>
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active) > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item.m-menu__item--open > .m-menu__heading .m-menu__link-text, .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav > .m-menu__item.m-menu__item--open > .m-menu__link .m-menu__link-text {
            color: #b2b6d4;
        }
        .-label {
            display: none;
        }
    </style>
    <script>
        $('.validation-form').validationEngine();
        $('.validation_form').validationEngine();
        $(document).on('click', '.delete_dialog,.delconfirm', function (e) {
            e.preventDefault();
            $('#deleteModal .delete').attr('href', $(this).attr('href'));
            $('#deleteModal').modal('show');
        });

        $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true});
        $('#data-table').dataTable({
            "ordering": false
        });
        $(".m-select2").select2();
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/jquery.ui.widget.min.js"></script>
    <script>
        $(function () {
            $("[rel='tooltip']").tooltip();
        });
    </script>

    <script>
        $('.timepicker').timepicker();
        $('.summernote').summernote();

    </script>
</html>