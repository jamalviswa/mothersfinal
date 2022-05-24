<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$detail = App\Customer::where('customer_id', '=', $customer_id)->first();
if (!empty($detail)) {
?>
    <img style="width: 30%;position: relative;bottom: 13px;" src="{{ public_path('/admin/img/logos/logo.png') }}" />
    <div class="row" style="font-size: 15px;">
        <div class="col-md-6">
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Customer Information</h4>
            <h4 style="color: #e51a4b;font-size: 18px !important;font-weight: bolder;">Payment Details</h4>
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
            <?php $details = App\Cost::where('customer_id', $detail->customer_id)->first(); ?>
            <div class="form-group row" style="display: flex;">
                <label class="col-md-4" style="font-weight:bold;">
                    Gross Amount
                </label>
                <div class="col-md-8" style="position: relative;left: 22pc;">
                    <?php echo !empty($details->gross_amount) ? "Rs. " . $details->gross_amount : "-" ?>
                </div>
            </div>

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
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
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
<?php } ?>