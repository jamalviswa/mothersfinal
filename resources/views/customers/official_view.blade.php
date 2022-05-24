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
                <a href="{{route('customers.official_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                        <h5 class="j_head" style="background:#e51a4b;">DOCUMENT DETAILS</h5>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Name of the Applicant
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->applicant_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Application Number
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->application_number }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                Date of Application
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->date_of_application }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                               Applicant Mobile Number
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
                                                Applicant Aadhar Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['aadhar_number']) ? $detail['aadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Applicant Aadhar
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
                                            Applicant PAN Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['pan_number']) ? $detail['pan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Applicant PAN Card
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
                                            Applicant Passport Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['passport_number']) ? $detail['passport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Applicant Passport
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
                                                Name of the Co-Applicant
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['co_applicant_name']) ? $detail['co_applicant_name'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Co-Applicant Mobile Number
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
                                            Co-Applicant Mail Id
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coapp_email']) ? $detail['coapp_email'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                Co-Applicant Aadhar Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coaadhar_number']) ? $detail['coaadhar_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Co-Applicant Aadhar
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
                                            Co-Applicant PAN Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['copan_number']) ? $detail['copan_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Co-Applicant PAN Card
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
                                            Co-Applicant Passport Number
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['copassport_number']) ? $detail['copassport_number'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Co-Applicant Passport
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
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Co-applicant Address
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['coapp_address']) ? $detail['coapp_address'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Customer Type
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['customer_type']) ? $detail['customer_type'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Referrer Name
                                            </label>
                                            <div class="col-md-5">
                                                <?php echo !empty($detail['refered_name']) ? $detail['refered_name'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Referrer Mobile Number
                                            </label>
                                            <div class="col-md-5">
                                            <span>
                                                    <?php
                                                    echo $detail['refered_phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $detail['refered_phone']; ?>
                                            </div>
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
                                            Phase
                                            </label>
                                            <div class="col-md-5">
                                                {{ $phase->phase_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Block 
                                            </label>
                                            <div class="col-md-5">
                                                {{ $block->block_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Floor 
                                            </label>
                                            <div class="col-md-5">
                                                {{ $floor->floor_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Flat Type
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flattype->flattype }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Flat Number
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flatnumber->flatnumber }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Flat Facing 
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->facing }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Saleable Area
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->salable_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Plinth Area
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->plinth_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            UDS Area
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->uds_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                            Comn Area
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->comn_area }}
                                            </div>
                                        </div>
                                        <div class="download_pdf">
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download" href="{{ route('customers.official_invoicepdf',$detail['customer_id']) }}" target="_blank" download>
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

    .btn.btn-secondary.m-btn.m-btn--air.m-btn--custom {
        padding: 17px;
        background: #0054ac;
        color: white;
        border-radius: 0px;
    }
</style>
@endsection