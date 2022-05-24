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
                    Edit Discount
                </h3>
            </div>
            <div>
                <a href="{{route('discounts.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to Discounts List">
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
                            <form method="post" action="{{ route('discounts.update',$detail['discount_id']) }}"  id="upload" class="validation_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-8">
                                <div class="m-section__content">
                                    <!--<div id="err"></div>-->
                                   <div class="form-group row">
                                                <label class="col-md-5">
                                                    Select Pack <span class="red">*</span>
                                                </label>
                                                <div class="col-md-7">
                                                    <select class="form-control" name="pack">
                                                         @php
                                            $packs = App\Package::where('status','Active')->where('pack','Premium')->get();
                                            @endphp
                                              <option value=""> --Select Pack-- </option>
                                                @foreach($packs as $pack)
                                               <option {{ $requestdatas['pack'] == $pack['package_id'] ? "selected" : "" }} value="{{ $pack['package_id'] }}">{{ $pack['name'] }}</option>
                                              @endforeach
                                                       
                                                    </select>
                                                    @error('pack')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    <div class="form-group row">
                                        <label class="col-md-5">
                                            Discount percentage(%) <span class="red">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input value="{{ $requestdatas['discount'] }}" type="text" autocomplete="off" class="form-control" name="discount" />
                                              
                                            @error('discount')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                        <label class="col-md-5">
                                           Validity Ending Date<span class="red">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($requestdatas['validity'])) }}"   name="validity" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar "></span>
                                            </div>
                                        </div>
                                            @error('validity')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div> 
                                                   <div class="form-group row">
                                            <label class="col-md-5">
                                                Status <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7 radio-sec">
                                                <label><input {!! ($requestdatas['status'] == "Active") ? "checked" : "" !!}  type="radio" class="" name="status" value="Active" checked="checked"> <span> Active</span></label><br>
                                                <label><input {!! ($requestdatas['status'] == "Inactive") ? "checked" : "" !!} type="radio" class="" name="status" value="Inactive"> <span> Inactive</span></label><br>
                                                 
                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                
                                   <div class="form-group text-left">
                                        <button type="submit" name="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                            Submit
                                        </button>
                                    </div>
                                    
                                    
                                    
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
.input-group-addon{
    width: 44px !important;
    font-size: 25px !important;
    padding-bottom: 10px !important;
    padding-left: 9px !important;
}
 </style>
@endsection
