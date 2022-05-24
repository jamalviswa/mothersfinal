@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Payment Info
                </h3>
            </div>
            <div>
                <a href="{{route('payments.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                                        <h5 class="j_head" style="background:#e51a4b;">PAYMENT DETAILS</h5>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                NAME OF THE APPLICANT
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->applicant_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                APPLICATION NUMBER
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->application_number }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                DATE OF APPLICATION
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->date_of_application }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                GROSS AMOUNT
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->gross_amount }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 offset-md-1">
                                                PAYMENT SCHEDULE
                                            </label>
                                            <div class="col-md-5">
                                                {{ $detail->payment_schedule }}
                                            </div>
                                        </div>
                                        <?php
                                        if ($detail->payment_schedule == 10) {
                                            if ($detail->onbook_received10per != 0) {
                                        ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        ONBOOKING 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->payments_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Payment for Agreements 40%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->first_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of stilt + First Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->second_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Second Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->third_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Third Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->fourth_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Fourth Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->fifth_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Fifth Floor 5%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_neftid10per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->handover_received10per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Handovering 5%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_received10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_balance10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_paymentdate10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_transactiontype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_paymenttype10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_chequenumber10per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_neftid10per }}
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>

<?php
                                        if ($detail->payment_schedule == 15) {
                                            if ($detail->onbook_received15per != 0) {
                                        ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        ONBOOKING 15%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } 
                                             if ($detail->payments_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Payment for Agreements 40%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->payments_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } 
                                             if ($detail->first_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of stilt + First Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->first_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } 
                                             if ($detail->second_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Second Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->second_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->third_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Third Floor 10%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->third_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->fourth_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Fourth Floor 5%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fourth_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->fifth_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Completion of Fifth Floor 5%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->fifth_neftid15per }}
                                                    </div>
                                                </div>
                                            <?php } else if ($detail->handover_received15per != 0) {  ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        Handovering 5%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_received15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_balance15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_paymentdate15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_transactiontype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_paymenttype15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_chequenumber15per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->handover_neftid15per }}
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>










































                                      

                                        <?php
                                        if ($detail->payment_schedule == 20) {
                                            if ($detail->onbook_received20per != 0) {
                                        ?>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1 j_col">
                                                        ONBOOKING 20%
                                                    </label>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TOTAL AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        RECEIVED AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_received20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        BALANCE AMOUNT
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_balance20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT DATE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymentdate20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        TRANSACTION TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_transactiontype20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        PAYMENT TYPE
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_paymenttype20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        CHEQUE NUMBER
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_chequenumber20per }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 offset-md-1">
                                                        NEFT ID
                                                    </label>
                                                    <div class="col-md-5">
                                                        {{ $detail->onbook_neftid20per }}
                                                    </div>
                                                </div>
                                        <?php }
                                        }
                                        ?>


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

    .j_col {
        color: #e51a4b;
        font-weight: 700;
    }
</style>
@endsection