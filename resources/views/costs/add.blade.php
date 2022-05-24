@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Cost Details
                </h3>
            </div>
            <div>
                <a href="{{route('costs.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to  List">
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
                            <form method="post" action="{{ route('costs.store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="m-section__content">
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Application Number<span class="red">*</span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control m-select2" id="country" name="application_number">
                                                        <option>Select Application Number</option>
                                                        <?php
                                                        //$phases = App\Customer::where('status', 'Active')->get();
                                                        $phases = App\Document::where('status', 'Active')->get();
                                                        
                                                        foreach ($phases as $phase) {
                                                            $costs = App\Cost::where('status','!=','Trash')->where('customer_id',$phase['customer_id'])->where('application_number',$phase['application_number'])->first();
                                                            if(empty($costs)){
                                                                $disable ="";
                                                            }else{
                                                                $disable ="disabled";
                                                            }
                                                            
                                                        ?>
                                                            <option value="<?php echo $phase->customer_id ?>" <?php echo $disable;?>><?php echo $phase->application_number ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    @error('application_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Name of the Applicant <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state1">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                   Block <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state4">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                   Flat Number <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state5">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                   Flat Type <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state6">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Floor <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state7">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Flat Facing <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state8">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                    
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Rate per SQFT <span class="red">*</span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input value="{{ old('rate_sqft') }}" type="text" id="Text1" autocomplete="off" class="form-control" name="rate_sqft" />
                                                    @error('rate_sqft')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Area of the Flat (Salable Area)<span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state2">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Salable Value
                                                </label>
                                                <div class="col-md-4">
                                                    <input value="{{ old('salable_value') }}" type="text" id="txtresult" disabled autocomplete="off" class="form-control" name="salable_value" />
                                                    @error('salable_value')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    UDS (in Sq.Ft)<span class="red">*</span>
                                                </label>
                                                <div class="col-md-4" id="state3">
                                                    <input type="text" disabled autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-8">
                                                    Guideline Value<span class="red">*</span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input value="{{ old('guideline_value') }}" type="text" id="Text4" autocomplete="off" class="form-control" name="guideline_value" />
                                                    @error('guideline_value')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><span>[A]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Land Cost
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('land_cost') }}" type="text" id="txt" disabled autocomplete="off" class="form-control" name="land_cost" />
                                                @error('land_cost')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><span>[B]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Construction Cost
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('construction_cost') }}" type="text" id="txtres" disabled autocomplete="off" class="form-control" name="construction_cost" />
                                                @error('construction_cost')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><span>[C]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Electricity charges
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('electricity_charges') }}" type="text" autocomplete="off" class="form-control" id="electricity" name="electricity_charges" />
                                                @error('electricity_charges')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Metro Water Supply
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('water_supply') }}" type="text" autocomplete="off" class="form-control" id="water" name="water_supply" />
                                                @error('water_supply')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Car Park
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('car_park') }}" type="text" autocomplete="off" class="form-control" id="car" name="car_park" />
                                                @error('car_park')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Amenities charges
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('amenities_charges') }}" type="text" autocomplete="off" class="form-control" id="amenities" name="amenities_charges" />
                                                @error('amenities_charges')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Maintenance Charges(To be decided )
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('maintenance') }}" type="text" autocomplete="off" id="maintenance" class="form-control" name="maintenance" />
                                                @error('maintenance')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8 stronglabel">
                                                Gross Amount=[A]+[B]+[C]
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('gross_amount') }}" disabled type="text" id="result" autocomplete="off" class="form-control" name="gross_amount" />
                                                @error('gross_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <span>[D]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Stamp Duty charges @7% on [A]
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('stamp') }}" type="text" id="stamp" disabled autocomplete="off" class="form-control" name="stamp" />
                                                @error('stamp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Registration charges @4% on [A](demand draft)
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('registration') }}" type="text" id="registration" disabled autocomplete="off" class="form-control" name="registration" />
                                                @error('registration')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Registration charges for Construction Agreement @2% on [B]+[C]
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('construction') }}" type="text" id="construction" disabled autocomplete="off" class="form-control" name="construction" />
                                                @error('construction')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><span>[E]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                Corpus fund
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('corpus_fund')}}" type="text" id="corpus" autocomplete="off" class="form-control" name="corpus_fund" />
                                                @error('corpus_fund')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><span>[F]</span>
                                        <div class="form-group row">
                                            <label class="col-md-8">
                                                GST @1%
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('gst') }}" id="gst" type="text" disabled autocomplete="off" class="form-control" name="gst" />
                                                @error('gst')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-8 stronglabel">
                                                Total Amount
                                            </label>
                                            <div class="col-md-4">
                                                <input value="{{ old('total_amount') }}" disabled type="text" id="total" autocomplete="off" class="form-control" name="total_amount" />
                                                @error('total_amount')
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
    $('#country').change(function() {
        var country = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
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
        var sal = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "salable_area": sal
            },
            dataType: 'html',
            success: function(data) {
                $("#state2").html(data);
            }
        });
    });
    $('#country').change(function() {
        var uds = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "uds_area": uds
            },
            dataType: 'html',
            success: function(data) {
                $("#state3").html(data);
            }
        });
    });
    $('#country').change(function() {
        var block = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "block": block
            },
            dataType: 'html',
            success: function(data) {
                $("#state4").html(data);
            }
        });
    });
    $('#country').change(function() {
        var flatnumber = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "flatnumber": flatnumber
            },
            dataType: 'html',
            success: function(data) {
                $("#state5").html(data);
            }
        });
    });
    $('#country').change(function() {
        var flattype = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "flattype": flattype
            },
            dataType: 'html',
            success: function(data) {
                $("#state6").html(data);
            }
        });
    });
    $('#country').change(function() {
        var floor = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "floor": floor
            },
            dataType: 'html',
            success: function(data) {
                $("#state7").html(data);
            }
        });
    });
    $('#country').change(function() {
        var facing = $(this).val();
        $.ajax({
            url: "{{route('costs.map')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "facing": facing
            },
            dataType: 'html',
            success: function(data) {
                $("#state8").html(data);
            }
        });
    });
    $('#Text1, #Text2').on("paste keyup",
        function() {
            var result = parseFloat($("#Text1").val()) * parseFloat($("#Text2").val());
            $("#txtresult").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );
    $('#Text3, #Text4').on("paste keyup",
        function() {
            var result = parseFloat($("#Text3").val()) * parseFloat($("#Text4").val());
            $("#txt").val((isNaN(result) ? '' : result).toFixed(2));

            var result = parseFloat($("#txtresult").val()) - parseFloat($("#txt").val());
            $("#txtres").val((isNaN(result) ? '' : result).toFixed(2));

            var result = ((parseFloat($("#txt").val()) * 7) / 100);
            $("#stamp").val((isNaN(result) ? '' : result).toFixed(2));

            var result = ((parseFloat($("#txt").val()) * 4) / 100);
            $("#registration").val((isNaN(result) ? '' : result).toFixed(2));
        }
    );
    $('#electricity, #car,#water,#amenities,#maintenance').on("paste keyup",
        function() {
            var result = parseFloat($("#txt").val()) + parseFloat($("#txtres").val()) + parseFloat($("#electricity").val()) + parseFloat($("#water").val()) + parseFloat($("#car").val()) + parseFloat($("#amenities").val()) + parseFloat($("#maintenance").val());
            $("#result").val((isNaN(result) ? '' : result).toFixed(2));

            var result = ((parseFloat($("#result").val()) * 1) / 100);    
            $("#gst").val((isNaN(result) ? '' : result).toFixed(2));

            var agreements = (((parseFloat($("#txtres").val()) + parseFloat($("#electricity").val()) + parseFloat($("#water").val()) + parseFloat($("#car").val()) + parseFloat($("#amenities").val()) + parseFloat($("#maintenance").val())) * 2) / 100);   
            $("#construction").val((isNaN(agreements) ? '' : agreements).toFixed(2));

            var totals = parseFloat($("#result").val()) + parseFloat($("#stamp").val()) + parseFloat($("#registration").val()) + parseFloat($("#construction").val()) + parseFloat($("#corpus").val()) + parseFloat($("#gst").val());
            $("#total").val((isNaN(totals) ? '' : totals).toFixed(2));
        }
    );
    $('#corpus').on("paste keyup",
        function() {
            var total = parseFloat($("#result").val()) + parseFloat($("#stamp").val()) + parseFloat($("#registration").val()) + parseFloat($("#construction").val()) + parseFloat($("#corpus").val()) + parseFloat($("#gst").val());
            $("#total").val((isNaN(total) ? '' : total).toFixed(2));
        }
    );
</script>
@endsection