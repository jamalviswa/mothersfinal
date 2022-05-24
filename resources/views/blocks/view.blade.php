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
                <a href="{{route('blocks.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                        <?php
                        $data['document'] = App\Document::where('customer_id', $detail->customer_id)->where('status', 'Active')->get();
                        $data['cost'] = App\Cost::where('customer_id', $detail->customer_id)->where('status', 'Active')->get();
                        $data['receipt'] = App\Receipt::where('customer_id', $detail->customer_id)->where('status', 'Active')->get();
                        $data['payment'] = App\Payment::where('customer_id', $detail->customer_id)->where('status', 'Active')->get();
                        ?>
                        <div class="accordion">
                            <h4 class="accordion-toggle">Personal Info</h4>
                            <div class="accordion-content" style="margin-top: 15px;">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            NAME OF THE APPLICANT
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->applicant_name  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            APPLICATION NUMBER
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->application_number  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            DATE OF APPLICATION
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->date_of_application  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            FATHER/SPOUSE NAME
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->fathers_name  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            AGE
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->age  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            GENDER
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->gender  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            MOBILE NUMBER
                                        </label>
                                        <div class="col-md-8">
                                            <span>
                                                <?php
                                                echo $detail['phone_code'] . ' ';
                                                ?></span>
                                            <?php echo $detail['phone']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            ALTERNATIVE MOBILE NUMBER
                                        </label>
                                        <div class="col-md-8">
                                            <span>
                                                <?php
                                                echo $detail['altphone_code'] . ' ';
                                                ?></span>
                                            <?php echo $detail['altphone']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            EMAIL
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo $detail->email  ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            OCCUPATION
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo !empty($detail->occupation) ? $detail->occupation : "-" ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            TOTAL YEARS OF EXPERIENCE
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo !empty($detail->experience) ? $detail->experience : "-" ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            RESIDENTIAL/ PERMANENT ADDRESS
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo !empty($detail->permanent_address) ? $detail->permanent_address : "-" ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            CORRESPONDANCE/ PRESENT ADDRESS
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo !empty($detail->present_address) ? $detail->present_address : "-" ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            ANNUAL INCOME
                                        </label>
                                        <div class="col-md-8">
                                            <?php echo !empty($detail->income) ? $detail->income : "-" ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            PHOTO
                                        </label>
                                        <div class="col-md-8">
                                            <img width="100" height="100" src="<?php echo  asset('files/customers/' . $detail->photo) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="accordion-toggle">Document Info</h4>
                            <div class="accordion-content" style="margin-top: 15px;">
                                <?php foreach ($data['document'] as $doc) { ?>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT NAME
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->co_applicant_name) ? $doc->co_applicant_name : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT MAIL ID
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->coapp_email) ? $doc->coapp_email : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT ADDRESS
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->coapp_address) ? $doc->coapp_address : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT MOBILE NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <span>
                                                    <?php
                                                    echo $doc['coapp_phone_code'] . ' ';
                                                    ?></span>
                                                <?php echo $doc['coapp_phone']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                APPLICANT AADHAR NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->aadhar_number) ? $doc->aadhar_number : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                APPLICANT PAN NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->pan_number) ? $doc->pan_number : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                APPLICANT PASSPORT NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->passport_number) ? $doc->passport_number : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT AADHAR NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->coaadhar_number) ? $doc->coaadhar_number : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT PAN NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->copan_number) ? $doc->copan_number : "-" ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CO-APPLICANT PASSPORT NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo !empty($doc->copassport_number) ? $doc->copassport_number : "-" ?>
                                            </div>
                                        </div>
                                        <?php
                                        $phase = App\Phase::where('phase_id', $doc['phase'])->first();
                                        $block = App\Block::where('block_id', $doc['block'])->first();
                                        $floor = App\Floor::where('floor_id', $doc['floor'])->first();
                                        $flattype = App\Flattype::where('flattype_id', $doc['flattype'])->first();
                                        $flatnumber = App\Flatnumber::where('flatnumber_id', $doc['flatnumber'])->first();
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                PHASE
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $phase->phase_name  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                BLOCK
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $block->block_name  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                FLOOR
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $floor->floor_name  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                FLAT TYPE
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $flattype->flattype  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                FLAT NUMBER
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $flatnumber->flatnumber  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                FLAT FACING
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $doc->facing  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                SALEABLE AREA
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $doc->salable_area  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                PLINTH AREA
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $doc->plinth_area  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                UDS AREA
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $doc->uds_area  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                COMN AREA
                                            </label>
                                            <div class="col-md-8">
                                                <?php echo $doc->comn_area  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }  ?>
                            </div>

                            <h4 class="accordion-toggle">Cost Info</h4>
                            <div class="accordion-content" style="margin-top: 15px;">
                                <?php foreach ($data['cost'] as $cos) {
                                ?>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                RATE PER SQFT
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->rate_sqft  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                SALABLE VALUE
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->salable_value  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                GUIDELINE VALUE
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->guideline_value  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                LAND COST
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->land_cost  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CONSTRUCTION COST
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->construction_cost  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                ELECTRICTY CHARGES
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->electricity_charges  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                METRO WATER SUPPLY
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->water_supply  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CAR PARK
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->car_park  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                AMENITIES CHARGES
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->amenities_charges  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                MAINTENANCE CHARGES
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->maintenance  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                GROSS AMOUNT
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->gross_amount  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                STAMP DUTY CHARGES
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->stamp  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                REGISTRATION CHARGES
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->registration  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                REGISTRATION CHARGES FOR CONSTRUCTION AGREEMENT
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->construction  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                CORPUS FUND
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->corpus_fund  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                GST
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->gst  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">
                                                TOTAL AMOUNT
                                            </label>
                                            <div class="col-md-8">
                                            <?php echo 'Rs.' .$cos->total_amount  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>

                            <h4 class="accordion-toggle">Payment Info</h4>
                            <div class="accordion-content" style="margin-top: 15px;">
                            <?php if ($data['payment']->count() > '0') {
                        ?>
                                <div class="table-responsive">
                                    <table class="table m-table m-table--head-bg-brand">
                                        <thead>
                                            <tr>
                                            <th>Gross Amount</th>
                                            <th>Transaction Type</th>
                                            <th>Bank Type</th>
                                            <th>Bank Name</th>
                                            <th>Loan Sansaction Amount</th>
                                            <th>Payment Schedule</th>
                                            <th>Schedule Type</th>
                                            <th>Total Amount</th>
                                            <th>Received Amount</th>
                                            <th>Balance Amount</th>
                                            <th>Payment Date</th>
                                            <th>Transaction Type</th>
                                            <th>Payment Type</th>
                                            <th>Transaction Number</th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['payment'] as $result) {  ?>
                                                <tr>
                                                <td>{{"Rs. "}}{{ $result->gross_amount }}</td>
                                                <td>{{ $result->transaction_type }}</td>
                                                <td>{{ $result->bank_type }}</td>
                                                <td>{{ $result->bank_name }}</td>
                                                <td>
                                                <?php 
                                                if(!empty($result->loan_amount)) {
                                                    echo "Rs. " .$result->loan_amount;
                                                } else {
                                                    echo "- ";
                                                }
                                                    ?>
                                                </td>
                                                <td>{{ $result->payment_schedule }}{{" %"}}</td>

                                                <?php if($result->onbook_received10per != 0)  { ?>
                                                    <td>On Booking 10%</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_balance10per }}</td>
                                                    <td>{{ $result->onbook_paymentdate10per }}</td>
                                                    <td>{{ $result->onbook_transactiontype10per }}</td>
                                                    <td>{{ $result->onbook_paymenttype10per }}</td>
                                                    <?php if($result->onbook_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->onbook_chequenumber10per }}</td>
                                                        <?php } else if($result->onbook_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->onbook_neftid10per }}</td>
                                                            <?php } else if($result->onbook_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->onbook_rtgsid10per }}</td>
                                                                <?php } else if($result->onbook_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                <?php } else  if($result->payments_received10per != 0) { ?>
                                                    <td>Payment for Agreements 40%</td>
                                                    <td>{{"Rs. "}}{{ $result->payments10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_balance10per }}</td>
                                                    <td>{{ $result->payments_paymentdate10per }}</td>
                                                    <td>{{ $result->payments_transactiontype10per }}</td>
                                                    <td>{{ $result->payments_paymenttype10per }}</td>
                                                    <?php if($result->payments_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->payments_chequenumber10per }}</td>
                                                        <?php } else if($result->payments_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->payments_neftid10per }}</td>
                                                            <?php } else if($result->payments_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->payments_rtgsid10per }}</td>
                                                                <?php } else if($result->payments_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                 <?php } else  if($result->first_received10per != 0) { ?>
                                                    <td>Completion of stilt + First Floor 10%</td>
                                                    <td>{{"Rs. "}}{{ $result->first10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_balance10per }}</td>
                                                    <td>{{ $result->first_paymentdate10per }}</td>
                                                    <td>{{ $result->first_transactiontype10per }}</td>
                                                    <td>{{ $result->first_paymenttype10per }}</td>
                                                    <?php if($result->first_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->first_chequenumber10per }}</td>
                                                        <?php } else if($result->first_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->first_neftid10per }}</td>
                                                            <?php } else if($result->first_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->first_rtgsid10per }}</td>
                                                                <?php } else if($result->first_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                    <?php } else  if($result->second_received10per != 0) { ?>
                                                        <td>Completion of Second Floor 10%</td>
                                                        <td>{{"Rs. "}}{{ $result->second10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_balance10per }}</td>
                                                    <td>{{ $result->second_paymentdate10per }}</td>
                                                    <td>{{ $result->second_transactiontype10per }}</td>
                                                    <td>{{ $result->second_paymenttype10per }}</td>
                                                    <?php if($result->second_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->second_chequenumber10per }}</td>
                                                        <?php } else if($result->second_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->second_neftid10per }}</td>
                                                            <?php } else if($result->second_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->second_rtgsid10per }}</td>
                                                                <?php } else if($result->second_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                        <?php } else  if($result->third_received10per != 0) { ?>
                                                            <td>Completion of Third Floor 10%</td>
                                                            <td>{{"Rs. "}}{{ $result->third10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_balance10per }}</td>
                                                    <td>{{ $result->third_paymentdate10per }}</td>
                                                    <td>{{ $result->third_transactiontype10per }}</td>
                                                    <td>{{ $result->third_paymenttype10per }}</td>
                                                    <?php if($result->third_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->third_chequenumber10per }}</td>
                                                        <?php } else if($result->third_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->third_neftid10per }}</td>
                                                            <?php } else if($result->third_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->third_rtgsid10per }}</td>
                                                                <?php } else if($result->third_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                            <?php } else  if($result->fourth_received10per != 0) { ?>
                                                                <td>Completion of Fourth Floor 10%</td>
                                                                <td>{{"Rs. "}}{{ $result->fourth10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_balance10per }}</td>
                                                    <td>{{ $result->fourth_paymentdate10per }}</td>
                                                    <td>{{ $result->fourth_transactiontype10per }}</td>
                                                    <td>{{ $result->fourth_paymenttype10per }}</td>
                                                    <?php if($result->fourth_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->fourth_chequenumber10per }}</td>
                                                        <?php } else if($result->fourth_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->fourth_neftid10per }}</td>
                                                            <?php } else if($result->fourth_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->fourth_rtgsid10per }}</td>
                                                                <?php } else if($result->fourth_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                <?php } else  if($result->fifth_received10per != 0) { ?>
                                                                    <td>Completion of Fifth Floor 5%</td>
                                                                    <td>{{"Rs. "}}{{ $result->fifth10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_balance10per }}</td>
                                                    <td>{{ $result->fifth_paymentdate10per }}</td>
                                                    <td>{{ $result->fifth_transactiontype10per }}</td>
                                                    <td>{{ $result->fifth_paymenttype10per }}</td>
                                                    <?php if($result->fifth_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->fifth_chequenumber10per }}</td>
                                                        <?php } else if($result->fifth_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->fifth_neftid10per }}</td>
                                                            <?php } else if($result->fifth_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->fifth_rtgsid10per }}</td>
                                                                <?php } else if($result->fifth_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>


                                                                    <?php } else  if($result->handover_received10per != 0) { ?>
                                                                        <td>Handovering 5%</td>
                                                                        <td>{{"Rs. "}}{{ $result->handover10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_received10per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_balance10per }}</td>
                                                    <td>{{ $result->handover_paymentdate10per }}</td>
                                                    <td>{{ $result->handover_transactiontype10per }}</td>
                                                    <td>{{ $result->handover_paymenttype10per }}</td>
                                                    <?php if($result->handover_paymenttype10per == "Cheque") { ?>
                                                        <td>{{ $result->handover_chequenumber10per }}</td>
                                                        <?php } else if($result->handover_paymenttype10per == "NEFT") { ?>
                                                            <td>{{ $result->handover_neftid10per }}</td>
                                                            <?php } else if($result->handover_paymenttype10per == "RTGS") { ?>
                                                                <td>{{ $result->handover_rtgsid10per }}</td>
                                                                <?php } else if($result->handover_paymenttype10per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                        <?php } else if($result->onbook_received15per != 0)  { ?>
                                                    <td>On Booking 15%</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_balance15per }}</td>
                                                    <td>{{ $result->onbook_paymentdate15per }}</td>
                                                    <td>{{ $result->onbook_transactiontype15per }}</td>
                                                    <td>{{ $result->onbook_paymenttype15per }}</td>
                                                    <?php if($result->onbook_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->onbook_chequenumber15per }}</td>
                                                        <?php } else if($result->onbook_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->onbook_neftid15per }}</td>
                                                            <?php } else if($result->onbook_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->onbook_rtgsid15per }}</td>
                                                                <?php } else if($result->onbook_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                <?php } else  if($result->payments_received15per != 0) { ?>
                                                    <td>Payment for Agreements 40%</td>
                                                    <td>{{"Rs. "}}{{ $result->payments15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_balance15per }}</td>
                                                    <td>{{ $result->payments_paymentdate15per }}</td>
                                                    <td>{{ $result->payments_transactiontype15per }}</td>
                                                    <td>{{ $result->payments_paymenttype15per }}</td>
                                                    <?php if($result->payments_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->payments_chequenumber15per }}</td>
                                                        <?php } else if($result->payments_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->payments_neftid15per }}</td>
                                                            <?php } else if($result->payments_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->payments_rtgsid15per }}</td>
                                                                <?php } else if($result->payments_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                 <?php } else  if($result->first_received15per != 0) { ?>
                                                    <td>Completion of stilt + First Floor 10%</td>
                                                    <td>{{"Rs. "}}{{ $result->first15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_balance15per }}</td>
                                                    <td>{{ $result->first_paymentdate15per }}</td>
                                                    <td>{{ $result->first_transactiontype15per }}</td>
                                                    <td>{{ $result->first_paymenttype15per }}</td>
                                                    <?php if($result->first_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->first_chequenumber15per }}</td>
                                                        <?php } else if($result->first_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->first_neftid15per }}</td>
                                                            <?php } else if($result->first_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->first_rtgsid15per }}</td>
                                                                <?php } else if($result->first_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                    <?php } else  if($result->second_received15per != 0) { ?>
                                                        <td>Completion of Second Floor 10%</td>
                                                        <td>{{"Rs. "}}{{ $result->second15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_balance15per }}</td>
                                                    <td>{{ $result->second_paymentdate15per }}</td>
                                                    <td>{{ $result->second_transactiontype15per }}</td>
                                                    <td>{{ $result->second_paymenttype15per }}</td>
                                                    <?php if($result->second_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->second_chequenumber15per }}</td>
                                                        <?php } else if($result->second_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->second_neftid15per }}</td>
                                                            <?php } else if($result->second_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->second_rtgsid15per }}</td>
                                                                <?php } else if($result->second_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                        <?php } else  if($result->third_received15per != 0) { ?>
                                                            <td>Completion of Third Floor 10%</td>
                                                            <td>{{"Rs. "}}{{ $result->third15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_balance15per }}</td>
                                                    <td>{{ $result->third_paymentdate15per }}</td>
                                                    <td>{{ $result->third_transactiontype15per }}</td>
                                                    <td>{{ $result->third_paymenttype15per }}</td>
                                                    <?php if($result->third_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->third_chequenumber15per }}</td>
                                                        <?php } else if($result->third_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->third_neftid15per }}</td>
                                                            <?php } else if($result->third_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->third_rtgsid15per }}</td>
                                                                <?php } else if($result->third_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                            <?php } else  if($result->fourth_received15per != 0) { ?>
                                                                <td>Completion of Fourth Floor 5%</td>
                                                                <td>{{"Rs. "}}{{ $result->fourth15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_balance15per }}</td>
                                                    <td>{{ $result->fourth_paymentdate15per }}</td>
                                                    <td>{{ $result->fourth_transactiontype15per }}</td>
                                                    <td>{{ $result->fourth_paymenttype15per }}</td>
                                                    <?php if($result->fourth_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->fourth_chequenumber15per }}</td>
                                                        <?php } else if($result->fourth_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->fourth_neftid15per }}</td>
                                                            <?php } else if($result->fourth_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->fourth_rtgsid15per }}</td>
                                                                <?php } else if($result->fourth_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                <?php } else  if($result->fifth_received15per != 0) { ?>
                                                                    <td>Completion of Fifth Floor 5%</td>
                                                                    <td>{{"Rs. "}}{{ $result->fifth15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_balance15per }}</td>
                                                    <td>{{ $result->fifth_paymentdate15per }}</td>
                                                    <td>{{ $result->fifth_transactiontype15per }}</td>
                                                    <td>{{ $result->fifth_paymenttype15per }}</td>
                                                    <?php if($result->fifth_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->fifth_chequenumber15per }}</td>
                                                        <?php } else if($result->fifth_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->fifth_neftid15per }}</td>
                                                            <?php } else if($result->fifth_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->fifth_rtgsid15per }}</td>
                                                                <?php } else if($result->fifth_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                    <?php } else  if($result->handover_received15per != 0) { ?>
                                                                        <td>Handovering 5%</td>
                                                                        <td>{{"Rs. "}}{{ $result->handover15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_received15per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_balance15per }}</td>
                                                    <td>{{ $result->handover_paymentdate15per }}</td>
                                                    <td>{{ $result->handover_transactiontype15per }}</td>
                                                    <td>{{ $result->handover_paymenttype15per }}</td>
                                                    <?php if($result->handover_paymenttype15per == "Cheque") { ?>
                                                        <td>{{ $result->handover_chequenumber15per }}</td>
                                                        <?php } else if($result->handover_paymenttype15per == "NEFT") { ?>
                                                            <td>{{ $result->handover_neftid15per }}</td>
                                                            <?php } else if($result->handover_paymenttype15per == "RTGS") { ?>
                                                                <td>{{ $result->handover_rtgsid15per }}</td>
                                                                <?php } else if($result->handover_paymenttype15per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                        <?php } else if($result->onbook_received20per != 0)  { ?>
                                                    <td>On Booking 20%</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->onbook_balance20per }}</td>
                                                    <td>{{ $result->onbook_paymentdate20per }}</td>
                                                    <td>{{ $result->onbook_transactiontype20per }}</td>
                                                    <td>{{ $result->onbook_paymenttype20per }}</td>
                                                    <?php if($result->onbook_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->onbook_chequenumber20per }}</td>
                                                        <?php } else if($result->onbook_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->onbook_neftid20per }}</td>
                                                            <?php } else if($result->onbook_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->onbook_rtgsid20per }}</td>
                                                                <?php } else if($result->onbook_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>
                                                   
                                                <?php } else  if($result->payments_received20per != 0) { ?>
                                                    <td>Payment for Agreements 40%</td>
                                                    <td>{{"Rs. "}}{{ $result->payments20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->payments_balance20per }}</td>
                                                    <td>{{ $result->payments_paymentdate20per }}</td>
                                                    <td>{{ $result->payments_transactiontype20per }}</td>
                                                    <td>{{ $result->payments_paymenttype20per }}</td>
                                                    <?php if($result->payments_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->payments_chequenumber20per }}</td>
                                                        <?php } else if($result->payments_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->payments_neftid20per }}</td>
                                                            <?php } else if($result->payments_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->payments_rtgsid20per }}</td>
                                                                <?php } else if($result->payments_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                 <?php } else  if($result->first_received20per != 0) { ?>
                                                    <td>Completion of stilt + First Floor 10%</td>
                                                    <td>{{"Rs. "}}{{ $result->first20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->first_balance20per }}</td>
                                                    <td>{{ $result->first_paymentdate20per }}</td>
                                                    <td>{{ $result->first_transactiontype20per }}</td>
                                                    <td>{{ $result->first_paymenttype20per }}</td>
                                                    <?php if($result->first_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->first_chequenumber20per }}</td>
                                                        <?php } else if($result->first_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->first_neftid20per }}</td>
                                                            <?php } else if($result->first_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->first_rtgsid20per }}</td>
                                                                <?php } else if($result->first_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                    <?php } else  if($result->second_received20per != 0) { ?>
                                                        <td>Completion of Second Floor 10%</td>
                                                        <td>{{"Rs. "}}{{ $result->second20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->second_balance20per }}</td>
                                                    <td>{{ $result->second_paymentdate20per }}</td>
                                                    <td>{{ $result->second_transactiontype20per }}</td>
                                                    <td>{{ $result->second_paymenttype20per }}</td>
                                                    <?php if($result->second_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->second_chequenumber20per }}</td>
                                                        <?php } else if($result->second_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->second_neftid20per }}</td>
                                                            <?php } else if($result->second_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->second_rtgsid20per }}</td>
                                                                <?php } else if($result->second_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                        <?php } else  if($result->third_received20per != 0) { ?>
                                                            <td>Completion of Third Floor 5%</td>
                                                            <td>{{"Rs. "}}{{ $result->third20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->third_balance20per }}</td>
                                                    <td>{{ $result->third_paymentdate20per }}</td>
                                                    <td>{{ $result->third_transactiontype20per }}</td>
                                                    <td>{{ $result->third_paymenttype20per }}</td>
                                                    <?php if($result->third_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->third_chequenumber20per }}</td>
                                                        <?php } else if($result->third_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->third_neftid20per }}</td>
                                                            <?php } else if($result->third_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->third_rtgsid20per }}</td>
                                                                <?php } else if($result->third_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                            <?php } else  if($result->fourth_received20per != 0) { ?>
                                                                <td>Completion of Fourth Floor 5%</td>
                                                                <td>{{"Rs. "}}{{ $result->fourth20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fourth_balance20per }}</td>
                                                    <td>{{ $result->fourth_paymentdate20per }}</td>
                                                    <td>{{ $result->fourth_transactiontype20per }}</td>
                                                    <td>{{ $result->fourth_paymenttype20per }}</td>
                                                    <?php if($result->fourth_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->fourth_chequenumber20per }}</td>
                                                        <?php } else if($result->fourth_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->fourth_neftid20per }}</td>
                                                            <?php } else if($result->fourth_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->fourth_rtgsid20per }}</td>
                                                                <?php } else if($result->fourth_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                <?php } else  if($result->fifth_received20per != 0) { ?>
                                                                    <td>Completion of Fifth Floor 5%</td>
                                                                    <td>{{"Rs. "}}{{ $result->fifth20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->fifth_balance20per }}</td>
                                                    <td>{{ $result->fifth_paymentdate20per }}</td>
                                                    <td>{{ $result->fifth_transactiontype20per }}</td>
                                                    <td>{{ $result->fifth_paymenttype20per }}</td>
                                                    <?php if($result->fifth_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->fifth_chequenumber20per }}</td>
                                                        <?php } else if($result->fifth_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->fifth_neftid20per }}</td>
                                                            <?php } else if($result->fifth_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->fifth_rtgsid20per }}</td>
                                                                <?php } else if($result->fifth_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                    <?php } else  if($result->handover_received20per != 0) { ?>
                                                                        <td>Handovering 5%</td>
                                                                        <td>{{"Rs. "}}{{ $result->handover20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_received20per }}</td>
                                                    <td>{{"Rs. "}}{{ $result->handover_balance20per }}</td>
                                                    <td>{{ $result->handover_paymentdate20per }}</td>
                                                    <td>{{ $result->handover_transactiontype20per }}</td>
                                                    <td>{{ $result->handover_paymenttype20per }}</td>
                                                    <?php if($result->handover_paymenttype20per == "Cheque") { ?>
                                                        <td>{{ $result->handover_chequenumber20per }}</td>
                                                        <?php } else if($result->handover_paymenttype20per == "NEFT") { ?>
                                                            <td>{{ $result->handover_neftid20per }}</td>
                                                            <?php } else if($result->handover_paymenttype20per == "RTGS") { ?>
                                                                <td>{{ $result->handover_rtgsid20per }}</td>
                                                                <?php } else if($result->handover_paymenttype20per == "Cash") { ?>
                                                                    <td><?php echo "-";?></td>
                                                                    <?php } ?>

                                                                        <?php } ?>


                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                            <div class="text-center">
                                <img src="{{ asset('admin/img/no-record.png') }}">
                            </div>
                        <?php } ?>
                               
                                
                            </div>

                            <h4 class="accordion-toggle">Receipt Info</h4>
                            <div class="accordion-content" style="margin-top: 15px;">
                            <?php if ($data['receipt']->count() > '0') {
                        ?>
                                <div class="table-responsive">
                                    <table class="table m-table m-table--head-bg-brand">
                                        <thead>
                                            <tr>
                                                <th>Receipt No</th>
                                                <th>Receipt Date</th>
                                                <th>Receipt Amount</th>
                                                <th>Cheque/DD No</th>
                                                <th>Cheque Date</th>
                                                <th>Drawn On</th>
                                                <th>Bank Towards</th>
                                                <th>Referred By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['receipt'] as $rec) {  
                                                 
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
                                <?php } else { ?>
                            <div class="text-center">
                                <img src="{{ asset('admin/img/no-record.png') }}">
                            </div>
                        <?php } ?>
                            </div>
                        </div>
                        <div class="download_pdf">
                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download" href="{{ route('blocks.invoicepdf',$detail['customer_id']) }}" target="_blank" download>
                                Download PDF<i style="color: white;font-size: 18px !important;" class="fa fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <style>
        .application a.btn.btn-secondary.m-btn.m-btn--air.m-btn--custom {
            padding: 17px;
            background: #0054ac;
            color: white;
            border-radius: 0px;
        }

        .download_pdf {
            margin-top: 24px;
            text-align: right;
        }

        .application i.fa.fa-comments {
            color: white !important;
            padding: 0px 10px;
        }

        .application label.alert-danger {
            padding: 0px 6px;
            background: red;
        }

        .application a#pills-apllicaton-tab,
        a#pills-online_apllicaton-tab {
            background: white !important;
            color: #0054ac;
            padding: 15px 26px 15px 12px;
            font-size: larger;
            border-radius: 0px;
        }

        .application a#pills-apllicaton-tab.active,
        a#pills-online_apllicaton-tab.active {
            border-bottom: 3px solid;
        }

        .application .nav.nav-pills .nav-item,
        .nav.nav-tabs .nav-item {
            margin-left: 2px;
            margin-bottom: 0px;
        }

        .application ul#pills-tab {
            margin-left: 15px;
            margin-bottom: 0px !important;
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

        .accordion h4 {
            font-size: 16px;
        }

        .accordion-toggle {
            border-bottom: 1px solid #cccccc;
            cursor: pointer;
            margin: 0;
            padding: 10px 0;
            position: relative;
        }

        .accordion-toggle.active:after {
            content: "";
            position: absolute;
            right: 0;
            top: 17px;
            width: 0;
            height: 0;
            border-bottom: 5px solid #f00;
            border-left: 5px solid rgba(0, 0, 0, 0);
            border-right: 5px solid rgba(0, 0, 0, 0);
        }

        .accordion-toggle:before {
            content: "";
            position: absolute;
            right: 0;
            top: 17px;
            width: 0;
            height: 0;
            border-top: 5px solid #000;
            border-left: 5px solid rgba(0, 0, 0, 0);
            border-right: 5px solid rgba(0, 0, 0, 0);
        }

        .accordion-toggle.active:before {
            display: none;
        }

        .accordion-content {
            display: none;
        }

        .accordion-toggle.active {
            color: #0054ac;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.accordion').find('.accordion-toggle').click(function() {
                $(this).next().slideToggle('600');
                $(".accordion-content").not($(this).next()).slideUp('600');
            });
            $('.accordion-toggle').on('click', function() {
                $(this).toggleClass('active').siblings().removeClass('active');
            });
        });
    </script>
    @endsection