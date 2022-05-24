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
                <a href="{{route('customers.personal_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                            <label class="col-md-4 offset-md-1">
                                                Name of the Applicant
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->applicant_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Application Number
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->application_number }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Date of Application
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->date_of_application }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Father/Spouse Name
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->fathers_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Age
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->age }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Gender
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->gender }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Mobile Number
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
                                            <label class="col-md-4 offset-md-1">
                                                Alternative Mobile Number
                                            </label>
                                            <div class="col-md-5">
                                                <span>
                                                    <?php
                                                    if (!empty($detail['altphone'])) {
                                                        echo $detail['altphone_code'] . ' ';
                                                    ?>
                                                </span>
                                            <?php echo $detail['altphone'];
                                                    } else {
                                                        echo "-";
                                                    }
                                            ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Email
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->email }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Occupation
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['occupation']) ? $detail['occupation'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Total Years of Experience
                                            </label>
                                            <div class="col-md-5">
                                                <?php
                                                if (!empty($detail->experience)) {
                                                    echo $detail->experience . " Years";
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Residential/Permanent Address
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['permanent_address']) ? $detail['permanent_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Correspondance/Present Address
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['present_address']) ? $detail['present_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Annual Income
                                            </label>
                                            <div class="col-md-5">
                                                <?php
                                                if (!empty($detail->income)) {
                                                    echo "Rs. " . $detail->income;
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1">
                                                Photo
                                            </label>
                                            <div class="col-md-7">
                                                <?php if (!empty($detail['photo'])) { ?>
                                                    <a href="{{URL::to('/files/customers/'.$detail['photo'].'')}}" target="_blank"><img src="{{URL::to('/files/customers/'.$detail['photo'].'')}}" width="100" height="100" />
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="{{URL::to('/files/customers/user.png')}}" target="_blank"><img src="{{URL::to('/files/customers/user.png')}}" width="100" height="100" />
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="download_pdf">
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download" href="{{ route('customers.personal_invoicepdf',$detail['customer_id']) }}" target="_blank" download>
                                                Download PDF<i style="color: white;font-size: 18px !important;" class="fa fa-download"></i>
                                            </a>
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

    .download_pdf {
        margin-top: 24px;
        text-align: right;
    }

    .btn.btn-secondary.m-btn.m-btn--air.m-btn--custom {
        padding: 17px;
        background: #0054ac;
        color: white;
        border-radius: 0px;
    }
</style>
@endsection