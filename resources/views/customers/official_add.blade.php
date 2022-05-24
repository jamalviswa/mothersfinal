@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Document Details
                </h3>
            </div>
            <div>
                <a href="{{route('customers.official_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  
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
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <form method="post" action="{{route('customers.official_store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Application Number<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control m-select2" id="country" name="application_number">
                                                    <option>Select Application Number</option>
                                                    <?php
                                                    $phases = App\Customer::where('status', 'Active')->get();
                                                    foreach ($phases as $phase) {
                                                       
                                                        $costs = App\Document::where('status','!=','Trash')->where('customer_id',$phase['customer_id'])->where('application_number',$phase['application_number'])->first();
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
                                                Name of the Applicant <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7"  id="state1" >
                                         
                                                <input type="text"  autocomplete="off" class="form-control"  />
                                              
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Date of Application <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7"  id="state2">
                                          
                                                <input type="text"  autocomplete="off" class="form-control"  />

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Mobile Number<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3"  id="state3">
                                                  
                                                        <input value="{{ old('phone_code') }}"  type="tel" autocomplete="off" class="form-control"  style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9"  id="state4">
                                                   
                                                        <input value="{{ old('phone') }}"  type="tel" autocomplete="off" class="form-control"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Aadhar Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('aadhar_number') }}" id="aadhar_number" type="text" autocomplete="off" placeholder="Enter Aadhar Number" class="form-control" name="aadhar_number" maxlength="14" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="aadhar" autocomplete="off" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Pan Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('pan_number') }}" type="text" autocomplete="off" placeholder="Enter PAN Number" class="form-control" name="pan_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="pan" autocomplete="off" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Passport Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('passport_number') }}" type="text" autocomplete="off" placeholder="Enter Passport Number" class="form-control" name="passport_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="passport" autocomplete="off" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Name of the co-applicant
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('co_applicant_name') }}" type="text" style="text-transform: capitalize;" autocomplete="off" class="form-control" name="co_applicant_name" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Mobile Number
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input value="{{ old('coapp_phone_code') }}" type="tel" autocomplete="off" class="form-control" name="coapp_phone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ old('coapp_phone') }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="coapp_phone" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Mail Id
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('coapp_email') }}" type="email" autocomplete="off" class="form-control" name="coapp_email" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Aadhar Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('coaadhar_number') }}" id="aadhar_number2" type="text" autocomplete="off" placeholder="Enter Aadhar Number" class="form-control" name="coaadhar_number" maxlength="14" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="coaadhar" autocomplete="off" />
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Pan Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('copan_number') }}" type="text" autocomplete="off" placeholder="Enter PAN Number" class="form-control" name="copan_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="copan" autocomplete="off" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Passport Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('copassport_number') }}" type="text" autocomplete="off" placeholder="Enter Passport Number" class="form-control" name="copassport_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="copassport" autocomplete="off" />
                                              
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-applicant Address
                                            </label>
                                            <div class="col-md-7">
                                                <textarea rows="4" class="form-control" name="coapp_address"> {{ old('coapp_address')}}</textarea>

                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Customer Type<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control customertype" name="customer_type">
                                                <option value="">Select Customer Type</option>
                                                    <option {{ old('customer_type')=="Direct"?"selected":"" }} value="Direct">Direct</option>
                                                    <option {{ old('customer_type')=="Referedby"?"selected":"" }} value="Referedby">Refered By</option>
                                                </select>
                                                @error('customer_type')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row" id="refered" style="display:none;">
                                            <label class="col-md-5">
                                                Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('refered_name') }}" type="text" autocomplete="off" class="form-control" name="refered_name" />
                                                @error('refered_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row" id="refered1" style="display:none;">
                                            <label class="col-md-5">
                                             Mobile Number <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input value="{{ old('refered_phone_code') }}" type="tel" autocomplete="off" class="form-control" name="refered_phone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ old('refered_phone') }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="refered_phone" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Phase<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="phase" name="phase">
                                                    <option>Select Phase</option>
                                                    <?php
                                                    $phases = App\Phase::where('status', 'Active')->get();
                                                    foreach ($phases as $phase) {
                                                    ?>
                                                        <option value="<?php echo $phase->phase_id ?>"><?php echo $phase->phase_name ?></option>

                                                    <?php }
                                                    ?>
                                                </select>
                                                @error('phase')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row block hide">
                                            <label class="col-md-5">
                                                Block <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="block" name="block">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row floor hide">
                                            <label class="col-md-5">
                                                Floor <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="floor" name="floor">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row flattype hide">
                                            <label class="col-md-5">
                                                Flat Type <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="flattype" name="flattype">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row flatnumber hide">
                                            <label class="col-md-5">
                                                Flat Number <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="flatnumber" name="flatnumber">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Facing <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" name="facing">
                                                    <option value="">---Select---</option>
                                                    <option {{ old('facing')=="North"?"selected":"" }} value="North">North</option>
                                                    <option {{ old('facing')=="East"?"selected":"" }} value="East">East</option>
                                                    <option {{ old('facing')=="West"?"selected":"" }} value="West">West</option>
                                                    <option {{ old('facing')=="South"?"selected":"" }} value="South">South</option>
                                                </select>
                                                @error('facing')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Saleable Area <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('salable_area') }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="salable_area" />
                                                @error('salable_area')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Plinth Area <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('plinth_area') }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="plinth_area" />
                                                @error('plinth_area')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                UDS Area <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('uds_area') }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="uds_area" />
                                                @error('uds_area')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Comn Area <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('comn_area') }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="comn_area" />
                                                @error('comn_area')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" name="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                Submit
                                            </button>
                                        </div>
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
      jQuery(document).ready(function() {
        jQuery('.customertype').change(function() {
            if (jQuery(this).val() === "Direct") {  
                jQuery('#refered').hide();
                jQuery('#refered1').hide();
            } else if (jQuery(this).val() === "Referedby") {     
                jQuery('#refered').show();
                jQuery('#refered1').show();       
            } else {       
                jQuery('#refered').hide();
                jQuery('#refered1').hide();      
            }
        });
    });

    $(".m-select2").select2();

    $('#phase').change(function() {
        var phase = $(this).val();
        $.ajax({
            url: "{{route('customers.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "phase": phase
            },
            dataType: 'html',
            success: function(data) {
                $('.block').removeClass('hide');
                $("#block").html(data);
            }
        });
    });
    $('#block').change(function() {
        var block = $(this).val();
        $.ajax({
            url: "{{route('customers.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "block": block
            },
            dataType: 'html',
            success: function(data) {
                $('.floor').removeClass('hide');
                $("#floor").html(data);
            }
        });
    });
    $('#floor').change(function() {
        var floor = $(this).val();
        $.ajax({
            url: "{{route('customers.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "floor": floor
            },
            dataType: 'html',
            success: function(data) {
                $('.flattype').removeClass('hide');
                $("#flattype").html(data);
            }
        });
    });
    $('#flattype').change(function() {
        var flattype = $(this).val();
        $.ajax({
            url: "{{route('customers.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "flattype": flattype
            },
            dataType: 'html',
            success: function(data) {
                $('.flatnumber').removeClass('hide');
                $("#flatnumber").html(data);
            }
        });
    });

    $('#country').change(function() {
        var country = $(this).val();
        
        $.ajax({
            url: "{{route('customers.maps')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "application_name": country
            },
            dataType: 'html',
            success: function(data) {

                $("#state1").html(data);
               
                //$('.state').removeClass('hide');
            }
        });
    });
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('customers.maps')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "application_date": country
            },
            dataType: 'html',
            success: function(data) {

                $("#state2").html(data);
               
                $('.states').removeClass('hide');
            }
        });
    });
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('customers.maps')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "phone_code": country
            },
            dataType: 'html',
            success: function(data) {

                $("#state3").html(data);
                // $('#state1').append(data);
                $('.statess').removeClass('hide');
            }
        });
    });
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('customers.maps')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "phone": country
            },
            dataType: 'html',
            success: function(data) {

                $("#state4").html(data);
                // $('#state1').append(data);
                $('.statesss').removeClass('hide');
            }
        });
    });

    $('#aadhar_number').on('keypress change blur', function() {
        $(this).val(function(index, value) {
            return value.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
        });
    });

    $('#aadhar_number').on('copy cut paste', function() {
        setTimeout(function() {
            $('#aadhar_number').trigger("change");
        });
    });

    $('#aadhar_number2').on('keypress change blur', function() {
        $(this).val(function(index, value) {
            return value.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
        });
    });

    $('#aadhar_number2').on('copy cut paste', function() {
        setTimeout(function() {
            $('#aadhar_number2').trigger("change");
        });
    });
</script>
@endsection