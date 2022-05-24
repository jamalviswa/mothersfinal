@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Add Flat Number Details
                </h3>
            </div>
            <div>
                <a href="{{route('masters.flatnumber_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  
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
                            <form method="post" action="{{ route('masters.flatnumber_store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">


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
                                        
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Flat Number <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('flatnumber') }}" type="text" autocomplete="off" class="form-control" name="flatnumber" />
                                                @error('flatnumber')
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
    $('#phase').change(function() {
        var phase = $(this).val();
        $.ajax({
            url: "{{route('masters.map')}}",
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
            url: "{{route('masters.map')}}",
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
            url: "{{route('masters.map')}}",
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
</script>
@endsection