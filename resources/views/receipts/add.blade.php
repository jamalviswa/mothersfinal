@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Payment Receipt
                </h3>
            </div>
            <div>
                <a href="{{route('receipts.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  
                         m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body ">
                        <!--begin::Section-->
                        <div class="m-section ">
                            <form method="post" action="{{ route('receipts.store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 ">
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
                                            <label class="col-md-1">
                                                No
                                            </label>
                                           
                                            <div class="col-md-2">
                                            <input value="{{old('receipt_no') }}" autocomplete="off" type="text" class="form-control" name="receipt_no" />
                                              
                                            </div>

                                            <label class="col-md-1 offset-md-6">
                                                Date
                                            </label>
                                            <div class="col-md-2">
                                                <input value="{{ old('receipt_date') }}" type="text" autocomplete="off" class="form-control datepicker" name="receipt_date" />
                                                @error('receipt_date')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">
                                                Application No
                                            </label>
                                            <div class="col-md-3">
                                                <select class="form-control m-select2" id="country" name="application_number">
                                                    <option value="">Select Application Number</option>
                                                    <?php
                                                    $phases = App\Customer::where('status', 'Active')->get();
                                                    foreach ($phases as $phase) {
                                                    ?>
                                                        <option value="<?php echo $phase->customer_id ?>"><?php echo $phase->application_number ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                @error('application_number')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <label class="col-md-3">
                                                Received with thanks from
                                            </label>
                                            <div class="col-md-4" id="state1">

                                                <input autocomplete="off" type="text" class="form-control " disabled />
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">
                                                a sum of Rupees
                                            </label>
                                            <div class="col-md-10">

                                                <input value="{{old('sum_rupees') }}" autocomplete="off" type="text" class="form-control" name="sum_rupees" />


                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">
                                                by Cheque/DD No
                                            </label>
                                            <div class="col-md-6">

                                                <input value="{{old('cheque_no') }}" autocomplete="off" type="text" class="form-control " name="cheque_no" />


                                            </div>

                                            <label class="col-md-1">
                                                Dated
                                            </label>
                                            <div class="col-md-3">

                                                <input value="{{old('dated') }}" autocomplete="off" type="text" class="form-control datepicker" name="dated" />


                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">
                                                drawn on
                                            </label>
                                            <div class="col-md-4">

                                                <input value="{{old('drawn_on') }}" autocomplete="off" type="text" class="form-control " name="drawn_on" />


                                            </div>

                                            <label class="col-md-2">
                                                Bank towards
                                            </label>
                                            <div class="col-md-4">

                                                <input value="{{old('bank_towards') }}" autocomplete="off" type="text" class="form-control " name="bank_towards" />


                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">
                                                Referred by
                                            </label>
                                            <div class="col-md-3">

                                                <input value="{{old('referred_by') }}" autocomplete="off" type="text" class="form-control " name="referred_by" />


                                            </div>
                                            <label class="col-md-4 offset-md-3">

                                                <h4 class="j-heads"><small style="font-weight: 600;">for</small> Mount Kailash Properties</h4>
                                            </label>

                                        </div>
                                        <div class="form-group row">

                                            <div class="col-md-3">
                                                <div class="input-group"> <span class="input-group-text">₹</span>
                                                    <input type="text" value="{{old('final_amount') }}" class="form-control" autocomplete="off" name="final_amount">

                                                    @error('final_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
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

                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" name="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('receipts.map')}}",
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
</script>
<style>
    .input-group-text {
        font-weight: 600 !important;
        border-radius: unset !important;
    }

    .j-heads {
        font-style: italic;
        font-family: 'Flaticon';
        padding-top: 15px;
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
</style>

@endsection