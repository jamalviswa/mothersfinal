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
                    Edit Floor Details
                </h3>
            </div>
            <div>
                <a href="{{route('masters.floor_index')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Back to List">
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
                            <form method="post" action="{{ route('masters.floor_update',$detail['floor_id']) }}" class="validation_form" id="upload" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <div class="m-section__content">
                                        <div id="err"></div>

                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Phase<span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control phase" name="phase" id="phase">
                                                    @php
                                                    $phases = App\Phase::where('status','Active')->get();
                                                    @endphp
                                                    <option value="">---Select Phase---</option>
                                                    @foreach($phases as $phase)
                                                    <option {!!($phase['phase_id']==$requestdatas['phase'])? "selected" :""; !!} value="{{ $phase['phase_id'] }}">{{ $phase['phase_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('phase')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class= "form-group row block ">
                                            <label class="col-md-5">
                                                BLock <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control"  id="block"  name="block" >
                                            @php
                                            $blocks = App\Block::where('phase_id',$requestdatas['phase'])->get();
                                            @endphp
                                            <option value="">---Select Block---</option>
                                            @foreach($blocks as $block)
                                            <option  {!!($block['block_id']==$requestdatas['block'])? "selected" :""; !!} value="{{ $block['block_id'] }}">{{ $block['block_name'] }}</option>
                                              @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-5">
                                                Floor Name <span class="red">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input value="{{ $requestdatas['floor_name'] }}" type="text" autocomplete="off" class="form-control" name="floor_name" />
                                                @error('floor_name')
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
</script>
@endsection