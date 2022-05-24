@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Payment Details
                </h3>
            </div>
            <div>
                <a href="{{route('payments.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <form method="post" action="{{ route('payments.store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">

                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Application number<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control m-select2" id="country" name="application_number">
                                                    <option>Select Application Number</option>
                                                    <?php
                                                    $phases = App\Cost::where('status', 'Active')->get();
                                                    foreach ($phases as $phase) {
                                                        $costs = App\Payment::where('status','!=','Trash')->where('customer_id',$phase['customer_id'])->where('application_number',$phase['application_number'])->first();
                                                        if(empty($costs)){
                                                            $disable ="";
                                                        }else{
                                                            $disable ="disabled";
                                                        }
                                                    ?>
                                                        <option value="<?php echo $phase->customer_id ?>" <?php echo $disable;?>><?php echo $phase->application_number ?></option>

                                                    <?php }
                                                    ?>
                                                </select>
                                                @error('application_number')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7 state" id="state1">
                                                <input type="text" disabled autocomplete="off" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Date <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7 states" id="state2">
                                                <input type="text" disabled autocomplete="off" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Gross Amount <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7" id="state3">
                                                <input type="text" disabled autocomplete="off" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                 Transaction Type <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control transaction" name="transaction_type">
                                                    <option value="">--Select--</option>
                                                    <option {{ old('transaction_type')=="Ownfund"?"selected":"" }} value="Ownfund">Own Fund</option>
                                                    <option {{ old('transaction_type')=="Bank"?"selected":"" }} value="Bank">Bank</option>
                                                </select>
                                                @error('transaction_type')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="banktype">
                                            <label class="col-md-5">
                                                 Bank Type <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control banks" name="bank_type">
                                                    <option value="">--Select--</option>
                                                    <option value="SBI">SBI</option>
                                                    <option value="HDFC">HDFC</option>
                                                    <option value="IOB">IOB</option>
                                                    <option value="LIC">LIC</option>
                                                    <option value="CANARA">CANARA</option>
                                                    <option value="OTHERS">OTHERS</option>
                                                </select>
                                                @error('bank_type')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row"  style="display: none;" id="bankname">
                                            <label class="col-md-5">
                                                 Bank Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                            <input value="{{ old('bank_name') }}" type="text" autocomplete="off" class="form-control" name="bank_name" />
                                                @error('bank_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row"  style="display: none;" id="loan">
                                            <label class="col-md-5">
                                                 Loan Sansaction Amount <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                            <input value="{{ old('loan_amount') }}" type="text" autocomplete="off" class="form-control" name="loan_amount" />
                                                @error('loan_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Payment Schedule<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control payment" name="payment_schedule" id="percentage">
                                                    <option value="">--Select--</option>
                                                    <option value="10">10%</option>
                                                    <option value="15">15%</option>
                                                    <option value="20">20%</option>

                                                </select>
                                                @error('payment_schedule')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                       
                                    </div>
                                </div>
                                <!-- Begin :: 10 Percentage payment type Details -->
                                <div class="m-portlet" id="payment1" style="display: none;">
                                    <div class="m-portlet__body">
                                        <!--begin::Section-->
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <div class="table-responsive">
                                                    <table class="table m-table m-table--head-bg-brand">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Payment Schedule</th>
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
                                                            <tr>
                                                                <td width="5%">
                                                                    1.
                                                                </td>
                                                                <td>
                                                                    On Booking 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook10per') }}" class="form-control" type="text" disabled name="onbook10per" id="menu_price" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_received10per') }}" type="text" autocomplete="off" class="form-control" id="recamount" name="onbook_received10per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_balance10per') }}" class="form-control" type="text" disabled name="onbook_balance10per" id="balamount" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="onbook_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="onbook_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control onbook" name="onbook_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="onchequetd" style="display:none;">
                                                                    <input value="{{ old('onbook_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="onbook_chequenumber10per" />
                                                                </td>
                                                                <td id="oncashtd">
                                                                    <input value="" disabled type="text" class="form-control" />
                                                                </td>
                                                                <td id="onnefttd" style="display:none;">
                                                                    <input value="{{ old('onbook_neftid10per') }}" autocomplete="off" type="text" placeholder="NEFT ID" class="form-control" name="onbook_neftid10per" />
                                                                </td>
                                                                <td id="onrtgstd" style="display:none;">
                                                                    <input value="{{ old('onbook_rtgsid10per') }}" autocomplete="off" type="text" placeholder="RTGS No" class="form-control" name="onbook_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    2.
                                                                </td>
                                                                <td>
                                                                    Payment for Agreements 40%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments10per') }}" class="form-control" type="text" disabled name="payments10per" id="menu_price1" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_received10per') }}" autocomplete="off" type="text" class="form-control" name="payments_received10per" id="recamount1" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_balance10per') }}" class="form-control" type="text" disabled name="payments_balance10per" id="balamount1" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="payments_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="payments_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control agreements" name="payments_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="agreementschequetd" style="display:none;">
                                                                    <input value="{{ old('payments_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="payments_chequenumber10per" />
                                                                </td>
                                                                <td id="agreementscashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="agreementsnefttd" style="display:none;">
                                                                    <input value="{{ old('payments_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="payments_neftid10per" />
                                                                </td>
                                                                <td id="agreementsrtgstd" style="display:none;">
                                                                    <input value="{{ old('payments_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="payments_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    3.
                                                                </td>
                                                                <td>
                                                                    Completion of stilt + First Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first10per') }}" class="form-control" type="text" disabled name="first10per" id="menu_price2" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_received10per') }}" type="text" autocomplete="off" class="form-control" name="first_received10per" id="recamount2" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_balance10per') }}" class="form-control" type="text" disabled name="first_balance10per" id="balamount2" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="first_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="first_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 1stfloor" name="first_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="1stfloorchequetd" style="display:none;">
                                                                    <input value="{{ old('first_chequenumber10per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="first_chequenumber10per" />
                                                                </td>
                                                                <td id="1stfloorcashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="1stfloornefttd" style="display:none;">
                                                                    <input value="{{ old('first_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="first_neftid10per" />
                                                                </td>
                                                                <td id="1stfloorrtgstd" style="display:none;">
                                                                    <input value="{{ old('first_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="first_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    4.
                                                                </td>
                                                                <td>
                                                                    Completion of Second Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second10per') }}" class="form-control" type="text" disabled name="second10per" id="menu_price3" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_received10per') }}" type="text" autocomplete="off" class="form-control" name="second_received10per" id="recamount3" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_balance10per') }}" class="form-control" type="text" disabled name="second_balance10per" id="balamount3" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="second_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="second_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 2ndfloor" name="second_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="2ndfloorchequetd" style="display:none;">
                                                                    <input value="{{ old('second_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="second_chequenumber10per" />
                                                                </td>
                                                                <td id="2ndfloorcashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="2ndfloornefttd" style="display:none;">
                                                                    <input value="{{ old('second_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="second_neftid10per" />
                                                                </td>
                                                                <td id="2ndfloorrtgstd" style="display:none;">
                                                                    <input value="{{ old('second_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="second_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    5.
                                                                </td>
                                                                <td>
                                                                    Completion of Third Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third10per') }}" class="form-control" type="text" disabled name="third10per" id="menu_price4" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_received10per') }}" type="text" autocomplete="off" class="form-control" name="third_received10per" id="recamount4" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_balance10per') }}" class="form-control" type="text" disabled name="third_balance10per" id="balamount4" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="third_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="third_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 3rdfloor" name="third_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="3rdfloorchequetd" style="display:none;">
                                                                    <input value="{{ old('third_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="third_chequenumber10per" />
                                                                </td>
                                                                <td id="3rdfloorcashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="3rdfloornefttd" style="display:none;">
                                                                    <input value="{{ old('third_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="third_neftid10per" />
                                                                </td>
                                                                <td id="3rdfloorrtgstd" style="display:none;">
                                                                    <input value="{{ old('third_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="third_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    6.
                                                                </td>
                                                                <td>
                                                                    Completion of Fourth Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth10per') }}" class="form-control" type="text" disabled name="fourth10per" id="menu_price5" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_received10per') }}" type="text" autocomplete="off" class="form-control" name="fourth_received10per" id="recamount5" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_balance10per') }}" class="form-control" type="text" disabled name="fourth_balance10per" id="balamount5" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fourth_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fourth_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 4thfloor" name="fourth_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="4thfloorchequetd" style="display:none;">
                                                                    <input value="{{ old('fourth_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="fourth_chequenumber10per" />
                                                                </td>
                                                                <td id="4thfloorcashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="4thfloornefttd" style="display:none;">
                                                                    <input value="{{ old('fourth_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="fourth_neftid10per" />
                                                                </td>
                                                                <td id="4thfloorrtgstd" style="display:none;">
                                                                    <input value="{{ old('fourth_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fourth_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    7.
                                                                </td>
                                                                <td>
                                                                    Completion of Fifth Floor 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth10per') }}" class="form-control" type="text" disabled name="fifth10per" id="menu_price6" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_received10per') }}" type="text" autocomplete="off" class="form-control" name="fifth_received10per" id="recamount6" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_balance10per') }}" class="form-control" type="text" disabled name="fifth_balance10per" id="balamount6" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fifth_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fifth_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 5thfloor" name="fifth_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="5thfloorchequetd" style="display:none;">
                                                                    <input value="{{ old('fifth_chequenumber10per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="fifth_chequenumber10per" />
                                                                </td>
                                                                <td id="5thfloorcashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="5thfloornefttd" style="display:none;">
                                                                    <input value="{{ old('fifth_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="fifth_neftid10per" />
                                                                </td>
                                                                <td id="5thfloorrtgstd" style="display:none;">
                                                                    <input value="{{ old('fifth_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fifth_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    8.
                                                                </td>
                                                                <td>
                                                                    Handovering 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover10per') }}" class="form-control" type="text" disabled name="handover10per" id="menu_price7" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_received10per') }}" type="text" autocomplete="off" class="form-control" name="handover_received10per" id="recamount7" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_balance10per') }}" class="form-control" type="text" disabled name="handover_balance10per" id="balamount7" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_paymentdate10per') }}" type="text" autocomplete="off" class="form-control datepicker" name="handover_paymentdate10per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="handover_transactiontype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control handover" name="handover_paymenttype10per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="handoverchequetd" style="display:none;">
                                                                    <input value="{{ old('handover_chequenumber10per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="handover_chequenumber10per" />
                                                                </td>
                                                                <td id="handovercashtd">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="handovernefttd" style="display:none;">
                                                                    <input value="{{ old('handover_neftid10per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="handover_neftid10per" />
                                                                </td>
                                                                <td id="handoverrtgstd" style="display:none;">
                                                                    <input value="{{ old('handover_rtgsid10per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="handover_rtgsid10per" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End :: 10 Percentage payment type Details -->

                                <!-- Begin :: 15 Percentage payment type Details -->
                                <div class="m-portlet" id="payment2" style="display: none;">
                                    <div class="m-portlet__body">
                                        <!--begin::Section-->
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <div class="table-responsive">
                                                    <table class="table m-table m-table--head-bg-brand ment">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Payment Schedule</th>
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
                                                            <tr>
                                                                <td width="5%">
                                                                    1.
                                                                </td>
                                                                <td>
                                                                    On Booking 15%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook15per') }}" class="form-control" type="text" disabled name="onbook15per" id="menu_price15per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_received15per') }}" type="text" autocomplete="off" class="form-control" id="recamount15per" name="onbook_received15per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_balance15per') }}" class="form-control" type="text" disabled name="onbook_balance15per" id="balamount15per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="onbook_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="onbook_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control onbook15per" name="onbook_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="onchequetd15per" style="display:none;">
                                                                    <input value="{{ old('onbook_chequenumber15per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="onbook_chequenumber15per" />
                                                                </td>
                                                                <td id="oncashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="onnefttd15per" style="display:none;">
                                                                    <input value="{{ old('onbook_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="onbook_neftid15per" />
                                                                </td>
                                                                <td id="onrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('onbook_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="onbook_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    2.
                                                                </td>
                                                                <td>
                                                                    Payment for Agreements 40%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments15per') }}" class="form-control" type="text" disabled name="payments15per" id="menu_price115per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_received15per') }}" type="text" autocomplete="off" class="form-control" name="payments_received15per" id="recamount115per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_balance15per') }}" class="form-control" type="text" disabled name="payments_balance15per" id="balamount115per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="payments_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="payments_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control agreements15per" name="payments_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="agreementschequetd15per" style="display:none;">
                                                                    <input value="{{ old('payments_chequenumber15per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="payments_chequenumber15per" />
                                                                </td>
                                                                <td id="agreementscashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="agreementsnefttd15per" style="display:none;">
                                                                    <input value="{{ old('payments_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="payments_neftid15per" />
                                                                </td>
                                                                <td id="agreementsrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('payments_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="payments_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    3.
                                                                </td>
                                                                <td>
                                                                    Completion of stilt + First Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first15per') }}" class="form-control" type="text" disabled name="first15per" id="menu_price215per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_received15per') }}" type="text" autocomplete="off" class="form-control" name="first_received15per" id="recamount215per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_balance15per') }}" class="form-control" type="text" disabled name="first_balance15per" id="balamount215per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="first_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="first_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 1stfloor15per" name="first_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="1stfloorchequetd15per" style="display:none;">
                                                                    <input value="{{ old('first_chequenumber15per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="first_chequenumber15per" />
                                                                </td>
                                                                <td id="1stfloorcashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="1stfloornefttd15per" style="display:none;">
                                                                    <input value="{{ old('first_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="first_neftid15per" />
                                                                </td>
                                                                <td id="1stfloorrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('first_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="first_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    4.
                                                                </td>
                                                                <td>
                                                                    Completion of Second Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second15per') }}" class="form-control" type="text" disabled name="second15per" id="menu_price315per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_received15per') }}" type="text" autocomplete="off" class="form-control" name="second_received15per" id="recamount315per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_balance15per') }}" class="form-control" type="text" disabled name="second_balance15per" id="balamount315per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="second_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="second_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 2ndfloor15per" name="second_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="2ndfloorchequetd15per" style="display:none;">
                                                                    <input value="{{ old('second_chequenumber15per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="second_chequenumber15per" />
                                                                </td>
                                                                <td id="2ndfloorcashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="2ndfloornefttd15per" style="display:none;">
                                                                    <input value="{{ old('second_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="second_neftid15per" />
                                                                </td>
                                                                <td id="2ndfloorrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('second_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="second_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    5.
                                                                </td>
                                                                <td>
                                                                    Completion of Third Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third15per') }}" class="form-control" type="text" disabled name="third15per" id="menu_price415per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_received15per') }}" type="text" autocomplete="off" class="form-control" name="third_received15per" id="recamount415per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_balance15per') }}" class="form-control" type="text" disabled name="third_balance15per" id="balamount415per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="third_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="third_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 3rdfloor15per" name="third_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="3rdfloorchequetd15per" style="display:none;">
                                                                    <input value="{{ old('third_chequenumber15per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="third_chequenumber15per" />
                                                                </td>
                                                                <td id="3rdfloorcashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="3rdfloornefttd15per" style="display:none;">
                                                                    <input value="{{ old('third_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="third_neftid15per" />
                                                                </td>
                                                                <td id="3rdfloorrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('third_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="third_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    6.
                                                                </td>
                                                                <td>
                                                                    Completion of Fourth Floor 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth15per') }}" class="form-control" type="text" disabled name="fourth15per" id="menu_price515per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_received15per') }}" type="text" autocomplete="off" class="form-control" name="fourth_received15per" id="recamount515per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_balance15per') }}" class="form-control" type="text" disabled name="fourth_balance15per" id="balamount515per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fourth_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fourth_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 4thfloor15per" name="fourth_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="4thfloorchequetd15per" style="display:none;">
                                                                    <input value="{{ old('fourth_chequenumber15per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="fourth_chequenumber15per" />
                                                                </td>
                                                                <td id="4thfloorcashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="4thfloornefttd15per" style="display:none;">
                                                                    <input value="{{ old('fourth_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="fourth_neftid15per" />
                                                                </td>
                                                                <td id="4thfloorrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('fourth_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fourth_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    7.
                                                                </td>
                                                                <td>
                                                                    Completion of Fifth Floor 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth15per') }}" class="form-control" type="text" disabled name="fifth15per" id="menu_price615per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_received15per') }}" type="text" autocomplete="off" class="form-control" name="fifth_received15per" id="recamount615per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_balance15per') }}" class="form-control" type="text" disabled name="fifth_balance15per" id="balamount615per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fifth_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fifth_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 5thfloor15per" name="fifth_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="5thfloorchequetd15per" style="display:none;">
                                                                    <input value="{{ old('fifth_chequenumber15per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="fifth_chequenumber15per" />
                                                                </td>
                                                                <td id="5thfloorcashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="5thfloornefttd15per" style="display:none;">
                                                                    <input value="{{ old('fifth_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="fifth_neftid15per" />
                                                                </td>
                                                                <td id="5thfloorrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('fifth_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fifth_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    8.
                                                                </td>
                                                                <td>
                                                                    Handovering 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover15per') }}" class="form-control" type="text" disabled name="handover15per" id="menu_price715per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_received15per') }}" type="text" autocomplete="off" class="form-control" name="handover_received15per" id="recamount715per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_balance15per') }}" class="form-control" type="text" disabled name="handover_balance15per" id="balamount715per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_paymentdate15per') }}" type="text" autocomplete="off" class="form-control datepicker" name="handover_paymentdate15per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="handover_transactiontype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control handover15per" name="handover_paymenttype15per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="handoverchequetd15per" style="display:none;">
                                                                    <input value="{{ old('handover_chequenumber15per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="handover_chequenumber15per" />
                                                                </td>
                                                                <td id="handovercashtd15per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="handovernefttd15per" style="display:none;">
                                                                    <input value="{{ old('handover_neftid15per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="handover_neftid15per" />
                                                                </td>
                                                                <td id="handoverrtgstd15per" style="display:none;">
                                                                    <input value="{{ old('handover_rtgsid15per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="handover_rtgsid15per" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End :: 15 Percentage payment type Details -->

                                <!-- Begin :: 20 Percentage payment type Details -->
                                <div class="m-portlet" id="payment3" style="display: none;">
                                    <div class="m-portlet__body">
                                        <!--begin::Section-->
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <div class="table-responsive">
                                                    <table class="table m-table m-table--head-bg-brand pay">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Payment Schedule</th>
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
                                                            <tr>
                                                                <td width="5%">
                                                                    1.
                                                                </td>
                                                                <td>
                                                                    On Booking 20%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook20per') }}" class="form-control" type="text" disabled name="onbook20per" id="menu_price20per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_received20per') }}" type="text" autocomplete="off" class="form-control" id="recamount20per" name="onbook_received20per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_balance20per') }}" class="form-control" type="text" disabled name="onbook_balance20per" id="balamount20per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('onbook_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="onbook_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="onbook_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control onbook20per" name="onbook_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="onchequetd20per" style="display:none;">
                                                                    <input value="{{ old('onbook_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="onbook_chequenumber20per" />
                                                                </td>
                                                                <td id="oncashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="onnefttd20per" style="display:none;">
                                                                    <input value="{{ old('onbook_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="onbook_neftid20per" />
                                                                </td>
                                                                <td id="onrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('onbook_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="onbook_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    2.
                                                                </td>
                                                                <td>
                                                                    Payment for Agreements 40%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments20per') }}" class="form-control" type="text" disabled name="payments20per" id="menu_price120per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_received20per') }}" type="text" autocomplete="off" class="form-control" name="payments_received20per" id="recamount120per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_balance20per') }}" class="form-control" type="text" disabled name="payments_balance20per" id="balamount120per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('payments_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="payments_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="payments_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control agreements20per" name="payments_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="agreementschequetd20per" style="display:none;">
                                                                    <input value="{{ old('payments_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="payments_chequenumber20per" />
                                                                </td>
                                                                <td id="agreementscashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="agreementsnefttd20per" style="display:none;">
                                                                    <input value="{{ old('payments_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="payments_neftid20per" />
                                                                </td>
                                                                <td id="agreementsrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('payments_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="payments_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    3.
                                                                </td>
                                                                <td>
                                                                    Completion of stilt + First Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first20per') }}" class="form-control" type="text" disabled name="first20per" id="menu_price220per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_received20per') }}" type="text" autocomplete="off" class="form-control" name="first_received20per" id="recamount220per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_balance20per') }}" class="form-control" type="text" disabled name="first_balance20per" id="balamount220per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('first_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="first_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="first_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 1stfloor20per" name="first_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="1stfloorchequetd20per" style="display:none;">
                                                                    <input value="{{ old('first_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="first_chequenumber20per" />
                                                                </td>
                                                                <td id="1stfloorcashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="1stfloornefttd20per" style="display:none;">
                                                                    <input value="{{ old('first_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="first_neftid20per" />
                                                                </td>
                                                                <td id="1stfloorrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('first_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="first_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    4.
                                                                </td>
                                                                <td>
                                                                    Completion of Second Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second20per') }}" class="form-control" type="text" disabled name="second20per" id="menu_price320per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_received20per') }}" type="text" autocomplete="off" class="form-control" name="second_received20per" id="recamount320per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_balance20per') }}" class="form-control" type="text" disabled name="second_balance20per" id="balamount320per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('second_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="second_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="second_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 2ndfloor20per" name="second_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="2ndfloorchequetd20per" style="display:none;">
                                                                    <input value="{{ old('second_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="second_chequenumber20per" />
                                                                </td>
                                                                <td id="2ndfloorcashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="2ndfloornefttd20per" style="display:none;">
                                                                    <input value="{{ old('second_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="second_neftid20per" />
                                                                </td>
                                                                <td id="2ndfloorrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('second_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="second_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    5.
                                                                </td>
                                                                <td>
                                                                    Completion of Third Floor 10%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third20per') }}" class="form-control" type="text" disabled name="third20per" id="menu_price420per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_received20per') }}" type="text" autocomplete="off" class="form-control" name="third_received20per" id="recamount420per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_balance20per') }}" class="form-control" type="text" disabled name="third_balance20per" id="balamount420per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('third_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="third_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="third_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 3rdfloor20per" name="third_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="3rdfloorchequetd20per" style="display:none;">
                                                                    <input value="{{ old('third_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="third_chequenumber20per" />
                                                                </td>
                                                                <td id="3rdfloorcashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="3rdfloornefttd20per" style="display:none;">
                                                                    <input value="{{ old('third_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="third_neftid20per" />
                                                                </td>
                                                                <td id="3rdfloorrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('third_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="third_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    6.
                                                                </td>
                                                                <td>
                                                                    Completion of Fourth Floor 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth20per') }}" class="form-control" type="text" disabled name="fourth20per" id="menu_price520per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_received20per') }}" type="text" autocomplete="off" class="form-control" name="fourth_received20per" id="recamount520per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_balance20per') }}" class="form-control" type="text" disabled name="fourth_balance20per" id="balamount520per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fourth_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fourth_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fourth_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 4thfloor20per" name="fourth_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="4thfloorchequetd20per" style="display:none;">
                                                                    <input value="{{ old('fourth_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="fourth_chequenumber20per" />
                                                                </td>
                                                                <td id="4thfloorcashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="4thfloornefttd20per" style="display:none;">
                                                                    <input value="{{ old('fourth_neftid20per') }}" type="text"autocomplete="off" placeholder="NEFT ID" class="form-control" name="fourth_neftid20per" />
                                                                </td>
                                                                <td id="4thfloorrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('fourth_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fourth_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    7.
                                                                </td>
                                                                <td>
                                                                    Completion of Fifth Floor 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth20per') }}" class="form-control" type="text" disabled name="fifth20per" id="menu_price620per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_received20per') }}" type="text" autocomplete="off" class="form-control" name="fifth_received20per" id="recamount620per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_balance20per') }}" class="form-control" type="text" disabled name="fifth_balance20per" id="balamount620per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('fifth_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="fifth_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="fifth_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control 5thfloor20per" name="fifth_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="5thfloorchequetd20per" style="display:none;">
                                                                    <input value="{{ old('fifth_chequenumber20per') }}" type="text" autocomplete="off" placeholder="Cheque No" class="form-control" name="fifth_chequenumber20per" />
                                                                </td>
                                                                <td id="5thfloorcashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="5thfloornefttd20per" style="display:none;">
                                                                    <input value="{{ old('fifth_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="fifth_neftid20per" />
                                                                </td>
                                                                <td id="5thfloorrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('fifth_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="fifth_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%">
                                                                    8.
                                                                </td>
                                                                <td>
                                                                    Handovering 5%
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover20per') }}" class="form-control" type="text" disabled name="handover20per" id="menu_price720per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_received20per') }}" type="text" autocomplete="off" class="form-control" name="handover_received20per" id="recamount720per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_balance20per') }}" class="form-control" type="text" disabled name="handover_balance20per" id="balamount720per" />
                                                                </td>
                                                                <td>
                                                                    <input value="{{ old('handover_paymentdate20per') }}" type="text" autocomplete="off" class="form-control datepicker" name="handover_paymentdate20per" />
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="handover_transactiontype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Ownfund">OwnFund</option>
                                                                        <option value="Bank">Bank</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control handover20per" name="handover_paymenttype20per">
                                                                        <option value=''>--Select--</option>
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="NEFT">NEFT</option>
                                                                        <option value="RTGS">RTGS</option>
                                                                    </select>
                                                                </td>
                                                                <td id="handoverchequetd20per" style="display:none;">
                                                                    <input value="{{ old('handover_chequenumber20per') }}" autocomplete="off" type="text" placeholder="Cheque No" class="form-control" name="handover_chequenumber20per" />
                                                                </td>
                                                                <td id="handovercashtd20per">
                                                                    <input value="" disabled type="text" class="form-control" name="" />
                                                                </td>
                                                                <td id="handovernefttd20per" style="display:none;">
                                                                    <input value="{{ old('handover_neftid20per') }}" type="text" autocomplete="off" placeholder="NEFT ID" class="form-control" name="handover_neftid20per" />
                                                                </td>
                                                                <td id="handoverrtgstd20per" style="display:none;">
                                                                    <input value="{{ old('handover_rtgsid20per') }}" type="text" autocomplete="off" placeholder="RTGS No" class="form-control" name="handover_rtgsid20per" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End :: 20 Percentage payment type Details -->

                                <div class="form-group text-right">
                                    <button type="submit" name="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                        Submit
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Subheader -->


<script>

     jQuery(document).ready(function() {
        jQuery('.transaction').change(function() {
            if (jQuery(this).val() === "Ownfund") {            
                jQuery('#banktype').hide();
                jQuery('#loan').hide();
                jQuery('#bankname').hide();
            } else if (jQuery(this).val() === "Bank") {          
                jQuery('#banktype').show(); 
                jQuery('#loan').show();           
            } else {           
                jQuery('#banktype').hide(); 
                jQuery('#loan').hide();    
                jQuery('#bankname').hide();      
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.banks').change(function() {
            if (jQuery(this).val() === "OTHERS") {            
                jQuery('#bankname').show();
            } else if (jQuery(this).val() === "SBI") {          
                jQuery('#bankname').hide();            
            } else if (jQuery(this).val() === "HDFC") {          
                jQuery('#bankname').hide();            
            } else if (jQuery(this).val() === "IOB") {          
                jQuery('#bankname').hide();            
            } else if (jQuery(this).val() === "LIC") {          
                jQuery('#bankname').hide();            
            } else if (jQuery(this).val() === "CANARA") {          
                jQuery('#bankname').hide();            
            } else {           
                jQuery('#bankname').hide();           
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.payment').change(function() {
            if (jQuery(this).val() === "10") {
                jQuery('#payment1').show();
                jQuery('#payment2').hide();
                jQuery('#payment3').hide();

            } else if (jQuery(this).val() === "15") {
                jQuery('#payment1').hide();
                jQuery('#payment2').show();
                jQuery('#payment3').hide();
            } else if (jQuery(this).val() === "20") {
                jQuery('#payment1').hide();
                jQuery('#payment2').hide();
                jQuery('#payment3').show();
            } else {
                jQuery('#payment1').hide();
                jQuery('#payment2').hide();
                jQuery('#payment3').hide();
            }
        });
    });
    
    jQuery(document).ready(function() {
        jQuery('.onbook').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#onchequetd').show();
                jQuery('#onnefttd').hide();
                jQuery('#onrtgstd').hide();
                jQuery('#oncashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#onchequetd').hide();
                jQuery('#onnefttd').show();
                jQuery('#oncashtd').hide();
                jQuery('#onrtgstd').hide();
            }  else if (jQuery(this).val() === "RTGS") {
                jQuery('#onchequetd').hide();
                jQuery('#onnefttd').hide();
                jQuery('#oncashtd').hide();
                jQuery('#onrtgstd').show();
            } else {
                jQuery('#onchequetd').hide();
                jQuery('#onnefttd').hide();
                jQuery('#oncashtd').show();
                jQuery('#onrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.agreements').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#agreementschequetd').show();
                jQuery('#agreementsnefttd').hide();
                jQuery('#agreementsrtgstd').hide();
                jQuery('#agreementscashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#agreementschequetd').hide();
                jQuery('#agreementsnefttd').show();
                jQuery('#agreementscashtd').hide();
                jQuery('#agreementsrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#agreementschequetd').hide();
                jQuery('#agreementsnefttd').hide();
                jQuery('#agreementscashtd').hide();
                jQuery('#agreementsrtgstd').show();
            } else {
                jQuery('#agreementschequetd').hide();
                jQuery('#agreementsnefttd').hide();
                jQuery('#agreementscashtd').show();
                jQuery('#agreementsrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.1stfloor').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#1stfloorchequetd').show();
                jQuery('#1stfloornefttd').hide();
                jQuery('#1stfloorrtgstd').hide();
                jQuery('#1stfloorcashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#1stfloorchequetd').hide();
                jQuery('#1stfloornefttd').show();
                jQuery('#1stfloorcashtd').hide();
                jQuery('#1stfloorrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#1stfloorchequetd').hide();
                jQuery('#1stfloornefttd').hide();
                jQuery('#1stfloorcashtd').hide();
                jQuery('#1stfloorrtgstd').show();
            } else {
                jQuery('#1stfloorchequetd').hide();
                jQuery('#1stfloornefttd').hide();
                jQuery('#1stfloorcashtd').show();
                jQuery('#1stfloorrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.2ndfloor').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#2ndfloorchequetd').show();
                jQuery('#2ndfloornefttd').hide();
                jQuery('#2ndfloorrtgstd').hide();
                jQuery('#2ndfloorcashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#2ndfloorchequetd').hide();
                jQuery('#2ndfloornefttd').show();
                jQuery('#2ndfloorcashtd').hide();
                jQuery('#2ndfloorrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#2ndfloorchequetd').hide();
                jQuery('#2ndfloornefttd').hide();
                jQuery('#2ndfloorcashtd').hide();
                jQuery('#2ndfloorrtgstd').show();
            } else {
                jQuery('#2ndfloorchequetd').hide();
                jQuery('#2ndfloornefttd').hide();
                jQuery('#2ndfloorcashtd').show();
                jQuery('#2ndfloorrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.3rdfloor').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#3rdfloorchequetd').show();
                jQuery('#3rdfloornefttd').hide();
                jQuery('#3rdfloorrtgstd').hide();
                jQuery('#3rdfloorcashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#3rdfloorchequetd').hide();
                jQuery('#3rdfloornefttd').show();
                jQuery('#3rdfloorcashtd').hide();
                jQuery('#3rdfloorrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#3rdfloorchequetd').hide();
                jQuery('#3rdfloornefttd').hide();
                jQuery('#3rdfloorcashtd').hide();
                jQuery('#3rdfloorrtgstd').show();
            } else {
                jQuery('#3rdfloorchequetd').hide();
                jQuery('#3rdfloornefttd').hide();
                jQuery('#3rdfloorcashtd').show();
                jQuery('#3rdfloorrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.4thfloor').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#4thfloorchequetd').show();
                jQuery('#4thfloornefttd').hide();
                jQuery('#4thfloorrtgstd').hide();
                jQuery('#4thfloorcashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#4thfloorchequetd').hide();
                jQuery('#4thfloornefttd').show();
                jQuery('#4thfloorcashtd').hide();
                jQuery('#4thfloorrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#4thfloorchequetd').hide();
                jQuery('#4thfloornefttd').hide();
                jQuery('#4thfloorcashtd').hide();
                jQuery('#4thfloorrtgstd').show();
            } else {
                jQuery('#4thfloorchequetd').hide();
                jQuery('#4thfloornefttd').hide();
                jQuery('#4thfloorcashtd').show();
                jQuery('#4thfloorrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.5thfloor').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#5thfloorchequetd').show();
                jQuery('#5thfloornefttd').hide();
                jQuery('#5thfloorrtgstd').hide();
                jQuery('#5thfloorcashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#5thfloorchequetd').hide();
                jQuery('#5thfloornefttd').show();
                jQuery('#5thfloorcashtd').hide();
                jQuery('#5thfloorrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#5thfloorchequetd').hide();
                jQuery('#5thfloornefttd').hide();
                jQuery('#5thfloorcashtd').hide();
                jQuery('#5thfloorrtgstd').show();
            } else {
                jQuery('#5thfloorchequetd').hide();
                jQuery('#5thfloornefttd').hide();
                jQuery('#5thfloorcashtd').show();
                jQuery('#5thfloorrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.handover').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#handoverchequetd').show();
                jQuery('#handovernefttd').hide();
                jQuery('#handoverrtgstd').hide();
                jQuery('#handovercashtd').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#handoverchequetd').hide();
                jQuery('#handovernefttd').show();
                jQuery('#handovercashtd').hide();
                jQuery('#handoverrtgstd').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#handoverchequetd').hide();
                jQuery('#handovernefttd').hide();
                jQuery('#handovercashtd').hide();
                jQuery('#handoverrtgstd').show();
            } else {
                jQuery('#handoverchequetd').hide();
                jQuery('#handovernefttd').hide();
                jQuery('#handovercashtd').show();
                jQuery('#handoverrtgstd').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.onbook15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#onchequetd15per').show();
                jQuery('#onnefttd15per').hide();
                jQuery('#onrtgstd15per').hide();
                jQuery('#oncashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#onchequetd15per').hide();
                jQuery('#onnefttd15per').show();
                jQuery('#oncashtd15per').hide();
                jQuery('#onrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#onchequetd15per').hide();
                jQuery('#onnefttd15per').hide();
                jQuery('#oncashtd15per').hide();
                jQuery('#onrtgstd15per').show();
            } else {
                jQuery('#onchequetd15per').hide();
                jQuery('#onnefttd15per').hide();
                jQuery('#oncashtd15per').show();
                jQuery('#onrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.agreements15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#agreementschequetd15per').show();
                jQuery('#agreementsnefttd15per').hide();
                jQuery('#agreementsrtgstd15per').hide();
                jQuery('#agreementscashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#agreementschequetd15per').hide();
                jQuery('#agreementsnefttd15per').show();
                jQuery('#agreementscashtd15per').hide();
                jQuery('#agreementsrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#agreementschequetd15per').hide();
                jQuery('#agreementsnefttd15per').hide();
                jQuery('#agreementscashtd15per').hide();
                jQuery('#agreementsrtgstd15per').show();
            } else {
                jQuery('#agreementschequetd15per').hide();
                jQuery('#agreementsnefttd15per').hide();
                jQuery('#agreementscashtd15per').show();
                jQuery('#agreementsrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.1stfloor15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#1stfloorchequetd15per').show();
                jQuery('#1stfloornefttd15per').hide();
                jQuery('#1stfloorrtgstd15per').hide();
                jQuery('#1stfloorcashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#1stfloorchequetd15per').hide();
                jQuery('#1stfloornefttd15per').show();
                jQuery('#1stfloorcashtd15per').hide();
                jQuery('#1stfloorrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#1stfloorchequetd15per').hide();
                jQuery('#1stfloornefttd15per').hide();
                jQuery('#1stfloorcashtd15per').hide();
                jQuery('#1stfloorrtgstd15per').show();
            } else {
                jQuery('#1stfloorchequetd15per').hide();
                jQuery('#1stfloornefttd15per').hide();
                jQuery('#1stfloorcashtd15per').show();
                jQuery('#1stfloorrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.2ndfloor15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#2ndfloorchequetd15per').show();
                jQuery('#2ndfloornefttd15per').hide();
                jQuery('#2ndfloorrtgstd15per').hide();
                jQuery('#2ndfloorcashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#2ndfloorchequetd15per').hide();
                jQuery('#2ndfloornefttd15per').show();
                jQuery('#2ndfloorcashtd15per').hide();
                jQuery('#2ndfloorrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#2ndfloorchequetd15per').hide();
                jQuery('#2ndfloornefttd15per').hide();
                jQuery('#2ndfloorcashtd15per').hide();
                jQuery('#2ndfloorrtgstd15per').show();
            } else {
                jQuery('#2ndfloorchequetd15per').hide();
                jQuery('#2ndfloornefttd15per').hide();
                jQuery('#2ndfloorcashtd15per').show();
                jQuery('#2ndfloorrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.3rdfloor15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#3rdfloorchequetd15per').show();
                jQuery('#3rdfloornefttd15per').hide();
                jQuery('#3rdfloorrtgstd15per').hide();
                jQuery('#3rdfloorcashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#3rdfloorchequetd15per').hide();
                jQuery('#3rdfloornefttd15per').show();
                jQuery('#3rdfloorcashtd15per').hide();
                jQuery('#3rdfloorrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#3rdfloorchequetd15per').hide();
                jQuery('#3rdfloornefttd15per').hide();
                jQuery('#3rdfloorcashtd15per').hide();
                jQuery('#3rdfloorrtgstd15per').show();
            } else {
                jQuery('#3rdfloorchequetd15per').hide();
                jQuery('#3rdfloornefttd15per').hide();
                jQuery('#3rdfloorcashtd15per').show();
                jQuery('#3rdfloorrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.4thfloor15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#4thfloorchequetd15per').show();
                jQuery('#4thfloornefttd15per').hide();
                jQuery('#4thfloorrtgstd15per').hide();
                jQuery('#4thfloorcashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#4thfloorchequetd15per').hide();
                jQuery('#4thfloornefttd15per').show();
                jQuery('#4thfloorcashtd15per').hide();
                jQuery('#4thfloorrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#4thfloorchequetd15per').hide();
                jQuery('#4thfloornefttd15per').hide();
                jQuery('#4thfloorcashtd15per').hide();
                jQuery('#4thfloorrtgstd15per').show();
            } else {
                jQuery('#4thfloorchequetd15per').hide();
                jQuery('#4thfloornefttd15per').hide();
                jQuery('#4thfloorcashtd15per').show();
                jQuery('#4thfloorrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.5thfloor15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#5thfloorchequetd15per').show();
                jQuery('#5thfloornefttd15per').hide();
                jQuery('#5thfloorrtgstd15per').hide();
                jQuery('#5thfloorcashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#5thfloorchequetd15per').hide();
                jQuery('#5thfloornefttd15per').show();
                jQuery('#5thfloorcashtd15per').hide();
                jQuery('#5thfloorrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#5thfloorchequetd15per').hide();
                jQuery('#5thfloornefttd15per').hide();
                jQuery('#5thfloorcashtd15per').hide();
                jQuery('#5thfloorrtgstd15per').show();
            } else {
                jQuery('#5thfloorchequetd15per').hide();
                jQuery('#5thfloornefttd15per').hide();
                jQuery('#5thfloorcashtd15per').show();
                jQuery('#5thfloorrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.handover15per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#handoverchequetd15per').show();
                jQuery('#handovernefttd15per').hide();
                jQuery('#handoverrtgstd15per').hide();
                jQuery('#handovercashtd15per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#handoverchequetd15per').hide();
                jQuery('#handovernefttd15per').show();
                jQuery('#handovercashtd15per').hide();
                jQuery('#handoverrtgstd15per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#handoverchequetd15per').hide();
                jQuery('#handovernefttd15per').hide();
                jQuery('#handovercashtd15per').hide();
                jQuery('#handoverrtgstd15per').show();
            } else {
                jQuery('#handoverchequetd15per').hide();
                jQuery('#handovernefttd15per').hide();
                jQuery('#handovercashtd15per').show();
                jQuery('#handoverrtgstd15per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.onbook20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#onchequetd20per').show();
                jQuery('#onnefttd20per').hide();
                jQuery('#onrtgstd20per').hide();
                jQuery('#oncashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#onchequetd20per').hide();
                jQuery('#onnefttd20per').show();
                jQuery('#oncashtd20per').hide();
                jQuery('#onrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#onchequetd20per').hide();
                jQuery('#onnefttd20per').hide();
                jQuery('#oncashtd20per').hide();
                jQuery('#onrtgstd20per').show();
            } else {
                jQuery('#onchequetd20per').hide();
                jQuery('#onnefttd20per').hide();
                jQuery('#oncashtd20per').show();
                jQuery('#onrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.agreements20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#agreementschequetd20per').show();
                jQuery('#agreementsnefttd20per').hide();
                jQuery('#agreementsrtgstd20per').hide();
                jQuery('#agreementscashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#agreementschequetd20per').hide();
                jQuery('#agreementsnefttd20per').show();
                jQuery('#agreementscashtd20per').hide();
                jQuery('#agreementsrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#agreementschequetd20per').hide();
                jQuery('#agreementsnefttd20per').hide();
                jQuery('#agreementscashtd20per').hide();
                jQuery('#agreementsrtgstd20per').show();
            } else {
                jQuery('#agreementschequetd20per').hide();
                jQuery('#agreementsnefttd20per').hide();
                jQuery('#agreementscashtd20per').show();
                jQuery('#agreementsrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.1stfloor20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#1stfloorchequetd20per').show();
                jQuery('#1stfloornefttd20per').hide();
                jQuery('#1stfloorrtgstd20per').hide();
                jQuery('#1stfloorcashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#1stfloorchequetd20per').hide();
                jQuery('#1stfloornefttd20per').show();
                jQuery('#1stfloorcashtd20per').hide();
                jQuery('#1stfloorrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#1stfloorchequetd20per').hide();
                jQuery('#1stfloornefttd20per').hide();
                jQuery('#1stfloorcashtd20per').hide();
                jQuery('#1stfloorrtgstd20per').show();
            } else {
                jQuery('#1stfloorchequetd20per').hide();
                jQuery('#1stfloornefttd20per').hide();
                jQuery('#1stfloorcashtd20per').show();
                jQuery('#1stfloorrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.2ndfloor20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#2ndfloorchequetd20per').show();
                jQuery('#2ndfloornefttd20per').hide();
                jQuery('#2ndfloorrtgstd20per').hide();
                jQuery('#2ndfloorcashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#2ndfloorchequetd20per').hide();
                jQuery('#2ndfloornefttd20per').show();
                jQuery('#2ndfloorcashtd20per').hide();
                jQuery('#2ndfloorrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#2ndfloorchequetd20per').hide();
                jQuery('#2ndfloornefttd20per').hide();
                jQuery('#2ndfloorcashtd20per').hide();
                jQuery('#2ndfloorrtgstd20per').show();
            } else {
                jQuery('#2ndfloorchequetd20per').hide();
                jQuery('#2ndfloornefttd20per').hide();
                jQuery('#2ndfloorcashtd20per').show();
                jQuery('#2ndfloorrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.3rdfloor20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#3rdfloorchequetd20per').show();
                jQuery('#3rdfloornefttd20per').hide();
                jQuery('#3rdfloorrtgstd20per').hide();
                jQuery('#3rdfloorcashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#3rdfloorchequetd20per').hide();
                jQuery('#3rdfloornefttd20per').show();
                jQuery('#3rdfloorcashtd20per').hide();
                jQuery('#3rdfloorrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#3rdfloorchequetd20per').hide();
                jQuery('#3rdfloornefttd20per').hide();
                jQuery('#3rdfloorcashtd20per').hide();
                jQuery('#3rdfloorrtgstd20per').show();
            } else {
                jQuery('#3rdfloorchequetd20per').hide();
                jQuery('#3rdfloornefttd20per').hide();
                jQuery('#3rdfloorcashtd20per').show();
                jQuery('#3rdfloorrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.4thfloor20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#4thfloorchequetd20per').show();
                jQuery('#4thfloornefttd20per').hide();
                jQuery('#4thfloorrtgstd20per').hide();
                jQuery('#4thfloorcashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#4thfloorchequetd20per').hide();
                jQuery('#4thfloornefttd20per').show();
                jQuery('#4thfloorcashtd20per').hide();
                jQuery('#4thfloorrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#4thfloorchequetd20per').hide();
                jQuery('#4thfloornefttd20per').hide();
                jQuery('#4thfloorcashtd20per').hide();
                jQuery('#4thfloorrtgstd20per').show();
            } else {
                jQuery('#4thfloorchequetd20per').hide();
                jQuery('#4thfloornefttd20per').hide();
                jQuery('#4thfloorcashtd20per').show();
                jQuery('#4thfloorrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.5thfloor20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#5thfloorchequetd20per').show();
                jQuery('#5thfloornefttd20per').hide();
                jQuery('#5thfloorrtgstd20per').hide();
                jQuery('#5thfloorcashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#5thfloorchequetd20per').hide();
                jQuery('#5thfloornefttd20per').show();
                jQuery('#5thfloorcashtd20per').hide();
                jQuery('#5thfloorrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#5thfloorchequetd20per').hide();
                jQuery('#5thfloornefttd20per').hide();
                jQuery('#5thfloorcashtd20per').hide();
                jQuery('#5thfloorrtgstd20per').show();
            } else {
                jQuery('#5thfloorchequetd20per').hide();
                jQuery('#5thfloornefttd20per').hide();
                jQuery('#5thfloorcashtd20per').show();
                jQuery('#5thfloorrtgstd20per').hide();
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('.handover20per').change(function() {
            if (jQuery(this).val() === "Cheque") {
                jQuery('#handoverchequetd20per').show();
                jQuery('#handovernefttd20per').hide();
                jQuery('#handoverrtgstd20per').hide();
                jQuery('#handovercashtd20per').hide();
            } else if (jQuery(this).val() === "NEFT") {
                jQuery('#handoverchequetd20per').hide();
                jQuery('#handovernefttd20per').show();
                jQuery('#handovercashtd20per').hide();
                jQuery('#handoverrtgstd20per').hide();
            } else if (jQuery(this).val() === "RTGS") {
                jQuery('#handoverchequetd20per').hide();
                jQuery('#handovernefttd20per').hide();
                jQuery('#handovercashtd20per').hide();
                jQuery('#handoverrtgstd20per').show();
            } else {
                jQuery('#handoverchequetd20per').hide();
                jQuery('#handovernefttd20per').hide();
                jQuery('#handovercashtd20per').show();
                jQuery('#handoverrtgstd20per').hide();
            }
        });
    });

    $("#percentage").change(function() {
        var perc = parseFloat($("#purchase_price").val());
        var percs = "";
        if (isNaN(perc)) {
            percs = " ";
        } else {
            $("#menu_price").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price1").val(((40 * perc) / 100).toFixed(2));
            $("#menu_price2").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price3").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price4").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price5").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price6").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price7").val(((5 * perc) / 100).toFixed(2));
        }
    });

    $("#percentage").change(function() {
        var perc = parseFloat($("#purchase_price").val());
        var percs = "";
        if (isNaN(perc)) {
            percs = " ";
        } else {
            $("#menu_price15per").val(((15 * perc) / 100).toFixed(2));
            $("#menu_price115per").val(((40 * perc) / 100).toFixed(2));
            $("#menu_price215per").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price315per").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price415per").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price515per").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price615per").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price715per").val(((5 * perc) / 100).toFixed(2));
        }
    });

    $("#percentage").change(function() {
        var perc = parseFloat($("#purchase_price").val());
        var percs = "";
        if (isNaN(perc)) {
            percs = " ";
        } else {
            $("#menu_price20per").val(((20 * perc) / 100).toFixed(2));
            $("#menu_price120per").val(((40 * perc) / 100).toFixed(2));
            $("#menu_price220per").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price320per").val(((10 * perc) / 100).toFixed(2));
            $("#menu_price420per").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price520per").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price620per").val(((5 * perc) / 100).toFixed(2));
            $("#menu_price720per").val(((5 * perc) / 100).toFixed(2));
        }
    });

    $('#recamount').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price").val()) - parseFloat($("#recamount").val());
            $("#balamount").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount1').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price1").val()) - parseFloat($("#recamount1").val());
            $("#balamount1").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount2').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price2").val()) - parseFloat($("#recamount2").val());
            $("#balamount2").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount3').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price3").val()) - parseFloat($("#recamount3").val());
            $("#balamount3").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount4').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price4").val()) - parseFloat($("#recamount4").val());
            $("#balamount4").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount5').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price5").val()) - parseFloat($("#recamount5").val());
            $("#balamount5").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount6').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price6").val()) - parseFloat($("#recamount6").val());
            $("#balamount6").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount7').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price7").val()) - parseFloat($("#recamount7").val());
            $("#balamount7").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount15per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price15per").val()) - parseFloat($("#recamount15per").val());
            $("#balamount15per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount115per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price115per").val()) - parseFloat($("#recamount115per").val());
            $("#balamount115per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount215per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price215per").val()) - parseFloat($("#recamount215per").val());
            $("#balamount215per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount315per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price315per").val()) - parseFloat($("#recamount315per").val());
            $("#balamount315per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount415per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price415per").val()) - parseFloat($("#recamount415per").val());
            $("#balamount415per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount515per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price515per").val()) - parseFloat($("#recamount515per").val());
            $("#balamount515per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount615per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price615per").val()) - parseFloat($("#recamount615per").val());
            $("#balamount615per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount715per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price715per").val()) - parseFloat($("#recamount715per").val());
            $("#balamount715per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount20per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price20per").val()) - parseFloat($("#recamount20per").val());
            $("#balamount20per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount120per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price120per").val()) - parseFloat($("#recamount120per").val());
            $("#balamount120per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount220per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price220per").val()) - parseFloat($("#recamount220per").val());
            $("#balamount220per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount320per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price320per").val()) - parseFloat($("#recamount320per").val());
            $("#balamount320per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount420per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price420per").val()) - parseFloat($("#recamount420per").val());
            $("#balamount420per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount520per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price520per").val()) - parseFloat($("#recamount520per").val());
            $("#balamount520per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount620per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price620per").val()) - parseFloat($("#recamount620per").val());
            $("#balamount620per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#recamount720per').on("paste keyup",
        function() {
            var result = parseFloat($("#menu_price720per").val()) - parseFloat($("#recamount720per").val());
            $("#balamount720per").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );

    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('payments.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "application_name": country
            },
            dataType: 'html',
            success: function(data) {
                $("#state1").html(data);
            }
        });
    });
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('payments.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "application_date": country
            },
            dataType: 'html',
            success: function(data) {
                $("#state2").html(data);
            }
        });
    });
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('payments.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "gross_amount": country
            },
            dataType: 'html',
            success: function(data) {
                $("#state3").html(data);
            }
        });
    });
</script>
<style>
    .m-table.m-table--head-bg-brand.pay thead th {
        background: #61317a;
    }

    .m-table.m-table--head-bg-brand.ment thead th {
        background: #329f5b;
    }
</style>
@endsection