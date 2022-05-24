@extends('layouts.admin')
@section('content')
<?php $requestdata = request(); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Personal Details
                </h3>
            </div>
            <div>
                <a href="{{route('customers.personal_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  
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
                            <form method="post" action="{{ route('customers.personal_store') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Name of the applicant <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('applicant_name') }}" type="text" autocomplete="off" class="form-control" name="applicant_name" />
                                                @error('applicant_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Application Number <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('application_number') }}" type="text" autocomplete="off" class="form-control" name="application_number" />
                                                @error('application_number')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Date of Application <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">

                                                <input value="{{old('date_of_application') }}" autocomplete="off" type="text" class="form-control datepicker" name="date_of_application" />

                                                @error('date_of_application')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Father / Spouse Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('fathers_name') }}" type="text" autocomplete="off" class="form-control" name="fathers_name" />
                                                @error('fathers_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Age <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('age') }}" type="number" autocomplete="off" class="form-control" name="age" />
                                                @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Gender <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7 radio-sec">
                                                <label><input type="radio" class="" name="gender" value="Male"> <span> Male</span></label><br>
                                                <label><input type="radio" class="" name="gender" value="Female"> <span> Female</span></label><br>
                                            </div>
                                            <div class="col-md-7 offset-md-5">
                                                @error('gender')
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
                                                        <input value="{{ old('phone_code') }}" type="tel" autocomplete="off" class="form-control" name="phone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ old('phone') }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="phone" />
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
                                                Alternative Mobile Number
                                            </label>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input value="{{ old('altphone_code') }}" type="tel" autocomplete="off" class="form-control" name="altphone_code" style="width:72%" maxlength="4" />
                                                    </div>
                                                    <div class="col-9">
                                                        <input value="{{ old('altphone') }}" id="phone" type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10" autocomplete="off" class="form-control" name="altphone" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Email <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('email') }}" type="email" autocomplete="off" class="form-control" name="email" />
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Occupation
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ old('occupation') }}" type="text" autocomplete="off" class="form-control" name="occupation" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Total Years of Experience
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input value="{{ old('experience') }}" type="number" autocomplete="off" class="form-control" name="experience" />
                                                    <span class="input-group-text">Years</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Residential/ Permanent Address
                                            </label>
                                            <div class="col-md-7">
                                                <textarea rows="4" class="form-control" name="permanent_address"> {{ old('permanent_address')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Correspondance/ Present Address
                                            </label>
                                            <div class="col-md-7">
                                                <textarea rows="4" class="form-control" name="present_address"> {{ old('present_address')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Annual Income
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group"> <span class="input-group-text">₹</span>
                                                    <input value="{{ old('income') }}" id="income" type="text" autocomplete="off" class="form-control" name="income" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Photo (max-size up to 2Mb)
                                            </label>
                                            <div class="col-md-7">
                                                <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" name="photo" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Son
                                            </label>
                                            <div class="col-md-7">
                                                <div class="marketing_range">
                                                    <ul class="marketing_range_list" style="padding:0px">
                                                        <li>
                                                            <div class="row" style="margin-bottom: 12px;">
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="son_name[]" type="text" autocomplete="off" placeholder="Name" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="son_age[]" type="number" autocomplete="off" placeholder="Age" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="son_profession[]" type="text" autocomplete="off" placeholder="Profession" style="width:100%;">
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-bottom: 12px;">
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="son_school[]" type="text" autocomplete="off" placeholder="School" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="son_class[]" type="text" autocomplete="off" placeholder="Class" style="width:100%;">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <button type="button" id="marketing_range-add-more" class="btn btn-success btn-green"><i class="fa fa-plus"></i></button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Daughter
                                            </label>
                                            <div class="col-md-7">
                                                <div class="marketing_range">
                                                    <ul class="marketing_range_lis" style="padding:0px">
                                                        <li>
                                                            <div class="row" style="margin-bottom: 12px;">
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="daughter_name[]" type="text" autocomplete="off" placeholder="Name" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="daughter_age[]" type="number" autocomplete="off" placeholder="Age" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="daughter_profession[]" type="text" autocomplete="off" placeholder="Profession" style="width:100%;">
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-bottom: 12px;">
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="daughter_school[]" type="text" autocomplete="off" placeholder="School" style="width:100%;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control " name="daughter_class[]" type="text" autocomplete="off" placeholder="Class" style="width:100%;">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <button type="button" id="marketing_range-add-mor" class="btn btn-success btn-green"><i class="fa fa-plus"></i></button>
                                                    </ul>
                                                </div>
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
    $("#marketing_range-add-more").click(function() {
        $(".marketing_range_list").append('<li class="added-li"><div class="row" style="margin-bottom: 12px;"><div class="col-md-4"><input style="width: 100%;" class="form-control " name="son_name[]"  type="text" autocomplete="off" placeholder="Name"></div><div class="col-md-4"><input class="form-control" name="son_age[]" type="number" autocomplete="off"  placeholder="Age" style="width: 100%;"></div><div class="col-md-4"><input style="width: 100%;" class="form-control " name="son_profession[]"  type="text" autocomplete="off" placeholder="Profession"></div></div><div class="row" style="margin-bottom: 12px;"><div class="col-md-4"><input style="width: 100%;" class="form-control " name="son_school[]"  type="text" autocomplete="off" placeholder="School"></div><div class="col-md-4"><input style="width: 100%;" class="form-control " name="son_class[]" type="text" autocomplete="off" placeholder="Class"></div></div><a class="btn btn-danger removebtn" style="margin: 0px;margin-bottom: 5px;" href="#" onclick="parentNode.parentNode.removeChild(parentNode)">-</a></li>');
    });

    $("#marketing_range-add-mor").click(function() {
        $(".marketing_range_lis").append('<li class="added-li"><div class="row" style="margin-bottom: 12px;"><div class="col-md-4"><input style="width: 100%;" class="form-control " name="daughter_name[]"  type="text" autocomplete="off" placeholder="Name"></div><div class="col-md-4"><input class="form-control" name="daughter_age[]" type="number" autocomplete="off"  placeholder="Age" style="width: 100%;"></div><div class="col-md-4"><input style="width: 100%;" class="form-control " name="daughter_profession[]"  type="text" autocomplete="off" placeholder="Profession"></div></div><div class="row" style="margin-bottom: 12px;"><div class="col-md-4"><input style="width: 100%;" class="form-control " name="daughter_school[]"  type="text" autocomplete="off" placeholder="School"></div><div class="col-md-4"><input style="width: 100%;" class="form-control " name="daughter_class[]"  type="text" autocomplete="off" placeholder="Class"></div></div><a class="btn btn-danger removebtn" style="margin: 0px;margin-bottom: 5px;" href="#" onclick="parentNode.parentNode.removeChild(parentNode)">-</a></li>');
    });

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: "today"
    });

    var input = document.querySelector('#income');
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9 \,]/, '');
    });
</script>
<style>
    .radio-sec input {
        position: relative;
        top: 0px;
        margin-right: 5px;
        margin-left: 0px;
    }

    .course-div {
        box-shadow: 0 0 5px 2px #ddd;
        padding: 18px;
        margin: 15px 0;
    }

    ul {
        list-style: none;
        margin-left: 0px;
    }

    .btn.btn-success.btn-green {
        background-color: green !important;
        padding: 14px 8px !important;
        height: 33px !important;
        text-align: center !important;
        margin: 8px 0 9px 6px !important;
        color: #fff !important;
    }

    .btn.btn-success.btn-danger {
        background-color: red !important;
        padding: 14px 8px !important;
        height: 33px !important;
        text-align: center !important;
        margin: 8px 0 9px 6px !important;
        color: #fff !important;
    }

    a.btn.btn-danger.removebtn {
        padding: 7px 11px;
        height: 33px;
        text-align: center;
        margin: 8px 0 9px 6px;
        color: #fff;
    }

    .inptwo {
        width: 53px;
    }
</style>
@endsection