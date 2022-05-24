@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Receipt
                </h3>
            </div>
            <div>
                <a href="{{route('deletes.receipt_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-section__content borderr">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <img width="100" height="100" src="<?php echo  asset('files/mlogo.png') ?>" alt="logo">
                                                <h2 class="j_title">
                                                    Mount Kailash Properties
                                                </h2>
                                            </div>
                                            <div class="col-md-3 offset-md-3">
                                                <p class="j_para">
                                                    Mother's Village <br>
                                                    Nesavalar Colony Road,<br>
                                                    (Before Ondipudur flyover)<br>
                                                    Singanallur,<br> Coimbatore - 641 005<br>
                                                    Ph: 0422-4599328
                                                </p>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="form-group row">
                                            <label class="col-md-2 offset-md-5 j_receipt">
                                                RECEIPT
                                            </label>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-1 j-label">
                                                No
                                            </label>
                                            <div class="col-md-2 j-untext">
                                                {{ $detail->receipt_no }}
                                            </div>
                                            <label class="col-md-1 offset-md-6 j-label">
                                                Date
                                            </label>
                                            <div class="col-md-2 j-untext">
                                                {{ $detail->receipt_date }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 j-label">
                                                Application No
                                            </label>
                                            <div class="col-md-3 j-text">
                                                {{ $detail->application_number }}
                                            </div>
                                            <label class="col-md-3 j-label">
                                                Received with thanks from
                                            </label>
                                            <div class="col-md-4 j-text">
                                                {{ $detail->received }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 j-label">
                                                a sum of Rupees
                                            </label>
                                            <div class="col-md-10 j-text">
                                                {{ $detail->sum_rupees }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 j-label">
                                                by Cheque/DD No
                                            </label>
                                            <div class="col-md-6 j-text">
                                                {{ $detail->cheque_no }}
                                            </div>
                                            <label class="col-md-1 j-label">
                                                Dated
                                            </label>
                                            <div class="col-md-3 j-text">
                                                {{ $detail->dated }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 j-label">
                                                drawn on
                                            </label>
                                            <div class="col-md-4 j-text">
                                                {{ $detail->drawn_on }}
                                            </div>
                                            <label class="col-md-2 j-label">
                                                Bank towards
                                            </label>
                                            <div class="col-md-4 j-text">
                                                {{ $detail->bank_towards }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 j-label">
                                                Referred by
                                            </label>
                                            <div class="col-md-3 j-text">
                                                {{ $detail->referred_by }}
                                            </div>
                                            <label class="col-md-4 offset-md-3">
                                                <h4 class="j-heads"><small style="font-weight: 600;">for</small> Mount Kailash Properties</h4>
                                            </label>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3 j-untext">
                                                <div class="input-group" style="border: 2px solid grey;"> <span class="input-group-text">₹</span>
                                                    <div class="j_amount">
                                                        {{ $detail->final_amount }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">
                                                <span class="red">* </span>Cheque subject to realisation.
                                            </label>
                                            <label class="col-md-2 offset-md-7">
                                                Authorised Signatory
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5 offset-md-3">
                                                <span class="red">* </span>This is computer generated receipt no signature required
                                            </label>
                                            
                                        </div>

                                    </div>
                                    <!-- <div class="download_pdf">
                                        <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Download Invoice" href="{{ route('receipts.invoicepdf',$detail['customer_id']) }}" target="_blank" download>
                                            Download PDF<i style="color: white;font-size: 18px !important;" class="fa fa-download"></i>
                                        </a>
                                    </div> -->
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
    .btn.btn-secondary.m-btn.m-btn--air.m-btn--custom {
    padding: 17px;
    background: #0054ac;
    color:white;
    border-radius: 0px;
}
    .input-group-text {
        font-weight: 600 !important;
        border-radius: unset !important;
    }

    .j-heads {
        font-style: italic;
        font-family: 'Flaticon';
        text-align: right;
        font-weight: 600;
    }

    .j_receipt {
        border: 2px solid #000;
        border-radius: 40px;
        max-width: 84px;
        font-weight: 800;
    }

    .j_title {
        font-style: italic;
        font-family: 'Flaticon';
        font-size: 41px;
    }

    .j_para {
        margin-bottom: 0px !important;
        margin-top: 14px;
        font-size: 15px;
        font-weight: 600;
    }

    .borderr {
        border: 2px solid grey;
        border-radius: 40px;
        padding: 0px 15px 0px 15px;
    }

    hr {
        border-top: 2px solid #8c8b8b;
    }

    .j-label {
        font-weight: 700;
        font-size: 17px;
    }

    .j-text {
        font-size: 17px;
        font-weight: 500;
        border-bottom: 2px dotted;
    }

    .j-untext {
        font-size: 17px;
        font-weight: 500;
    }

    .j_amount {
        padding-top: 7px;
        padding-left: 7px;
    }

    .download_pdf {
        margin-top: 24px;
        text-align: right;
    }
</style>
@endsection