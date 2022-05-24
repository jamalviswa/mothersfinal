@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Customer Info
                </h3>
            </div>
            <div>
                <a href="{{route('deletes.personal_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content application">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="j_head" style="background:#e51a4b;">Personal Details</h5>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                NAME OF THE APPLICANT
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->applicant_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICATION NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->application_number }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                DATE OF APPLICATION
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->date_of_application }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FATHER/SPOUSE NAME
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->fathers_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                AGE
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->age }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                GENDER
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->gender }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                MOBILE NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <span>
                                                    <?php
                                                    echo $detail['phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $detail['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                ALTERNATIVE MOBILE NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <span>
                                                    <?php
                                                    echo $detail['altphone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $detail['altphone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                EMAIL
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->email }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                OCCUPATION
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['occupation']) ? $detail['occupation'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                TOTAL YEARS OF EXPERIENCE
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['experience']) ? $detail['experience'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                RESIDENTIAL/ PERMANENT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['permanent_address']) ? $detail['permanent_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CORRESPONDANCE/ PRESENT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['present_address']) ? $detail['present_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                ANNUAL INCOME
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['income']) ? $detail['income'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PHOTO
                                            </label>
                                            <div class="col-md-8">
                                                <img width="100" height="100" src="<?php echo  asset('files/customers/' . $detail->photo) ?>">
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
<style>
    .j_head {
        color: #fff;
        padding-bottom: 14px;
        padding-top: 14px;
        padding-left: 14px;
        margin-bottom: 14px;
    }
</style>
@endsection