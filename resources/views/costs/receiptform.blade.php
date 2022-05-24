<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$detail = App\Cost::where('customer_id', '=', $customer_id)->first();
if (!empty($detail)) {
?>
    <img style="width: 30%;position: relative;bottom: 13px;" src="{{ public_path('/admin/img/logos/logo.png') }}" />
    <div class="row" style="font-size: 15px;">
        <div class="col-md-6">
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Customer Information</h4>
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Cost Details</h4>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Name of the Applicant
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->applicant_name) ? $detail->applicant_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Application Number
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->application_number) ? $detail->application_number : "-" ?>
                </div>
            </div>
            <?php
            $block = App\Block::where('block_id', $detail['block'])->first();
            $floor = App\Floor::where('floor_id', $detail['floor'])->first();
            $flattype = App\Flattype::where('flattype_id', $detail['flattype'])->first();
            $flatnumber = App\Flatnumber::where('flatnumber_id', $detail['flatnumber'])->first();
            ?>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Block
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($block->block_name) ? $block->block_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Floor
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($floor->floor_name) ? $floor->floor_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Type
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($flattype->flattype) ? $flattype->flattype : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Number
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($flatnumber->flatnumber) ? $flatnumber->flatnumber : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Facing
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->facing) ? $detail->facing : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Rate per SQFT
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->rate_sqft) ? "Rs. " . $detail->rate_sqft : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Area of the Flat (Salable Area)
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->sal_area) ? $detail->sal_area : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Salable Value
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->salable_value) ? "Rs. " . $detail->salable_value : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    UDS (in Sq.Ft)
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->uds_area) ? $detail->uds_area : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Guideline Value
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->guideline_value) ? "Rs. " . $detail->guideline_value : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Land Cost
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->land_cost) ? "Rs. " . $detail->land_cost : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Construction Cost
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->construction_cost) ? "Rs. " . $detail->construction_cost : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Electricity Charges
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->electricity_charges) ? "Rs. " . $detail->electricity_charges : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Metro Water Supply
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->water_supply) ? "Rs. " . $detail->water_supply : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Car Park
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->car_park) ? "Rs. " . $detail->car_park : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Amenities Charges
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->amenities_charges) ? "Rs. " . $detail->amenities_charges : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Maintenance Charges(To be decided )
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->maintenance) ? "Rs. " . $detail->maintenance : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Gross Amount
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->gross_amount) ? "Rs. " . $detail->gross_amount : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Stamp Duty Charges
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->stamp) ? "Rs. " . $detail->stamp : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Registration Charges
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->registration) ? "Rs. " . $detail->registration : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Registration Charges for Construction Agreement
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->construction) ? "Rs. " . $detail->construction : "-" ?>
                </div>
            </div>
            &nbsp;
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Corpus Fund
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->corpus_fund) ? "Rs. " . $detail->corpus_fund : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    GST
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->gst) ? "Rs. " . $detail->gst : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Total Amount
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($detail->total_amount) ? "Rs. " . $detail->total_amount : "-" ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>