<header class="m-grid__item    m-header " data-minimize-mobile="hide" data-minimize-offset="200" data-minimize-mobile-offset="200" data-minimize="minimize">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="<?php echo url('/customers/index'); ?>" class="m-brand__logo-wrapper">
                            <img src="<?php echo asset("admin/img/logos/logo.png") ?>" />
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
                           ">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" style="display: none !important;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>
            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <!-- BEGIN: Horizontal Menu -->
                <!-- END: Horizontal Menu -->
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li id="m_quick_sidebar_toggle" class="m-nav__item"><span class="m-topbar__userpic">
                                    <?php $profile = (!empty($sessionadmin->profile)) ? asset('files/admin/' . $sessionadmin->profile) : asset('admin/img/users/100_11.png') ?>
                                    <img src="<?php echo $profile; ?>" class="m--img-rounded m--marginless m--img-centered" alt="" height="60px" style="margin-top:5px !important">
                                </span>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item nava">
                                <a href="<?php echo url('/adminusers/profile'); ?>" class="m-nav__link m-dropdown__toggle">
                                    <?php echo $sessionadmin->username; ?>
                                </a>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item nava">
                                <a href="<?php echo url('/adminusers/logout'); ?>" class="m-nav__link m-dropdown__toggle">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are You Sure, Do you want Delete this Record?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a class="btn btn-primary" href="javascript:;">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are You Sure, Do you want Add this Record?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <button class="btn btn-primary" name="javascript:;" type="button">Yes</button>
               
            </div>
        </div>
    </div>
</div> -->

<script>
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#deleteModal').modal('show');
        $('#deleteModal').find('.btn-primary').attr('href', $(this).attr('href'));
    });
</script>

<!-- <script>
    $(document).on('click', '#j_sub', function(e) {
        e.preventDefault();
        $('#addModal').modal('show');
        $('#addModal').find('.btn-primary').attr('submit', $(this).attr('submit'));
    });
</script> -->
<style>
    .notify {
        border-radius: 50%;
        padding: 3px;
        font-size: 12px;
        background: red;
        color: white;
        position: relative;
        right: 15px;
        bottom: 11px;
    }

    .nav-link.dropdown-toggle::after,
    .btn.dropdown-toggle::after {
        display: none;

    }

    .dropdown-item:hover {
        background: #0054ac;
        color: white;
    }
</style>