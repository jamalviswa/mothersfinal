<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$detail = App\Document::where('customer_id', '=', $customer_id)->first();
if (!empty($detail)) {

    $phase = App\Phase::where('phase_id', $detail['phase'])->first();
    $block = App\Block::where('block_id', $detail['block'])->first();
    $floor = App\Floor::where('floor_id', $detail['floor'])->first();
    $flattype = App\Flattype::where('flattype_id', $detail['flattype'])->first();
    $flatnumber = App\Flatnumber::where('flatnumber_id', $detail['flatnumber'])->first();

?>
    <img style="width: 30%;position: relative;bottom: 13px;" src="{{ public_path('/admin/img/logos/logo.png') }}" />
    <div class="row" style="font-size: 15px;">
        <div class="col-md-6">
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Customer Information</h4>
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Document Details</h4>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Name of the Applicant
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->applicant_name) ? $detail->applicant_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Application Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->application_number) ? $detail->application_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Date of Application
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->date_of_application) ? $detail->date_of_application : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant Mobile Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
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
                    Applicant Aadhar Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->aadhar_number) ? $detail->aadhar_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant Aadhar
                </label>
                <?php if (!empty($detail['aadhar'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['aadhar'].'')}}" download target="_blank">{{ $detail['aadhar'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant PAN Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->pan_number) ? $detail->pan_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant PAN
                </label>
                <?php if (!empty($detail['pan'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['pan'].'')}}" download target="_blank">{{ $detail['pan'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant Passport Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->passport_number) ? $detail->passport_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Applicant Passport
                </label>
                <?php if (!empty($detail['passport'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['passport'].'')}}" download target="_blank">{{ $detail['passport'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Name of the Co-Applicant
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->co_applicant_name) ? $detail->co_applicant_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant Mobile Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <span>
                        <?php
                        if (!empty($detail->coapp_phone)) {
                            echo  $detail['coapp_phone_code'] . ' ';
                        ?>
                    </span>
                <?php
                            echo $detail['coapp_phone'];
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
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->coapp_email) ? $detail->coapp_email : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant Aadhar Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->coaadhar_number) ? $detail->coaadhar_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant Aadhar
                </label>
                <?php if (!empty($detail['coaadhar'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['coaadhar'].'')}}" download target="_blank">{{ $detail['coaadhar'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant PAN Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->copan_number) ? $detail->copan_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant PAN
                </label>
                <?php if (!empty($detail['copan'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['copan'].'')}}" download target="_blank">{{ $detail['copan'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant Passport Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->copassport_number) ? $detail->copassport_number : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-Applicant Passport
                </label>
                <?php if (!empty($detail['copassport'])) { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        <a href="{{URL::to('files/forms/'.$detail['copassport'].'')}}" download target="_blank">{{ $detail['copassport'] }}
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8" style="position: relative;left: 15pc;">
                        Not uploded
                    </div>
                <?php } ?>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Co-applicant Address
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;width:20pc;margin-bottom:0.5pc;">
                    <?php echo !empty($detail->coapp_address) ? $detail->coapp_address : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Customer Type
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->customer_type) ? $detail->customer_type : "-" ?>
                </div>
            </div>
           
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Referrer Name
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->refered_name) ? $detail->refered_name : "-" ?>
                </div>
            </div>
           
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Referrer Mobile Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <span>
                        <?php
                        if (!empty($detail->refered_phone)) {
                            echo  $detail['refered_phone_code'] . ' ';
                        ?>
                    </span>
                <?php
                            echo $detail['refered_phone'];
                        } else {
                            echo "-";
                        }
                ?>
                </div>
            </div>   
            &nbsp;
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Phase
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($phase->phase_name) ? $phase->phase_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Block
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($block->block_name) ? $block->block_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Floor
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($floor->floor_name) ? $floor->floor_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Type
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($flattype->flattype) ? $flattype->flattype : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($flatnumber->flatnumber) ? $flatnumber->flatnumber : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Flat Facing
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->facing) ? $detail->facing : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Saleable Area
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->salable_area) ? $detail->salable_area : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Plinth Area
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->plinth_area) ? $detail->plinth_area : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    UDS Area
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->uds_area) ? $detail->uds_area : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Comn Area
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->comn_area) ? $detail->comn_area : "-" ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>