<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link rel="icon" href="{{ URL::asset('admin/img/load.png') }}" type="image/png" sizes="16x16">
        <link href="{{ URL::asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/validationEngine.jquery.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/jquery.emojipicker.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('admin/css/jquery.emojipicker.tw.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"/>
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css"/>
       
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
WebFont.load({
    google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
    active: function() {
        sessionStorage.fonts = true;
    }
});
        </script>
        <script src="{{ URL::asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('admin/js/vendors.bundle.js') }}"></script>
        <script src="{{ URL::asset('admin/js/scripts.bundle.js') }}"></script>
        <script src="{{ URL::asset('admin/js/login.js') }}"></script>
        <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
        <script src="{{ URL::asset('admin/js/jquery.validationEngine.js') }}"></script>
        <script src="{{ URL::asset('admin/js/jquery.validationEngine-en.js') }}"></script>
        <script src="{{ URL::asset('admin/js/jquery.emojipicker.js') }}"></script>
        <script src="{{ URL::asset('admin/js/jquery.emojis.js') }}"></script>
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.min.js"></script>
       
       
        <title>Mother's Village</title>
    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default "  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            @include('header')
            <!-- END: Header -->
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->
                <!-- BEGIN: Header -->
                @include('sidebar')
                <!-- END: Header -->
                <!-- begin::Body -->
                <?php
                if (session()->has('message')) {
                    $success = session()->get('message');
                    $type = session()->get('alert-class');
                    ?>
                    <script>
    swal({
        title: "<?php echo ($type == 'success') ? 'Success' : "Error" ?>",
        text: "<?php echo $success; ?>",
        type: "<?php echo $type; ?>",
        showCancelButton: false,
        showConfirmButton: false,
        timer: 2000
    });
                    </script>
                <?php }
                ?>
                @yield('content')
                <!-- end:: Body -->
                <!-- begin::Footer -->
            </div>
            @yield('footer')
            <!-- end::Footer -->
        </div>
        <!-- end::Quick Sidebar -->
        <!-- begin::Scroll Top -->
        <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- begin::Quick Nav -->
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are You Sure, Do you want Delete this Record ?</p>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary m-btn m-btn--air m-btn--custom" data-dismiss="modal">No</a>
                        <a type="button" class="btn btn-accent m-btn m-btn--air m-btn--custom delete" href="">Yes 12</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to upgrade event?</p>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary m-btn m-btn--air m-btn--custom" data-dismiss="modal">No</a>
                        <a type="button" class="btn btn-accent m-btn m-btn--air m-btn--custom delete" href="">Yes</a>
                    </div>
                </div>
            </div>
        </div>
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
        $(document).on('click', '.delete_dialog,.delconfirm', function(e) {
            e.preventDefault();
            $('#deleteModal .delete').attr('href', $(this).attr('href'));
            $('#deleteModal').modal('show');
        });
        
        $(document).on('click', '.upgradeconfirm', function(e) {
            e.preventDefault();
            $('#upgradeModal .delete').attr('href', $(this).attr('href'));
            $('#upgradeModal').modal('show');
        });
        
        
        $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true});
       
        $(".m-select2").select2();
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/jquery.ui.widget.min.js"></script>
    <script>
        $(function() {
            $("[rel='tooltip']").tooltip();
        });
    </script>
    <script>
        $('.timepicker').timepicker({
            icons: {
                up: "la la-chevron-circle-up",
                down: "la la-chevron-circle-down",
                next: 'la la-chevron-circle-right',
                previous: 'la la-chevron-circle-left'
            }
        });
        $('.summernote').summernote();
    </script>
</html>