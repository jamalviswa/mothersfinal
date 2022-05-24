<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$detail = App\Customer::where('customer_id', '=', $customer_id)->first();
if (!empty($detail)) {
?>
    <img style="width: 30%;position: relative;bottom: 13px;" src="{{ public_path('/admin/img/logos/logo.png') }}" />
    <div class="row" style="font-size: 15px;">
        <div class="col-md-6">
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Customer Information</h4>
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Personal Details</h4>
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
                    Father/Spouse Name
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->fathers_name) ? $detail->fathers_name : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Age
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->age) ? $detail->age : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Gender
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->gender) ? $detail->gender : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Mobile Number
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
                    Alternative Mobile Number
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
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
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->email) ? $detail->email : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Occupation
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->occupation) ? $detail->occupation : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Total Years of Experience
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php echo !empty($detail->experience) ? $detail->experience ." Years" : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Residential/Permanent Address
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;width:15pc;margin-bottom:1pc;">
                    <?php echo !empty($detail->permanent_address) ? $detail->permanent_address : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Correspondance/Present Address
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;width:15pc;margin-bottom:1pc;">
                    <?php echo !empty($detail->present_address) ? $detail->present_address : "-" ?>
                </div>
            </div>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Annual Income
                </label>
                <div class="col-md-8" style="position: relative;left: 15pc;">
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
                <div class="col-md-8" style="position: relative;left: 15pc;">
                    <?php if (!empty($detail->photo)) { ?>
                        <img width="50" height="50" src="<?php echo  public_path('files/customers/' . $detail->photo) ?>">
                    <?php } else { ?>
                        <img width="50" height="50" src="<?php echo  public_path('files/customers/user.png') ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>