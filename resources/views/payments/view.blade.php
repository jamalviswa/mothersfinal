@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    View Payment History
                </h3>
            </div>
            <div>
                <a href="{{route('payments.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back To List">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        
        <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                   
                            <div class="table-responsive">

                                <table class="table m-table m-table--head-bg-brand">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>Applicant Name</th>
                                            <th>Application Number</th>
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
                                            <th>Added By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = ($results->currentpage() - 1) * $results->perpage() + 1;
                                        foreach ($results as $result) {
                                           
                                        ?>
                                       
                                            <tr>
                                                <td width="5%">{{ $i }}</td>
                                                <td>{{ $result->applicant_name }}</td>
                                                <td>{{ $result->application_number }}</td>
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


                                                      
                                               
                                      
                                               

                                                <td>{{ $result->addedby }}</td>
                                               
                                                
                                            </tr>
                            <?php
                                           $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                               
                            </div>
                            <div class="download_pdf">
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download" href="{{ route('payments.invoicepdf',$result['customer_id']) }}" target="_blank" download>
                                                Download PDF<i style="color: white;font-size: 18px !important;" class="fa fa-download"></i>
                                            </a>
                                        </div>
                            {!! $results->appends(\Request::except('page'))->render() !!}
                            <!--@include('pagination.default', ['paginator' => $results])-->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
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