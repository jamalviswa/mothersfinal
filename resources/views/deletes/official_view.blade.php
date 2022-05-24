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
                <a href="{{route('deletes.official_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                        <h5 class="j_head" style="background:#e51a4b;">PERSONAL DETAILS</h5>
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
                                        <?php
                                        $customer = App\Customer::where('customer_id', $detail['customer_id'])->first();
                                       
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FATHER/SPOUSE NAME
                                            </label>
                                            <div class="col-md-5">
                                                {{ $customer->fathers_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                AGE
                                            </label>
                                            <div class="col-md-5">
                                                {{ $customer->age }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                GENDER
                                            </label>
                                            <div class="col-md-5">
                                                {{ $customer->gender }}
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
                                                    echo $customer['altphone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $customer['altphone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                EMAIL
                                            </label>
                                            <div class="col-md-5">
                                                {{ $customer->email }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                OCCUPATION
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($customer['occupation']) ? $customer['occupation'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                TOTAL YEARS OF EXPERIENCE
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($customer['experience']) ? $customer['experience'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                RESIDENTIAL/ PERMANENT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($customer['permanent_address']) ? $customer['permanent_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CORRESPONDANCE/ PRESENT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($customer['present_address']) ? $customer['present_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                ANNUAL INCOME
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($customer['income']) ? $customer['income'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PHOTO
                                            </label>
                                            <div class="col-md-8">
                                                <img width="100" height="100" src="<?php echo  asset('files/customers/' . $customer->photo) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="j_head" style="background:#f4972f;">DOCUMENT DETAILS</h5>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT NAME
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['co_applicant_name']) ? $detail['co_applicant_name'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT MAIL ID
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coapp_email']) ? $detail['coapp_email'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coapp_address']) ? $detail['coapp_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT MOBILE NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <span>
                                                    <?php
                                                    echo $detail['coapp_phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $detail['coapp_phone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT AADHAR NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['aadhar_number']) ? $detail['aadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT AADHAR
                                            </label>
                                            <?php if (!empty($detail['aadhar'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['aadhar'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['aadhar'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PAN NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['pan_number']) ? $detail['pan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PAN CARD
                                            </label>
                                            <?php if (!empty($detail['pan'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['pan'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['pan'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PASSPORT NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['passport_number']) ? $detail['passport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PASSPORT
                                            </label>
                                            <?php if (!empty($detail['passport'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['passport'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['passport'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT AADHAR NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coaadhar_number']) ? $detail['coaadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT AADHAR
                                            </label>
                                            <?php if (!empty($detail['coaadhar'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['coaadhar'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['coaadhar'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PAN NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['copan_number']) ? $detail['copan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PAN CARD
                                            </label>
                                            <?php if (!empty($detail['copan'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['copan'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['copan'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PASSPORT NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['copassport_number']) ? $detail['copassport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PASSPORT
                                            </label>
                                            <?php if (!empty($detail['copassport'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$detail['copassport'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$detail['copassport'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $phase = App\Phase::where('phase_id', $detail['phase'])->first();
                                        $block = App\Block::where('block_id', $detail['block'])->first();
                                        $floor = App\Floor::where('floor_id', $detail['floor'])->first();
                                        $flattype = App\Flattype::where('flattype_id', $detail['flattype'])->first();
                                        $flatnumber = App\Flatnumber::where('flatnumber_id', $detail['flatnumber'])->first();
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PHASE
                                            </label>
                                            <div class="col-md-5">
                                                {{ $phase->phase_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                BLOCK
                                            </label>
                                            <div class="col-md-5">
                                                {{ $block->block_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FLOOR
                                            </label>
                                            <div class="col-md-5">
                                                {{ $floor->floor_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FLAT TYPE
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flattype->flattype }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FLAT NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flatnumber->flatnumber }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                FLAT FACING
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->facing }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                SALEABLE AREA
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->salable_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PLINTH AREA
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->plinth_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                UDS AREA
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->uds_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                COMN AREA
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->comn_area }}
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

    .download_pdf {
        margin-top: 24px;
        text-align: right;
    }

    .application a.download {
        border: 2px solid #f72a80;
        border-radius: 4px;
        font-size: 15px;
        background: #f72a80;
        color: white;
        padding: 2px;
        margin: 2px;
    }

    .application a.view {
        border: 2px solid green;
        border-radius: 4px;
        font-size: 15px;
        background: green;
        color: white;
        padding: 2px;
        margin: 2px;
    }

    .application .view:hover {
        text-decoration: none !important;
    }

    .application .download:hover {
        text-decoration: none !important;
    }

    .application a .fa.fa-download,
    a .fa.fa-eye {
        font-size: 21px !important;
    }

    .application label.alert-danger {
        padding: 0px 6px;
        background: red;
    }
</style>
@endsection