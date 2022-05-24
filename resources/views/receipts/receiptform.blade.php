<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$detail = App\Receipt::where('receipt_id', '=', $receipt_id)->first();
if (!empty($detail)) {
?>
    <div class="row">
        <div class="col-md-12">
            <div class="borderr">

                <div class="form-group row" style="display: flex;">
                    <div class="col-md-3" style="position: relative;height:0.2pc;top:1pc;">
                        <img src="{{ public_path('/files/mlogo.png') }}">
                    </div>
                    <div class="col-md-5" style="position:relative;left:30pc;top:2pc;">
                        Mother's Village <br>Nesavalar Colony Road,<br>(Before Ondipudur flyover)<br>Singanallur,<br> Coimbatore - 641 005<br>Ph: 0422-4599328
                    </div>
                </div>
                <div class="form-group row" style="display: flex;">
                    <label class="col-md-1" style="font-weight:700;font-style: italic;font-family: 'Flaticon';font-size:25px;">
                        Mount Kailash Properties
                    </label>
                </div>
                <hr>

                <div class="form-group row" style="display: flex;">
                    <div class="col-md-2" style="position:relative;left:18pc;border: 2px solid #000;font-weight: 800;width:5pc;padding-left:1pc;border-radius:7px;">
                        RECEIPT
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-1" style="font-weight:700;">
                        No
                    </label>
                    <div class="col-md-3" style="position: relative;left: 3pc;">
                        {{ $detail->receipt_no }}
                    </div>
                    <div class="col-md-5" style="position: relative;left: 33pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;">
                            Date
                        </label>
                    </div>
                    <div class="col-md-3" style="position: relative;left: 36pc;">
                        {{ $detail->receipt_date }}
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-1" style="font-weight:700;">
                        Application No
                    </label>
                    <div class="col-md-3" style="position: relative;left: 7pc;border-bottom:2px dotted;width:8pc;">
                        {{ $detail->application_number }}
                    </div>
                    <div class="col-md-5" style="position: relative;left: 15pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;">
                            Received with thanks from
                        </label>
                    </div>
                    <div class="col-md-3" style="position: relative;left: 27pc;border-bottom:2px dotted;width:15.5pc;">
                        {{ $detail->received }}
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:700;">
                        a sum of Rupees
                    </label>
                    <div class="col-md-3" style="position: relative;left: 7.5pc;border-bottom:2px dotted;width:35pc;">
                        <?php 
                        if(!empty($detail->sum_rupees)){
                            echo $detail->sum_rupees;
                        } else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:700;">
                        by Cheque / DD No
                    </label>
                    <div class="col-md-3" style="position: relative;left: 9pc;border-bottom:2px dotted;width:10pc;">           
                        <?php 
                        if(!empty($detail->cheque_no)){
                            echo $detail->cheque_no;
                        } else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                    <div class="col-md-3" style="position: relative;left: 19.5pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;">
                            Dated
                        </label>
                    </div>
                    <div class="col-md-2" style="position: relative;left: 23pc;border-bottom:2px dotted;width:19.5pc;">                     
                        <?php 
                        if(!empty($detail->dated)){
                            echo $detail->dated;
                        } else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:700;">
                        drawn on
                    </label>
                    <div class="col-md-3" style="position: relative;left: 4.5pc;border-bottom:2px dotted;width:14pc;">
                        <?php 
                        if(!empty($detail->drawn_on)){
                            echo $detail->drawn_on;
                        } else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                    <div class="col-md-3" style="position: relative;left: 19pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;">
                            Bank towards
                        </label>
                    </div>
                    <div class="col-md-2" style="position: relative;left: 25.5pc;border-bottom:2px dotted;width:17pc;">
                        <?php 
                        if(!empty($detail->bank_towards)){
                            echo $detail->bank_towards;
                        } else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:700;">
                        Referred by
                    </label>
                    <div class="col-md-3" style="position: relative;left: 5.5pc;border-bottom:2px dotted;width:13pc;">
                        <?php 
                        if(!empty($detail->referred_by)){
                            echo $detail->referred_by;
                        } else { 
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                    <div class="col-md-3" style="position: relative;left: 30pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;font-style: italic;font-family: 'Flaticon';">
                            <small style="font-weight: 600; font-style: italic;font-family: 'Flaticon';">for</small> Mount Kailash Properties
                        </label>
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <div class="input-group" style="border: 2px solid grey;width:13pc;">
                        <span class="input-group-text" style="font-weight: 800;font-size:18px;line-height: 1.25;color: #495057;text-align: center;padding: 0.65rem 0.5rem 0.65rem 1rem; white-space: nowrap;height:7px;border-right:1px solid;">Rs</span>
                        {{ $detail->final_amount }}
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <label class="col-md-4" style="font-weight:700;top:1pc;">
                        * Cheque subject to realisation.
                    </label>
                    <div class="col-md-3" style="position: relative;left: 32pc;border-bottom:none;">
                        <label class="col-md-1" style="font-weight:700;">
                            Authorised Signatory
                        </label>
                    </div>
                </div>

                <div class="form-group row" style="display: flex;">
                    <div class="col-md-4" style="position:relative;left:9pc;">
                    * This is computer generated receipt no signature required
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<style>
    .input-group-text {
        font-weight: 600 !important;
        border-radius: unset !important;
    }

    .j-heads {
        font-style: italic;
        font-family: 'Flaticon';
        text-align: right;
        font-weight: 600;
    }

    .j_receipt {
        border: 2px solid #000;
        border-radius: 40px;
        max-width: 84px;
        font-weight: 800;
    }

    .j_title {
        font-style: italic;
        font-family: 'Flaticon';
        font-size: 20;
    }

    .j_para {
        margin-bottom: 0px !important;
        margin-top: 14pc;
        font-size: 15pc;
        font-weight: 600;
    }

    .borderr {
        border: 2px solid grey;
        border-radius: 40px;
        padding: 2px 15px 2px 15px;
    }

    .j-label {
        font-weight: 700;
        font-size: 17px;
    }

    .j-text {
        font-size: 17px;
        font-weight: 500;
        border-bottom: 2px dotted;
    }

    .j-untext {
        font-size: 17px;
        font-weight: 500;
    }
</style>