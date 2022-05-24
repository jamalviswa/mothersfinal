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
                    Edit Pack
                </h3>
            </div>
            <div>
                <a href="{{route('costs.index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to Pack List">
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
                                 <form method="post" action="{{ route('costs.update',$detail['cost_id']) }}" class="validation_form" id="upload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
                                <div class="m-section__content">
                                    <!--<div id="err"></div>-->
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            Name <span class="red">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input value="{{ $requestdatas['name'] }}" type="text" autocomplete="off" class="form-control" name="name" />
                                            @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div>
                                         <div class="form-group row">
                                                <label class="col-md-4">
                                                    Choose a Pack
                                                </label>
                                                <div class="col-md-8">
                                                    <select name="pack" class="form-control">
                                                        <option>Select pack</option>
                                                        <option {!! ($requestdatas['pack'] == "Free") ? "selected" : "" !!} id="hide"  value="Free">Free</option>
                                                        <option {!! ($requestdatas['pack'] == "Premium") ? "selected" : "" !!} id="show"  value="Premium">Premium</option>
                                                    </select>
                                                    @error('pack')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    <div class="form-group  view row <?php echo ($requestdatas['pack'] == "Free") ? "hide" : "" ?>">
                                        <label class="col-md-4">
                                            Pack Price ($)
                                        </label>
                                        <div class="col-md-8">
                                             <input value="{{ $requestdatas['price'] }}" type="text" autocomplete="off" class="form-control" name="price" />
                                            @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-md-4">
                                                Price Duration <span class="red">*</span>
                                            </label>
                                            <div class="col-md-8 radio-sec">
                                                <label><input {!! ($requestdatas['duration'] == "1 Month") ? "checked" : "" !!} type="radio" class="" name="duration" value="1 Month"> <span> 1 month</span></label><br>
                                                <label><input {!! ($requestdatas['duration'] == "1 Year") ? "checked" : "" !!} type="radio" class="" name="duration" value="1 Year"> <span> 1 year</span></label><br>
                                                @error('duration')
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
                            <div class="col-md-6">
                                 <div class="form-group row">
                                        <label class="col-md-4">
                                            No of Cards
                                        </label>
                                        <div class="col-md-8">
                                             <input value="{{ $requestdatas['num_cards'] }}" type="text" autocomplete="off" class="form-control" name="num_cards" />
                                            @error('num_cards')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div>
                                 <div class="form-group row">
                                        <label class="col-md-4">
                                            Select Category
                                        </label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="category">
                                             
                                             
                                            </select>
                                            @error('category')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-md-4">
                                            Status
                                        </label>
                                        <div class="col-md-8 radio-sec">
                                                <label><input {!! ($requestdatas['status'] == "Active") ? "checked" : "" !!} type="radio" class="" name="status" value="Active"> <span> Active</span></label><br>
                                                <label><input {!! ($requestdatas['status'] == "Inactive") ? "checked" : "" !!} type="radio" class="" name="status" value="Inactive"> <span> Inactive</span></label><br>
                                            @error('gender')
                                              <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                              </span>
                                             @enderror
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
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $(".view").hide();
  });
  $("#show").click(function(){
    $(".view").show();
  });
});
</script>
@endsection
