@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    My Profile
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="m-portlet  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <?php 
                                    if (!empty($sessionadmin->profile)) { ?>
                                        <img src="<?php echo asset('files/admin/' . $sessionadmin->profile) ?>" alt="" width="100px"/>
                                    <?php } else { ?>
                                        <img src="<?php echo asset('admin/img/users/100_11.png') ?>" alt=""/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">
                                    <?php echo $sessionadmin->username; ?>
                                </span>
                                <?php echo $sessionadmin->email; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="m-portlet m-portlet--tabs ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Update Profile
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content clearfix">
                        <div class="tab-pane active clearfix" id="m_user_profile_tab_1">
                            <form class="m-form m-form--fit m-form--label-align-right validation-form" method="post" action="#" enctype="multipart/form-data">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <h3 class="m-form__section">
                                            <strong>Personal Details</strong>
                                        </h3>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-3 col-form-label">
                                            User Name
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input validate[required]"  autocomplete="off" name="username" type="text" value="<?php echo $sessionadmin->username; ?>">
                                            <?php echo csrf_field(); ?>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group m-form__group row">
                                        <label class="col-3 col-form-label">
                                            Email Address
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input validate[required,custom[email]]" autocomplete="off" type="text" name="email" value="<?php echo $sessionadmin->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-3 col-form-label">
                                            Profile
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input validate[custom[image]]" type="file" name="profile">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-8">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                    Save changes
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane clearfix" id="m_user_profile_tab_2">
                            <form class="m-form m-form--fit m-form--label-align-right validation-form" method="post" action="<?php echo url('/adminusers/changepassword/'); ?>">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <label class="col-3 col-form-label">
                                            Current Password
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input validate[required]" type="password" name="oldpassword"/>
                                            <?php echo csrf_field(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-3 col-form-label">
                                            New Password
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input validate[required,minSize[6]]" type="password" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-8">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                    Save changes
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
