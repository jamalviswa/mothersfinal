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
                <a href="{{route('costs.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                        <h5 class="j_head" style="background: #61317a;">COST DETAILS</h5>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Name of the Applicant
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->applicant_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Application Number
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->application_number }}
                                            </div>
                                        </div>
                                        <?php
                                        $block = App\Block::where('block_id', $detail['block'])->first();
                                        $floor = App\Floor::where('floor_id', $detail['floor'])->first();
                                        $flattype = App\Flattype::where('flattype_id', $detail['flattype'])->first();
                                        $flatnumber = App\Flatnumber::where('flatnumber_id', $detail['flatnumber'])->first();
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Block
                                            </label>
                                            <div class="col-md-5">
                                                {{ $block->block_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Floor
                                            </label>
                                            <div class="col-md-5">
                                                {{ $floor->floor_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Flat Type
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flattype->flattype }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Flat Number
                                            </label>
                                            <div class="col-md-5">
                                                {{ $flatnumber->flatnumber }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Flat Facing
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->facing }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Rate per SQFT
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->rate_sqft }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Area of the Flat (Salable Area)
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->sal_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1" style="color:#e51a4b;font-weight:700;">
                                                Salable Value
                                            </label>
                                            <div class="col-md-5" style="color:#e51a4b;font-weight:700;">
                                                {{"RS."}} {{ $detail->salable_value }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1" style="color:#e51a4b;font-weight:700;">
                                                UDS (in Sq.Ft)
                                            </label>
                                            <div class="col-md-5" style="color:#e51a4b;font-weight:700;">
                                                {{ $detail->uds_area }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Guideline Value
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->guideline_value }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Land Cost
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->land_cost }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Construction Cost
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->construction_cost }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Electricity Charges
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->electricity_charges }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Metro Water Supply
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->water_supply }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Car Park
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->car_park }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Amenities Charges
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->amenities_charges }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Maintenance Charges(To be decided )
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->maintenance }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1" style="color:#e51a4b;font-weight:700;">
                                                Gross Amount
                                            </label>
                                            <div class="col-md-5" style="color:#e51a4b;font-weight:700;">
                                                {{"RS."}} {{ $detail->gross_amount }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Stamp Duty Charges
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->stamp }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Registration Charges
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->registration }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Registration Charges for Construction Agreement
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->construction }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                Corpus Fund
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->corpus_fund }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1">
                                                GST
                                            </label>
                                            <div class="col-md-5">
                                                {{"RS."}} {{ $detail->gst }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-1" style="color:#008000;font-weight:700;">
                                                Total Amount
                                            </label>
                                            <div class="col-md-5" style="color:#008000;font-weight:700;">
                                                {{"RS."}} {{ $detail->total_amount }}
                                            </div>
                                        </div>
                                        <div class="download_pdf">
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download" href="{{ route('costs.invoicepdf',$detail['customer_id']) }}" target="_blank" download>
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