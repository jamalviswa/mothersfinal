@extends('layouts.admin')
@section('content')
<?php
$requestdatas = (!empty(old())) ? old() : $detail;
// dd(old());
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Edit Document Details

                </h3>
            </div>
            <div>
                <a href="{{route('customers.official_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                            <form method="post" action="{{ route('customers.official_update',$detail['document_id']) }}" class="validation_form" id="upload" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">
                                        <div id="err"></div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Application Number<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['application_number'] }}" type="text" autocomplete="off" class="form-control" name="application_number" />
                                                @error('application_number')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Name of the Applicant<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['applicant_name'] }}" type="text" autocomplete="off" class="form-control" name="applicant_name" />
                                                @error('applicant_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Date of Application<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['date_of_application'] }}" type="text" autocomplete="off" class="form-control datepicker" name="date_of_application" />
                                                @error('date_of_application')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Mobile Number<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input value="{{ $requestdatas['phone_code'] }}" type="tel" autocomplete="off" class="form-control" name="phone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ $requestdatas['phone'] }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="phone" />
                                                    </div>
                                                </div>
                                                @error('phone_code')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Aadhar Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['aadhar_number'] }}" id="aadhar_number" type="text" autocomplete="off" placeholder="Enter Aadhar Number" class="form-control" name="aadhar_number" maxlength="14" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="aadhar" autocomplete="off" />
                                                @if(!empty($detail['aadhar']))
                                                <a href="{{URL::to('files/forms/'.$detail['aadhar'].'')}}" download target="_blank">{{ $detail['aadhar'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Pan Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['pan_number'] }}" type="text" autocomplete="off" placeholder="Enter PAN Number" class="form-control" name="pan_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="pan" autocomplete="off" />
                                                @if(!empty($detail['pan']))
                                                <a href="{{URL::to('files/forms/'.$detail['pan'].'')}}" download target="_blank">{{ $detail['pan'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Applicant Passport Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['passport_number'] }}" type="text" autocomplete="off" placeholder="Enter Passport Number" class="form-control" name="passport_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="passport" autocomplete="off" />
                                                @if(!empty($detail['passport']))
                                                <a href="{{URL::to('files/forms/'.$detail['passport'].'')}}" download target="_blank">{{ $detail['passport'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Name of the co-applicant
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['co_applicant_name'] }}" type="text" autocomplete="off" class="form-control" name="co_applicant_name" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Mobile Number
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input value="{{ $requestdatas['coapp_phone_code'] }}" type="tel" autocomplete="off" class="form-control" name="coapp_phone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ $requestdatas['coapp_phone'] }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="coapp_phone" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Mail Id
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['coapp_email'] }}" type="email" autocomplete="off" class="form-control" name="coapp_email" />

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Aadhar Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['coaadhar_number'] }}" id="aadhar_number" type="text" autocomplete="off" placeholder="Enter Aadhar Number" class="form-control" name="coaadhar_number" maxlength="14" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="coaadhar" autocomplete="off" />
                                                @if(!empty($detail['coaadhar']))
                                                <a href="{{URL::to('files/forms/'.$detail['coaadhar'].'')}}" download target="_blank">{{ $detail['coaadhar'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Pan Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['copan_number'] }}" type="text" autocomplete="off" placeholder="Enter PAN Number" class="form-control" name="copan_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="pan" autocomplete="off" />
                                                @if(!empty($detail['copan']))
                                                <a href="{{URL::to('files/forms/'.$detail['copan'].'')}}" download target="_blank">{{ $detail['copan'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-Applicant Passport Details
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['copassport_number'] }}" type="text" autocomplete="off" placeholder="Enter Passport Number" class="form-control" name="copassport_number" maxlength="10" style="margin-bottom: 8px;" />
                                                <input type="file" accept="application/pdf,image/jpeg" class="form-control" name="copassport" autocomplete="off" />
                                                @if(!empty($detail['copassport']))
                                                <a href="{{URL::to('files/forms/'.$detail['copassport'].'')}}" download target="_blank">{{ $detail['copassport'] }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Co-applicant Address
                                            </label>
                                            <div class="col-md-7">
                                                <textarea rows="4" class="form-control" name="coapp_address"> {{ $requestdatas['coapp_address']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Customer Type<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control customertype" name="customer_type">
                                                    <option value="">Select Customer Type</option>
                                                    <option {{ $requestdatas['customer_type']=="Direct"?"selected":"" }} value="Direct">Direct</option>
                                                    <option {{ $requestdatas['customer_type']=="Referedby"?"selected":"" }} value="Referedby">Refered By</option>
                                                </select>
                                                @error('customer_type')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <?php
                                        if ($requestdatas['customer_type'] == "Referedby") {
                                        ?>
                                            <div class="form-group row" id="refered">
                                                <label class="col-md-5">
                                                    Name <span class="red">*</span>
                                                </label>
                                                <div class="col-md-7">
                                                    <input value="{{ $requestdatas['refered_name'] }}" type="text" autocomplete="off" class="form-control" name="refered_name" />
                                                    @error('refered_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row" id="refered1">
                                                <label class="col-md-5">
                                                    Mobile Number <span class="red">*</span>
                                                </label>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input value="{{ $requestdatas['refered_phone_code'] }}" type="tel" autocomplete="off" class="form-control" name="refered_phone_code" style="width:72%" maxlength="4" />
                                                        </div>
                                                        <div class="col-9">
                                                            <input value="{{ $requestdatas['refered_phone'] }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="refered_phone" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Phase<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" name="phase" id="phase">
                                                    @php
                                                    $countries = App\Phase::where('status','Active')->get();
                                                    @endphp
                                                    <option value="">---Select Phase---</option>
                                                    @foreach($countries as $cate)
                                                    <option {!!($cate['phase_id']==$requestdatas['phase'])? "selected" :""; !!} value="{{ $cate['phase_id'] }}">{{ $cate['phase_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('phase')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row block">
                                            <label class="col-md-5">
                                                Block <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="block" name="block">
                                                    @php
                                                    $states = App\Block::where('phase_id',$requestdatas['phase'])->get();
                                                    @endphp
                                                    <option value="">---Select Block---</option>
                                                    @foreach($states as $cate)
                                                    <option {!!($cate['block_id']==$requestdatas['block'])? "selected" :""; !!} value="{{ $cate['block_id'] }}">{{ $cate['block_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row floor">
                                            <label class="col-md-5">
                                                Floor <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="floor" name="floor">
                                                    @php
                                                    $states = App\Floor::where('block',$requestdatas['block'])->get();
                                                    @endphp
                                                    <option value="">---Select Floor---</option>
                                                    @foreach($states as $cate)
                                                    <option {!!($cate['floor_id']==$requestdatas['floor'])? "selected" :""; !!} value="{{ $cate['floor_id'] }}">{{ $cate['floor_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row flattype">
                                            <label class="col-md-5">
                                                Flat Type <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="flattype" name="flattype">
                                                    @php
                                                    $states = App\Flattype::where('floor',$requestdatas['floor'])->get();
                                                    @endphp
                                                    <option value="">---Select Flat Type---</option>
                                                    @foreach($states as $cate)
                                                    <option {!!($cate['flattype_id']==$requestdatas['flattype'])? "selected" :""; !!} value="{{ $cate['flattype_id'] }}">{{ $cate['flattype'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row flatnumber">
                                            <label class="col-md-5">
                                                Flat Number <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="flatnumber" name="flatnumber">
                                                    @php
                                                    $states = App\Flatnumber::where('flattype',$requestdatas['flattype'])->get();
                                                    @endphp
                                                    <option value="">---Select Flat Number---</option>
                                                    @foreach($states as $cate)
                                                    <option {!!($cate['flatnumber_id']==$requestdatas['flatnumber'])? "selected" :""; !!} value="{{ $cate['flatnumber_id'] }}">{{ $cate['flatnumber'] }}</option>
                                                    @endforeach
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
                                                    <option {{ $requestdatas['facing']=="North"?"selected":"" }} value="North">North</option>
                                                    <option {{ $requestdatas['facing']=="East"?"selected":"" }} value="East">East</option>
                                                    <option {{ $requestdatas['facing']=="West"?"selected":"" }} value="West">West</option>
                                                    <option {{ $requestdatas['facing']=="South"?"selected":"" }} value="South">South</option>
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
                                                <input value="{{ $requestdatas['salable_area'] }}" readonly type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="salable_area" />
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
                                                <input value="{{ $requestdatas['plinth_area'] }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="plinth_area" />
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
                                                <input value="{{ $requestdatas['uds_area'] }}" type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="uds_area" />
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
                                                <input value="{{ $requestdatas['comn_area'] }}" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="comn_area" />
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
<style>
    .radio-sec input {
        position: relative;
        top: 0px;
        margin-right: 5px;
        margin-left: 0px;
    }
</style>
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: "today"
    });
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
</script>
@endsection