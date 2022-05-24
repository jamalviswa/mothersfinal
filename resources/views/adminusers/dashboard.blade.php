@extends('layouts.admin')
@section('content')
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Dashboard</h3>			
            </div>
        </div>
    </div>
</div>
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<style>
    #chartdiv1 {
        width: 100%;
        height: 500px;
    }
    .form-inline.validation_form {
        float: right;
        margin: 15px;
    }.form-inline .form-control {
        margin-right: 10px;
    }
</style>

@endsection


