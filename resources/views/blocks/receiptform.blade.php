<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$detail = App\Customer::where('customer_id', '=', $customer_id)->first();
if (!empty($detail)) {
    $data['document'] = App\Document::where('customer_id', $detail->customer_id)->get();
    $data['cost'] = App\Cost::where('customer_id', $detail->customer_id)->get();
    $data['payment'] = App\Payment::where('customer_id', $detail->customer_id)->get();
    $data['receipt'] = App\Receipt::where('customer_id', $detail->customer_id)->get();
?>
    <img style="width: 20%;position: relative;bottom: 13px;" src="{{ public_path('/admin/img/logos/logo.png') }}" />
    <div class="row" style="font-size: 13px;">
        <div class="col-md-6">
            <h4 class="accordion-toggle" style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Personal Details</h4>
            <div class="accordion-content" style="margin-top: 15px;">
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
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Date of Application
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->date_of_application) ? $detail->date_of_application : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Father/Spouse Name
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->fathers_name) ? $detail->fathers_name : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Age
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->age) ? $detail->age : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Gender
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->gender) ? $detail->gender : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Mobile Number
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <span>
                            <?php
                            if (!empty($detail->phone)) {
                                echo  $detail['phone_code'] . ' ';
                            ?>
                        </span>
                    <?php
                                echo $detail['phone'];
                            } else {
                                echo "-";
                            }
                    ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Alternative Mobile Number
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <span>
                            <?php
                            if (!empty($detail->altphone)) {
                                echo  $detail['altphone_code'] . ' ';
                            ?>
                        </span>
                    <?php
                                echo $detail['altphone'];
                            } else {
                                echo "-";
                            }
                    ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Email
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->email) ? $detail->email : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Occupation
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->occupation) ? $detail->occupation : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Total Years of Experience
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php echo !empty($detail->experience) ? $detail->experience . " Years" : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Residential/Permanent Address
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;width:15pc;margin-bottom:1pc;">
                        <?php echo !empty($detail->permanent_address) ? $detail->permanent_address : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Correspondance/Present Address
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;width:15pc;margin-bottom:1pc;">
                        <?php echo !empty($detail->present_address) ? $detail->present_address : "-" ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Annual Income
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php if (!empty($detail->income)) {
                            echo "Rs. " . $detail->income;
                        } else {
                            echo "-";
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:bold;">
                        Photo
                    </label>
                    <div class="col-md-8" style="position: relative;left: 22pc;">
                        <?php if (!empty($detail->photo)) { ?>
                            <img width="50" height="50" src="<?php echo  public_path('files/customers/' . $detail->photo) ?>">
                        <?php } else { ?>
                            <img width="50" height="50" src="<?php echo  public_path('files/customers/user.png') ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
       
            <h4 class="accordion-toggle" style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Document Details</h4>
            
            <div class="accordion-content" style="margin-top: 15px;">
                <?php foreach ($data['document'] as $doc) { ?>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant Aadhar Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->aadhar_number) ? $doc->aadhar_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant Aadhar
                        </label>
                        <?php if (!empty($doc['aadhar'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['aadhar'].'')}}" download target="_blank">{{ $doc['aadhar'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant PAN Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->pan_number) ? $doc->pan_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant PAN
                        </label>
                        <?php if (!empty($doc['pan'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['pan'].'')}}" download target="_blank">{{ $doc['pan'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant Passport Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->passport_number) ? $doc->passport_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Applicant Passport
                        </label>
                        <?php if (!empty($doc['passport'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['passport'].'')}}" download target="_blank">{{ $doc['passport'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Name of the Co-Applicant
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->co_applicant_name) ? $doc->co_applicant_name : "-" ?>
                        </div>
                    </div>
                   
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Mobile Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <span>
                                <?php
                                if (!empty($doc->coapp_phone)) {
                                    echo  $doc['coapp_phone_code'] . ' ';
                                ?>
                            </span>
                        <?php
                                    echo $doc['coapp_phone'];
                                } else {
                                    echo "-";
                                }
                        ?>
                        </div>
                    </div>
                   
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Mail Id
                        </label>

                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->coapp_email) ? $doc->coapp_email : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Aadhar Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->coaadhar_number) ? $doc->coaadhar_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Aadhar
                        </label>
                        <?php if (!empty($doc['coaadhar'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['coaadhar'].'')}}" download target="_blank">{{ $doc['coaadhar'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant PAN Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->copan_number) ? $doc->copan_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant PAN
                        </label>
                        <?php if (!empty($doc['copan'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['copan'].'')}}" download target="_blank">{{ $doc['copan'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Passport Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->copassport_number) ? $doc->copassport_number : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-Applicant Passport
                        </label>
                        <?php if (!empty($doc['copassport'])) { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                <a href="{{URL::to('files/forms/'.$doc['copassport'].'')}}" download target="_blank">{{ $doc['copassport'] }}
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-8" style="position: relative;left: 22pc;">
                                Not uploded
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Co-applicant Address
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;width:20pc;margin-bottom:0.5pc;">
                            <?php echo !empty($doc->coapp_address) ? $doc->coapp_address : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Customer Type
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->customer_type) ? $doc->customer_type : "-" ?>
                        </div>
                    </div>

                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Referrer Name
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->refered_name) ? $doc->refered_name : "-" ?>
                        </div>
                    </div>

                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Referrer Mobile Number
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <span>
                                <?php
                                if (!empty($doc->refered_phone)) {
                                    echo  $doc['refered_phone_code'] . ' ';
                                ?>
                            </span>
                        <?php
                                    echo $doc['refered_phone'];
                                } else {
                                    echo "-";
                                }
                        ?>
                        </div>
                    </div>
                    <?php
                    $phase = App\Phase::where('phase_id', $doc['phase'])->first();
                    $block = App\Block::where('block_id', $doc['block'])->first();
                    $floor = App\Floor::where('floor_id', $doc['floor'])->first();
                    $flattype = App\Flattype::where('flattype_id', $doc['flattype'])->first();
                    $flatnumber = App\Flatnumber::where('flatnumber_id', $doc['flatnumber'])->first();
                    ?>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Phase
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($phase->phase_name) ? $phase->phase_name : "-" ?>
                        </div>
                    </div>
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
                            <?php echo !empty($doc->facing) ? $doc->facing : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Saleable Area
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->salable_area) ? $doc->salable_area : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Plinth Area
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->plinth_area) ? $doc->plinth_area : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            UDS Area
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->uds_area) ? $doc->uds_area : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Comn Area
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($doc->comn_area) ? $doc->comn_area : "-" ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row" style="font-size: 13px;">
        <div class="col-md-6">
            <h4 class="accordion-toggle" style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Cost Details</h4>
            <div class="accordion-content" style="margin-top: 15px;">
                <?php foreach ($data['cost'] as $cost) { ?>

                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Rate per SQFT
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->rate_sqft) ? "Rs. " . $cost->rate_sqft : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Area of the Flat (Salable Area)
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->sal_area) ? $cost->sal_area : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            UDS (in Sq.Ft)
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->uds_area) ? $cost->uds_area : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Guideline Value
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->guideline_value) ? "Rs. " . $cost->guideline_value : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Land Cost
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->land_cost) ? "Rs. " . $cost->land_cost : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Construction Cost
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->construction_cost) ? "Rs. " . $cost->construction_cost : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Electricity Charges
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->electricity_charges) ? "Rs. " . $cost->electricity_charges : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Metro Water Supply
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->water_supply) ? "Rs. " . $cost->water_supply : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Car Park
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->car_park) ? "Rs. " . $cost->car_park : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Amenities Charges
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->amenities_charges) ? "Rs. " . $cost->amenities_charges : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Maintenance Charges(To be decided )
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->maintenance) ? "Rs. " . $cost->maintenance : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Gross Amount
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->gross_amount) ? "Rs. " . $cost->gross_amount : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Stamp Duty Charges
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->stamp) ? "Rs. " . $cost->stamp : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Registration Charges
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->registration) ? "Rs. " . $cost->registration : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Registration Charges for Construction Agreement
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->construction) ? "Rs. " . $cost->construction : "-" ?>
                        </div>
                    </div>
                    &nbsp;
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Corpus Fund
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->corpus_fund) ? "Rs. " . $cost->corpus_fund : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            GST
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->gst) ? "Rs. " . $cost->gst : "-" ?>
                        </div>
                    </div>
                    <div class="form-group row" style="display: flex;">
                        <label class="col-md-4" style="font-weight:bold;">
                            Total Amount
                        </label>
                        <div class="col-md-8" style="position: relative;left: 22pc;">
                            <?php echo !empty($cost->total_amount) ? "Rs. " . $cost->total_amount : "-" ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <h4 class="accordion-toggle" style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Payment Details</h4>
            <div class="accordion-content" style="margin-top: 15px;">
            <table>
                <thead>
                    <tr>
                        <th>Transac Type</th>
                        <th>Bank Type</th>
                        <!-- <th>Bank Name</th> -->
                        <th>LSA</th>
                        <!-- <th>Payment Schedule</th> -->
                        <th>Schedule Type</th>
                        <th>Total Amount</th>
                        <th>Received Amount</th>
                        <th>Balance Amount</th>
                        <th>Pay Date</th>
                        <th>Pay Type</th>
                        <th>Transac ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data['payment'] = App\Payment::where('customer_id', $detail->customer_id)->get();
                    foreach ($data['payment'] as $result) {
                    ?>
                        <tr>
                            <td>{{ $result->transaction_type }}</td>
                            <td>{{ $result->bank_type }}<br>
                                <?php if ($result->bank_type == "OTHERS") { 
                                    echo "(".$result->bank_name.")";
                                } else{
                                    echo "";
                                }
                                ?>
                            </td>
                            <!-- <td>{{ $result->bank_name }}</td> -->
                            <td>
                                <?php
                                if (!empty($result->loan_amount)) {
                                    echo "Rs. " . $result->loan_amount;
                                } else {
                                    echo "- ";
                                }
                                ?>
                            </td>
                            <!-- <td>{{ $result->payment_schedule }}{{" %"}}</td> -->
                            <?php if ($result->onbook_received10per != 0) { ?>
                                <td>On Booking 10%</td>
                                <td>{{"Rs. "}}{{ $result->onbook10per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_balance10per }}</td>
                                <td>{{ $result->onbook_paymentdate10per }}</td>

                                <td>{{ $result->onbook_paymenttype10per }}</td>
                                <?php if ($result->onbook_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->onbook_chequenumber10per }}</td>
                                <?php } else if ($result->onbook_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->onbook_neftid10per }}</td>
                                <?php } else if ($result->onbook_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->onbook_rtgsid10per }}</td>
                                <?php } else if ($result->onbook_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->payments_received10per != 0) { ?>
                                <td>Payment for Agreements 40%</td>
                                <td>{{"Rs. "}}{{ $result->payments10per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_balance10per }}</td>
                                <td>{{ $result->payments_paymentdate10per }}</td>

                                <td>{{ $result->payments_paymenttype10per }}</td>
                                <?php if ($result->payments_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->payments_chequenumber10per }}</td>
                                <?php } else if ($result->payments_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->payments_neftid10per }}</td>
                                <?php } else if ($result->payments_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->payments_rtgsid10per }}</td>
                                <?php } else if ($result->payments_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->first_received10per != 0) { ?>
                                <td>Completion of stilt + First Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->first10per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_balance10per }}</td>
                                <td>{{ $result->first_paymentdate10per }}</td>

                                <td>{{ $result->first_paymenttype10per }}</td>
                                <?php if ($result->first_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->first_chequenumber10per }}</td>
                                <?php } else if ($result->first_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->first_neftid10per }}</td>
                                <?php } else if ($result->first_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->first_rtgsid10per }}</td>
                                <?php } else if ($result->first_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->second_received10per != 0) { ?>
                                <td>Completion of Second Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->second10per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_balance10per }}</td>
                                <td>{{ $result->second_paymentdate10per }}</td>

                                <td>{{ $result->second_paymenttype10per }}</td>
                                <?php if ($result->second_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->second_chequenumber10per }}</td>
                                <?php } else if ($result->second_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->second_neftid10per }}</td>
                                <?php } else if ($result->second_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->second_rtgsid10per }}</td>
                                <?php } else if ($result->second_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->third_received10per != 0) { ?>
                                <td>Completion of Third Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->third10per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_balance10per }}</td>
                                <td>{{ $result->third_paymentdate10per }}</td>

                                <td>{{ $result->third_paymenttype10per }}</td>
                                <?php if ($result->third_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->third_chequenumber10per }}</td>
                                <?php } else if ($result->third_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->third_neftid10per }}</td>
                                <?php } else if ($result->third_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->third_rtgsid10per }}</td>
                                <?php } else if ($result->third_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fourth_received10per != 0) { ?>
                                <td>Completion of Fourth Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->fourth10per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_balance10per }}</td>
                                <td>{{ $result->fourth_paymentdate10per }}</td>

                                <td>{{ $result->fourth_paymenttype10per }}</td>
                                <?php if ($result->fourth_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->fourth_chequenumber10per }}</td>
                                <?php } else if ($result->fourth_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->fourth_neftid10per }}</td>
                                <?php } else if ($result->fourth_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->fourth_rtgsid10per }}</td>
                                <?php } else if ($result->fourth_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fifth_received10per != 0) { ?>
                                <td>Completion of Fifth Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->fifth10per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_balance10per }}</td>
                                <td>{{ $result->fifth_paymentdate10per }}</td>

                                <td>{{ $result->fifth_paymenttype10per }}</td>
                                <?php if ($result->fifth_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->fifth_chequenumber10per }}</td>
                                <?php } else if ($result->fifth_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->fifth_neftid10per }}</td>
                                <?php } else if ($result->fifth_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->fifth_rtgsid10per }}</td>
                                <?php } else if ($result->fifth_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>


                            <?php } else  if ($result->handover_received10per != 0) { ?>
                                <td>Handovering 5%</td>
                                <td>{{"Rs. "}}{{ $result->handover10per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_received10per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_balance10per }}</td>
                                <td>{{ $result->handover_paymentdate10per }}</td>

                                <td>{{ $result->handover_paymenttype10per }}</td>
                                <?php if ($result->handover_paymenttype10per == "Cheque") { ?>
                                    <td>{{ $result->handover_chequenumber10per }}</td>
                                <?php } else if ($result->handover_paymenttype10per == "NEFT") { ?>
                                    <td>{{ $result->handover_neftid10per }}</td>
                                <?php } else if ($result->handover_paymenttype10per == "RTGS") { ?>
                                    <td>{{ $result->handover_rtgsid10per }}</td>
                                <?php } else if ($result->handover_paymenttype10per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else if ($result->onbook_received15per != 0) { ?>
                                <td>On Booking 15%</td>
                                <td>{{"Rs. "}}{{ $result->onbook15per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_balance15per }}</td>
                                <td>{{ $result->onbook_paymentdate15per }}</td>

                                <td>{{ $result->onbook_paymenttype15per }}</td>
                                <?php if ($result->onbook_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->onbook_chequenumber15per }}</td>
                                <?php } else if ($result->onbook_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->onbook_neftid15per }}</td>
                                <?php } else if ($result->onbook_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->onbook_rtgsid15per }}</td>
                                <?php } else if ($result->onbook_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->payments_received15per != 0) { ?>
                                <td>Payment for Agreements 40%</td>
                                <td>{{"Rs. "}}{{ $result->payments15per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_balance15per }}</td>
                                <td>{{ $result->payments_paymentdate15per }}</td>

                                <td>{{ $result->payments_paymenttype15per }}</td>
                                <?php if ($result->payments_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->payments_chequenumber15per }}</td>
                                <?php } else if ($result->payments_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->payments_neftid15per }}</td>
                                <?php } else if ($result->payments_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->payments_rtgsid15per }}</td>
                                <?php } else if ($result->payments_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->first_received15per != 0) { ?>
                                <td>Completion of stilt + First Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->first15per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_balance15per }}</td>
                                <td>{{ $result->first_paymentdate15per }}</td>

                                <td>{{ $result->first_paymenttype15per }}</td>
                                <?php if ($result->first_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->first_chequenumber15per }}</td>
                                <?php } else if ($result->first_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->first_neftid15per }}</td>
                                <?php } else if ($result->first_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->first_rtgsid15per }}</td>
                                <?php } else if ($result->first_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->second_received15per != 0) { ?>
                                <td>Completion of Second Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->second15per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_balance15per }}</td>
                                <td>{{ $result->second_paymentdate15per }}</td>

                                <td>{{ $result->second_paymenttype15per }}</td>
                                <?php if ($result->second_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->second_chequenumber15per }}</td>
                                <?php } else if ($result->second_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->second_neftid15per }}</td>
                                <?php } else if ($result->second_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->second_rtgsid15per }}</td>
                                <?php } else if ($result->second_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->third_received15per != 0) { ?>
                                <td>Completion of Third Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->third15per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_balance15per }}</td>
                                <td>{{ $result->third_paymentdate15per }}</td>

                                <td>{{ $result->third_paymenttype15per }}</td>
                                <?php if ($result->third_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->third_chequenumber15per }}</td>
                                <?php } else if ($result->third_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->third_neftid15per }}</td>
                                <?php } else if ($result->third_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->third_rtgsid15per }}</td>
                                <?php } else if ($result->third_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fourth_received15per != 0) { ?>
                                <td>Completion of Fourth Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->fourth15per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_balance15per }}</td>
                                <td>{{ $result->fourth_paymentdate15per }}</td>

                                <td>{{ $result->fourth_paymenttype15per }}</td>
                                <?php if ($result->fourth_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->fourth_chequenumber15per }}</td>
                                <?php } else if ($result->fourth_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->fourth_neftid15per }}</td>
                                <?php } else if ($result->fourth_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->fourth_rtgsid15per }}</td>
                                <?php } else if ($result->fourth_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fifth_received15per != 0) { ?>
                                <td>Completion of Fifth Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->fifth15per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_balance15per }}</td>
                                <td>{{ $result->fifth_paymentdate15per }}</td>

                                <td>{{ $result->fifth_paymenttype15per }}</td>
                                <?php if ($result->fifth_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->fifth_chequenumber15per }}</td>
                                <?php } else if ($result->fifth_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->fifth_neftid15per }}</td>
                                <?php } else if ($result->fifth_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->fifth_rtgsid15per }}</td>
                                <?php } else if ($result->fifth_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->handover_received15per != 0) { ?>
                                <td>Handovering 5%</td>
                                <td>{{"Rs. "}}{{ $result->handover15per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_received15per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_balance15per }}</td>
                                <td>{{ $result->handover_paymentdate15per }}</td>

                                <td>{{ $result->handover_paymenttype15per }}</td>
                                <?php if ($result->handover_paymenttype15per == "Cheque") { ?>
                                    <td>{{ $result->handover_chequenumber15per }}</td>
                                <?php } else if ($result->handover_paymenttype15per == "NEFT") { ?>
                                    <td>{{ $result->handover_neftid15per }}</td>
                                <?php } else if ($result->handover_paymenttype15per == "RTGS") { ?>
                                    <td>{{ $result->handover_rtgsid15per }}</td>
                                <?php } else if ($result->handover_paymenttype15per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else if ($result->onbook_received20per != 0) { ?>
                                <td>On Booking 20%</td>
                                <td>{{"Rs. "}}{{ $result->onbook20per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->onbook_balance20per }}</td>
                                <td>{{ $result->onbook_paymentdate20per }}</td>

                                <td>{{ $result->onbook_paymenttype20per }}</td>
                                <?php if ($result->onbook_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->onbook_chequenumber20per }}</td>
                                <?php } else if ($result->onbook_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->onbook_neftid20per }}</td>
                                <?php } else if ($result->onbook_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->onbook_rtgsid20per }}</td>
                                <?php } else if ($result->onbook_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->payments_received20per != 0) { ?>
                                <td>Payment for Agreements 40%</td>
                                <td>{{"Rs. "}}{{ $result->payments20per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->payments_balance20per }}</td>
                                <td>{{ $result->payments_paymentdate20per }}</td>

                                <td>{{ $result->payments_paymenttype20per }}</td>
                                <?php if ($result->payments_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->payments_chequenumber20per }}</td>
                                <?php } else if ($result->payments_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->payments_neftid20per }}</td>
                                <?php } else if ($result->payments_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->payments_rtgsid20per }}</td>
                                <?php } else if ($result->payments_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->first_received20per != 0) { ?>
                                <td>Completion of stilt + First Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->first20per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->first_balance20per }}</td>
                                <td>{{ $result->first_paymentdate20per }}</td>

                                <td>{{ $result->first_paymenttype20per }}</td>
                                <?php if ($result->first_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->first_chequenumber20per }}</td>
                                <?php } else if ($result->first_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->first_neftid20per }}</td>
                                <?php } else if ($result->first_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->first_rtgsid20per }}</td>
                                <?php } else if ($result->first_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->second_received20per != 0) { ?>
                                <td>Completion of Second Floor 10%</td>
                                <td>{{"Rs. "}}{{ $result->second20per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->second_balance20per }}</td>
                                <td>{{ $result->second_paymentdate20per }}</td>

                                <td>{{ $result->second_paymenttype20per }}</td>
                                <?php if ($result->second_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->second_chequenumber20per }}</td>
                                <?php } else if ($result->second_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->second_neftid20per }}</td>
                                <?php } else if ($result->second_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->second_rtgsid20per }}</td>
                                <?php } else if ($result->second_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->third_received20per != 0) { ?>
                                <td>Completion of Third Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->third20per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->third_balance20per }}</td>
                                <td>{{ $result->third_paymentdate20per }}</td>

                                <td>{{ $result->third_paymenttype20per }}</td>
                                <?php if ($result->third_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->third_chequenumber20per }}</td>
                                <?php } else if ($result->third_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->third_neftid20per }}</td>
                                <?php } else if ($result->third_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->third_rtgsid20per }}</td>
                                <?php } else if ($result->third_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fourth_received20per != 0) { ?>
                                <td>Completion of Fourth Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->fourth20per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->fourth_balance20per }}</td>
                                <td>{{ $result->fourth_paymentdate20per }}</td>

                                <td>{{ $result->fourth_paymenttype20per }}</td>
                                <?php if ($result->fourth_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->fourth_chequenumber20per }}</td>
                                <?php } else if ($result->fourth_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->fourth_neftid20per }}</td>
                                <?php } else if ($result->fourth_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->fourth_rtgsid20per }}</td>
                                <?php } else if ($result->fourth_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->fifth_received20per != 0) { ?>
                                <td>Completion of Fifth Floor 5%</td>
                                <td>{{"Rs. "}}{{ $result->fifth20per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->fifth_balance20per }}</td>
                                <td>{{ $result->fifth_paymentdate20per }}</td>

                                <td>{{ $result->fifth_paymenttype20per }}</td>
                                <?php if ($result->fifth_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->fifth_chequenumber20per }}</td>
                                <?php } else if ($result->fifth_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->fifth_neftid20per }}</td>
                                <?php } else if ($result->fifth_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->fifth_rtgsid20per }}</td>
                                <?php } else if ($result->fifth_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } else  if ($result->handover_received20per != 0) { ?>
                                <td>Handovering 5%</td>
                                <td>{{"Rs. "}}{{ $result->handover20per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_received20per }}</td>
                                <td>{{"Rs. "}}{{ $result->handover_balance20per }}</td>
                                <td>{{ $result->handover_paymentdate20per }}</td>

                                <td>{{ $result->handover_paymenttype20per }}</td>
                                <?php if ($result->handover_paymenttype20per == "Cheque") { ?>
                                    <td>{{ $result->handover_chequenumber20per }}</td>
                                <?php } else if ($result->handover_paymenttype20per == "NEFT") { ?>
                                    <td>{{ $result->handover_neftid20per }}</td>
                                <?php } else if ($result->handover_paymenttype20per == "RTGS") { ?>
                                    <td>{{ $result->handover_rtgsid20per }}</td>
                                <?php } else if ($result->handover_paymenttype20per == "Cash") { ?>
                                    <td><?php echo "-"; ?></td>
                                <?php } ?>

                            <?php } ?>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="row" style="font-size: 13px;">
        <div class="col-md-6">
            <h4 class="accordion-toggle" style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Recipt Info</h4>
            <div class="accordion-content" style="margin-top: 15px;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Cheque/DD No</th>
                            <th>Cheque Date</th>
                            <th>Drawn On</th>
                            <th>Bank Towards</th>
                            <th>Referred By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data['receipt'] as $rec) {
                        ?>
                            <tr>
                                <td><?php echo $rec->receipt_no  ?></td>
                                <td><?php echo $rec->receipt_date  ?></td>
                                <td><?php echo 'Rs.' . $rec->final_amount  ?></td>
                                <td><?php echo !empty($rec->cheque_no) ? $rec->cheque_no : "-" ?></td>
                                <td><?php echo !empty($rec->dated) ? $rec->dated : "-" ?></td>
                                <td><?php echo !empty($rec->drawn_on) ? $rec->drawn_on : "-" ?></td>
                                <td><?php echo !empty($rec->bank_towards) ? $rec->bank_towards : "-" ?></td>
                                <td><?php echo !empty($rec->referred_by) ? $rec->referred_by : "-" ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


<?php } ?>
<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>