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
                <a href="{{route('deletes.cost_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                        <?php
                                        $customer = App\Customer::where('customer_id', $detail['customer_id'])->first();
                                        ?>
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
                                                {{ $customer->date_of_application }}
                                            </div>
                                        </div>
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
                                                    echo $customer['phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $customer['phone']; ?>
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
                                        <?php
                                        $document = App\Document::where('customer_id', $detail['customer_id'])->first();
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT NAME
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($document['co_applicant_name']) ? $document['co_applicant_name'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT MAIL ID
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($document['coapp_email']) ? $document['coapp_email'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT ADDRESS
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($document['coapp_address']) ? $document['coapp_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT MOBILE NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <span>
                                                    <?php
                                                    echo $document['coapp_phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $document['coapp_phone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT AADHAR NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($document['aadhar_number']) ? $document['aadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT AADHAR
                                            </label>
                                            <?php if (!empty($document['aadhar'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['aadhar'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['aadhar'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
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
                                                <?php echo !empty($document['pan_number']) ? $document['pan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PAN CARD
                                            </label>
                                            <?php if (!empty($document['pan'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['pan'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['pan'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
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
                                                <?php echo !empty($document['passport_number']) ? $document['passport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICANT PASSPORT
                                            </label>
                                            <?php if (!empty($document['passport'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['passport'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['passport'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
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
                                                <?php echo !empty($document['coaadhar_number']) ? $document['coaadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT AADHAR
                                            </label>
                                            <?php if (!empty($document['coaadhar'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['coaadhar'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['coaadhar'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
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
                                                <?php echo !empty($document['copan_number']) ? $document['copan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PAN CARD
                                            </label>
                                            <?php if (!empty($document['copan'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['copan'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['copan'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
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
                                                <?php echo !empty($document['copassport_number']) ? $document['copassport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CO-APPLICANT PASSPORT
                                            </label>
                                            <?php if (!empty($document['copassport'])) { ?>
                                                <div class="col-md-6">
                                                    <a class="download" href="{{URL::to('public/files/forms/'.$document['copassport'] .'')}}" target="_blank" rel="tooltip" download title="Click to Download">
                                                        <i style="font-size: 26px;" class="fa fa-download"></i> </a>
                                                    <a class="view" href="{{URL::to('public/files/forms/'.$document['copassport'] .'')}}" target="_blank" rel="tooltip" title="Click to Open">
                                                        <i style="font-size: 26px;" class="fa fa-eye"></i> </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6">
                                                    <label class="alert-danger">Not uploded</label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $phase = App\Phase::where('phase_id', $document['phase'])->first();
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
                                                {{ $detail->sal_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PLINTH AREA
                                            </label>
                                            <div class="col-md-5">
                                                {{ $document->plinth_area }}
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
                                                {{ $document->comn_area }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="j_head" style="background: #61317a;">COST DETAILS</h5>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                RATE PER SQFT
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->rate_sqft }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1" style="color:#e51a4b;font-weight:700;">
                                                SALABLE VALUE
                                            </label>
                                            <div class="col-md-5" style="color:#e51a4b;font-weight:700;">
                                                {{"RS."}} {{ $detail->salable_value }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                GUIDELINE VALUE
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->guideline_value }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                LAND COST
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->land_cost }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CONSTRUCTION COST
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->construction_cost }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                ELECTRICTY CHARGES
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->electricity_charges }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                METRO WATER SUPPLY
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->water_supply }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CAR PARK
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->car_park }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                AMENITIES CHARGES
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->amenities_charges }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                MAINTENANCE CHARGES
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->maintenance }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1" style="color:#e51a4b;font-weight:700;">
                                                GROSS AMOUNT
                                            </label>
                                            <div class="col-md-5" style="color:#e51a4b;font-weight:700;">
                                                {{"RS."}} {{ $detail->gross_amount }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                STAMP DUTY CHARGES
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->stamp }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                REGISTRATION CHARGES
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->registration }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                REGISTRATION CHARGES FOR CONSTRUCTION AGREEMENT
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->construction }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                CORPUS FUND
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->corpus_fund }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                GST
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->gst }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1" style="color:#008000;font-weight:700;">
                                                TOTAL AMOUNT
                                            </label>
                                            <div class="col-md-5" style="color:#008000;font-weight:700;">
                                                {{"RS."}} {{ $detail->total_amount }}
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