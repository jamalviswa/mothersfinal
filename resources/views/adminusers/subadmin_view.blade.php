@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Sub Admin Info
                </h3>
            </div>
            <div>
                <a href="{{route('adminusers.subadmin_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="text-center profile">
                                    <a href="{{URL::to('/files/admin/'.$detail['profile'].'')}}" target="_blank">
                                        <img src="{{ (!empty($detail['profile'])) ? URL::to('files/admin/'.$detail['profile'].'') :  asset('admin/img/myprofile.png') }}">
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="offset-4 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                User Name
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo $detail['username']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Email
                                            </label>
                                            <div class="col-md-6">
                                                <?php echo $detail['email']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Admin Type
                                            </label>
                                            <div class="col-md-6">
                                                <?php echo $detail['adminname']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Password
                                            </label>
                                            <div class="col-md-6">
                                                <?php echo $detail['password_text']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection