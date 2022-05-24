@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Cost Info
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
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Application Number
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['application_number']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Name of the Applicant
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['applicant_name']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Phase
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                @php
                                                $cat=App\Block::where('block_id',$detail['block'])->first();
                                                $cats=App\Phase::where('phase_id',$cat['phase_id'])->first();
                                                @endphp
                                                {{ $cats['phase_name'] }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Block
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                @php
                                                $cat=App\Block::where('block_id',$detail['block'])->first();
                                                @endphp
                                                {{ $cat['block_name'] }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Floor
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                @php
                                                $cat=App\Floor::where('floor_id',$detail['floor'])->first();
                                                @endphp
                                                {{ $cat['floor_name'] }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Flat Type
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                @php
                                                $cat=App\Flattype::where('flattype_id',$detail['flattype'])->first();
                                                @endphp
                                                {{ $cat['flattype'] }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Flat Number
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                @php
                                                $cat=App\Flatnumber::where('flatnumber_id',$detail['flatnumber'])->first();
                                                @endphp
                                                {{ $cat['flatnumber'] }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Flat Facing
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['facing']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Rate per SQFT
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['rate_sqft']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Salable Area
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['sal_area']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Salable value
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['salable_value']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                UDS Area
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['uds_area']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Guideline value
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{ $detail['guideline_value']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Land Cost
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['land_cost']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Construction Cost
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['construction_cost']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Electricity Charges
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['electricity_charges']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Metro Water Supply
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['water_supply']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Car Park
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['car_park']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Amenities Charges
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['amenities_charges']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Maintenance Charges
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['maintenance']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Gross Amount
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['gross_amount']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Stamp Duty Charges
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['stamp']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Registration Charges
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['registration']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Construction Agreement
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['construction']}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                Corpus Fund
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                <?php echo !empty($detail['corpus_fund']) ? "Rs. " . $detail['corpus_fund'] : "-"; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                GST
                                            </label>
                                            <label class="col-md-1">:</label>
                                            <div class="col-md-8">
                                                {{"Rs. "}} {{ $detail['gst']}}
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