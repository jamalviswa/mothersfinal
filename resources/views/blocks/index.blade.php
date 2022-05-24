@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Block Details
                </h3>
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
                            <div class="m-section__content">
                                <div class="row ul-type">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                        <ul class="m-0 p-0">
                                            <?php
                                            $blocks = App\Block::where('status', 'Active')->get();
                                            foreach ($blocks as $block) {
                                            ?>
                                                <li>
                                                    <div class="j-typebox">
                                                        <input type="button" class="j-type date-btn" value="<?php echo $block->block_name ?>">
                                                    </div>

                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="block hide">
                            <hr>
                            <div class="row" id="block">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".date-btn", function() {
        var phase = $(this).val();
        $(this).css('background-color', 'green');
        $(this).css('color', '#fff');
        $(".date-btn").not($(this)).css('background-color', '#ffff45');
        $(".date-btn").not($(this)).css('color', '#222');
        jQuery.ajax({
            type: "post",
            url: "{{route('blocks.map')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "phase": phase
            },
            dataType: "html",
            success: function(data) {
                $('#block').html(data);
                $('.block').removeClass('hide');
            }
        });
    });
</script>
<style>
    .ul-type ul {
        list-style: none;
        display: flex;
        justify-content: space-evenly;
    }

    .j-typebox .j-type {
        font-size: 25px;
        font-weight: 600;
        text-align: center;
        color: black;
        border-radius: 20px;
        height: 150px;
        cursor: pointer;
        width: 150px;
        background-color: #21ffff;
    }


    .col-md-2.j-box.lab-2.BHK {
        background-color: #c7f8ca;
    }
    .col-md-2.j-box.lab-1.BHK {
        background-color: #ffff45;
    }
    .col-md-2.j-box.lab-3.BHK {
        background-color: #ffa9ff;
    }
    .col-md-2.j-box.lab-2.BHK.P{
        background-color: #7ea1fa;
    }
    .col-md-2.j-box.lab-2.BHK.SP{
        background-color: #a7905a;
    }
    .col-md-2.j-box.lab-3.BHK.P{
        background-color: #21ffff;
    }


    .col-md-2.j-box.lab-2.BHK.sales, .col-md-2.j-box.lab-1.BHK.sales, .col-md-2.j-box.lab-3.BHK.sales, .col-md-2.j-box.lab-2.BHK.P.sales, .col-md-2.j-box.lab-2.BHK.SP.sales, .col-md-2.j-box.lab-3.BHK.P.sales{
        background-color: #ff0000;
    }
   
     
   

    .j-box {
        height: 115px;
        border: 2px solid BLACK;
        border-radius: 20px;
        text-align: center;
        background-color: #fff;
        max-width: 120px;
        margin-left: 20px;
        margin-bottom: 20px;
        cursor: pointer;
    }
    .j-numb.sales{
        color: #fff;
        font-size: 13px;
        text-align: center;
        padding-top: 14px;
        cursor: pointer;
        font-weight: 600;
    }

    .j-numb {
        color: #222;
        font-size: 20px;
        text-align: center;
        padding-top: 30px;
        cursor: pointer;
        font-weight: 600;
    }
    .j_url{
        text-decoration: none !important;
    }
</style>
@endsection