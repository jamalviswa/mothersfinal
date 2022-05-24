@extends('layouts.admin')
@section('content')
<?php
$requestdatas = (!empty(old())) ? old() : $detail;
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Edit Country 
                </h3>
            </div>
            <div>
                <a href="{{route('countries.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                            <form method="post" action="{{ route('countries.update',$detail['country_id']) }}" class="validation_form" id="upload" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">
                                        <div id="err"></div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Country Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['country_name'] }}" type="text" autocomplete="off" class="form-control" name="country_name" />
                                                @error('country_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Country Code <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['country_code'] }}" type="text" autocomplete="off" class="form-control" name="country_code" />
                                                @error('country_code')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-md-5">
                                         Image <span class="red">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="file"  accept="image/png, image/jpg, image/jpeg" class="form-control" name="image"  />
                                        @if(!empty( $detail->image))
                                            <img src="{{URL::to('public/files/countries/'. $detail->image.'')}}" class="img-sm"/>
                                         @endif
                                            @error('image')
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
@endsection