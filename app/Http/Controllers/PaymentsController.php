<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rules\Mobile;
use App\Rules\Email;
use Session;
use DB;
use Redirect;
use App\Payment;
use App\Customer;
use App\Cost;
use PDF;

class PaymentsController extends Controller
{

    public function index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Payment::where('status', '<>', 'Trash')->where('addmore','=','0')
            ->orderBy('payment_id', 'desc');
            if (!empty($_REQUEST['applicant_name'])) {
                $customer = $_REQUEST['applicant_name'];
                $result->where(function ($query) use ($customer) {
                    $query->where('applicant_name', 'LIKE', "%$customer%");
                });
            }
            if (!empty($_REQUEST['application_number'])) {
                $customer = $_REQUEST['application_number'];
                $result->where(function ($query) use ($customer) {
                    $query->where('application_number', 'LIKE', "%$customer%");
                });
            }
            if (!empty($_REQUEST['bank_type'])) {
                $customer = $_REQUEST['bank_type'];
                $result->where(function ($query) use ($customer) {
                    $query->where('bank_type', 'LIKE', "%$customer%");
                });
            }

        $result = $result->paginate(10);

        return view('/payments/index', [
            'results' => $result
        ]);
    }
    public function add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('payments/add', []);
    }
    public function store(Request $request)
    {
        $check = $this->validate($request, [
            'payment_schedule' => ['required'],
            'transaction_type' => ['required'],
            'application_number' => ['required'],
        ]);

        $data = new Payment();
        $sessionadmin = Parent::checkadmin();
        $data->customer_id = $request->application_number;
        $names = Customer::where('customer_id', $request->application_number)->where('status', 'Active')->first();
        $data->application_number = $names->application_number;
        $data->applicant_name = $names->applicant_name;
        $data->date_of_application = $names->date_of_application;
        $documents = Cost::where('customer_id', $request->application_number)->where('status', 'Active')->first();
        $data->cost_id = $documents->cost_id;
        $data->gross_amount = $documents->gross_amount;
        $data->payment_schedule = $request->payment_schedule;
        $data->transaction_type = $request->transaction_type;
        $data->bank_type = ($request->transaction_type == "Bank") ? $request->bank_type : "-";
        $data->bank_name = ($request->bank_type == "OTHERS") ? $request->bank_name : "-";
        $data->loan_amount = $request->loan_amount;

        $onbook10pers = ($data->gross_amount * 10) / 100;
        $onbook10per = number_format((float)$onbook10pers, 2, '.', '');
        $data->onbook10per = $onbook10per;
        $data->onbook_received10per = $request->onbook_received10per ? $request->onbook_received10per : "0";
        $balances = $data->onbook10per - $data->onbook_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance10per = $balance;
        $data->onbook_paymentdate10per = $request->onbook_paymentdate10per ? $request->onbook_paymentdate10per : "-";
        $data->onbook_transactiontype10per = $request->onbook_transactiontype10per ? $request->onbook_transactiontype10per : "-";
        $data->onbook_paymenttype10per = $request->onbook_paymenttype10per ? $request->onbook_paymenttype10per : "-";
        $data->onbook_chequenumber10per = ($request->onbook_paymenttype10per == "Cheque") ? $request->onbook_chequenumber10per : "-";
        $data->onbook_neftid10per = ($request->onbook_paymenttype10per == "NEFT") ? $request->onbook_neftid10per : "-";
        $data->onbook_rtgsid10per = ($request->onbook_paymenttype10per == "RTGS") ? $request->onbook_rtgsid10per : "-";

        $payments10pers = ($data->gross_amount * 40) / 100;
        $payments10per = number_format((float)$payments10pers, 2, '.', '');
        $data->payments10per = $payments10per;
        $data->payments_received10per = $request->payments_received10per ? $request->payments_received10per : "0";
        $balances = $data->payments10per - $data->payments_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance10per = $balance;
        $data->payments_paymentdate10per = $request->payments_paymentdate10per ? $request->payments_paymentdate10per : "-";
        $data->payments_transactiontype10per = $request->payments_transactiontype10per ? $request->payments_transactiontype10per : "-";
        $data->payments_paymenttype10per = $request->payments_paymenttype10per ? $request->payments_paymenttype10per : "-";
        $data->payments_chequenumber10per = ($request->payments_paymenttype10per == "Cheque") ? $request->payments_chequenumber10per : "-";
        $data->payments_neftid10per = ($request->payments_paymenttype10per == "NEFT") ? $request->payments_neftid10per : "-";
        $data->payments_rtgsid10per = ($request->payments_paymenttype10per == "RTGS") ? $request->payments_rtgsid10per : "-";

        $first10pers = ($data->gross_amount * 10) / 100;
        $first10per = number_format((float)$first10pers, 2, '.', '');
        $data->first10per = $first10per;
        $data->first_received10per = $request->first_received10per ? $request->first_received10per : "0";
        $balances = $data->first10per - $data->first_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance10per = $balance;
        $data->first_paymentdate10per = $request->first_paymentdate10per ? $request->first_paymentdate10per : "-";
        $data->first_transactiontype10per = $request->first_transactiontype10per ? $request->first_transactiontype10per : "-";
        $data->first_paymenttype10per = $request->first_paymenttype10per ? $request->first_paymenttype10per : "-";
        $data->first_chequenumber10per = ($request->first_paymenttype10per == "Cheque") ? $request->first_chequenumber10per : "-";
        $data->first_neftid10per = ($request->first_paymenttype10per == "NEFT") ? $request->first_neftid10per : "-";
        $data->first_rtgsid10per = ($request->first_paymenttype10per == "RTGS") ? $request->first_rtgsid10per : "-";

        $second10pers = ($data->gross_amount * 10) / 100;
        $second10per = number_format((float)$second10pers, 2, '.', '');
        $data->second10per = $second10per;
        $data->second_received10per = $request->second_received10per ? $request->second_received10per : "0";
        $balances = $data->second10per - $data->second_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance10per = $balance;
        $data->second_paymentdate10per = $request->second_paymentdate10per ? $request->second_paymentdate10per : "-";
        $data->second_transactiontype10per = $request->second_transactiontype10per ? $request->second_transactiontype10per : "-";
        $data->second_paymenttype10per = $request->second_paymenttype10per ? $request->second_paymenttype10per : "-";
        $data->second_chequenumber10per = ($request->second_paymenttype10per == "Cheque") ? $request->second_chequenumber10per : "-";
        $data->second_neftid10per = ($request->second_paymenttype10per == "NEFT") ? $request->second_neftid10per : "-";
        $data->second_rtgsid10per = ($request->second_paymenttype10per == "RTGS") ? $request->second_rtgsid10per : "-";

        $third10pers = ($data->gross_amount * 10) / 100;
        $third10per = number_format((float)$third10pers, 2, '.', '');
        $data->third10per = $third10per;
        $data->third_received10per = $request->third_received10per ? $request->third_received10per : "0";
        $balances = $data->third10per - $data->third_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance10per = $balance;
        $data->third_paymentdate10per = $request->third_paymentdate10per ? $request->third_paymentdate10per : "-";
        $data->third_transactiontype10per = $request->third_transactiontype10per ? $request->third_transactiontype10per : "-";
        $data->third_paymenttype10per = $request->third_paymenttype10per ? $request->third_paymenttype10per : "-";
        $data->third_chequenumber10per = ($request->third_paymenttype10per == "Cheque") ? $request->third_chequenumber10per : "-";
        $data->third_neftid10per = ($request->third_paymenttype10per == "NEFT") ? $request->third_neftid10per : "-";
        $data->third_rtgsid10per = ($request->third_paymenttype10per == "RTGS") ? $request->third_rtgsid10per : "-";

        $fourth10pers = ($data->gross_amount * 10) / 100;
        $fourth10per = number_format((float)$fourth10pers, 2, '.', '');
        $data->fourth10per = $fourth10per;
        $data->fourth_received10per = $request->fourth_received10per ? $request->fourth_received10per : "0";
        $balances = $data->fourth10per - $data->fourth_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance10per = $balance;
        $data->fourth_paymentdate10per = $request->fourth_paymentdate10per ? $request->fourth_paymentdate10per : "-";
        $data->fourth_transactiontype10per = $request->fourth_transactiontype10per ? $request->fourth_transactiontype10per : "-";
        $data->fourth_paymenttype10per = $request->fourth_paymenttype10per ? $request->fourth_paymenttype10per : "-";
        $data->fourth_chequenumber10per = ($request->fourth_paymenttype10per == "Cheque") ? $request->fourth_chequenumber10per : "-";
        $data->fourth_neftid10per = ($request->fourth_paymenttype10per == "NEFT") ? $request->fourth_neftid10per : "-";
        $data->fourth_rtgsid10per = ($request->fourth_paymenttype10per == "RTGS") ? $request->fourth_rtgsid10per : "-";

        $fifth10pers = ($data->gross_amount * 5) / 100;
        $fifth10per = number_format((float)$fifth10pers, 2, '.', '');
        $data->fifth10per = $fifth10per;
        $data->fifth_received10per = $request->fifth_received10per ? $request->fifth_received10per : "0";
        $balances = $data->fifth10per - $data->fifth_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance10per = $balance;
        $data->fifth_paymentdate10per = $request->fifth_paymentdate10per ? $request->fifth_paymentdate10per : "-";
        $data->fifth_transactiontype10per = $request->fifth_transactiontype10per ? $request->fifth_transactiontype10per : "-";
        $data->fifth_paymenttype10per = $request->fifth_paymenttype10per ? $request->fifth_paymenttype10per : "-";
        $data->fifth_chequenumber10per = ($request->fifth_paymenttype10per == "Cheque") ? $request->fifth_chequenumber10per : "-";
        $data->fifth_neftid10per = ($request->fifth_paymenttype10per == "NEFT") ? $request->fifth_neftid10per : "-";
        $data->fifth_rtgsid10per = ($request->fifth_paymenttype10per == "RTGS") ? $request->fifth_rtgsid10per : "-";

        $handover10pers = ($data->gross_amount * 5) / 100;
        $handover10per = number_format((float)$handover10pers, 2, '.', '');
        $data->handover10per = $handover10per;
        $data->handover_received10per = $request->handover_received10per ? $request->handover_received10per : "0";
        $balances = $data->handover10per - $data->handover_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance10per = $balance;
        $data->handover_paymentdate10per = $request->handover_paymentdate10per ? $request->handover_paymentdate10per : "-";
        $data->handover_transactiontype10per = $request->handover_transactiontype10per ? $request->handover_transactiontype10per : "-";
        $data->handover_paymenttype10per = $request->handover_paymenttype10per ? $request->handover_paymenttype10per : "-";
        $data->handover_chequenumber10per = ($request->handover_paymenttype10per == "Cheque") ? $request->handover_chequenumber10per : "-";
        $data->handover_neftid10per = ($request->handover_paymenttype10per == "NEFT") ? $request->handover_neftid10per : "-";
        $data->handover_rtgsid10per = ($request->handover_paymenttype10per == "RTGS") ? $request->handover_rtgsid10per : "-";

        $onbook15pers = ($data->gross_amount * 15) / 100;
        $onbook15per = number_format((float)$onbook15pers, 2, '.', '');
        $data->onbook15per = $onbook15per;
        $data->onbook_received15per = $request->onbook_received15per ? $request->onbook_received15per : "0";
        $balances = $data->onbook15per - $data->onbook_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance15per = $balance;
        $data->onbook_paymentdate15per = $request->onbook_paymentdate15per ? $request->onbook_paymentdate15per : "-";
        $data->onbook_transactiontype15per = $request->onbook_transactiontype15per ? $request->onbook_transactiontype15per : "-";
        $data->onbook_paymenttype15per = $request->onbook_paymenttype15per ? $request->onbook_paymenttype15per : "-";
        $data->onbook_chequenumber15per = ($request->onbook_paymenttype15per == "Cheque") ? $request->onbook_chequenumber15per : "-";
        $data->onbook_neftid15per = ($request->onbook_paymenttype15per == "NEFT") ? $request->onbook_neftid15per : "-";
        $data->onbook_rtgsid15per = ($request->onbook_paymenttype15per == "RTGS") ? $request->onbook_rtgsid15per : "-";

        $payments15pers = ($data->gross_amount * 40) / 100;
        $payments15per = number_format((float)$payments15pers, 2, '.', '');
        $data->payments15per = $payments15per;
        $data->payments_received15per = $request->payments_received15per ? $request->payments_received15per : "0";
        $balances = $data->payments15per - $data->payments_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance15per = $balance;
        $data->payments_paymentdate15per = $request->payments_paymentdate15per ? $request->payments_paymentdate15per : "-";
        $data->payments_transactiontype15per = $request->payments_transactiontype15per ? $request->payments_transactiontype15per : "-";
        $data->payments_paymenttype15per = $request->payments_paymenttype15per ? $request->payments_paymenttype15per : "-";
        $data->payments_chequenumber15per = ($request->payments_paymenttype15per == "Cheque") ? $request->payments_chequenumber15per : "-";
        $data->payments_neftid15per = ($request->payments_paymenttype15per == "NEFT") ? $request->payments_neftid15per : "-";
        $data->payments_rtgsid15per = ($request->payments_paymenttype15per == "RTGS") ? $request->payments_rtgsid15per : "-";

        $first15pers = ($data->gross_amount * 10) / 100;
        $first15per = number_format((float)$first15pers, 2, '.', '');
        $data->first15per = $first15per;
        $data->first_received15per = $request->first_received15per ? $request->first_received15per : "0";
        $balances = $data->first15per - $data->first_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance15per = $balance;
        $data->first_paymentdate15per = $request->first_paymentdate15per ? $request->first_paymentdate15per : "-";
        $data->first_transactiontype15per = $request->first_transactiontype15per ? $request->first_transactiontype15per : "-";
        $data->first_paymenttype15per = $request->first_paymenttype15per ? $request->first_paymenttype15per : "-";
        $data->first_chequenumber15per = ($request->first_paymenttype15per == "Cheque") ? $request->first_chequenumber15per : "-";
        $data->first_neftid15per = ($request->first_paymenttype15per == "NEFT") ? $request->first_neftid15per : "-";
        $data->first_rtgsid15per = ($request->first_paymenttype15per == "RTGS") ? $request->first_rtgsid15per : "-";

        $second15pers = ($data->gross_amount * 10) / 100;
        $second15per = number_format((float)$second15pers, 2, '.', '');
        $data->second15per = $second15per;
        $data->second_received15per = $request->second_received15per ? $request->second_received15per : "0";
        $balances = $data->second15per - $data->second_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance15per = $balance;
        $data->second_paymentdate15per = $request->second_paymentdate15per ? $request->second_paymentdate15per : "-";
        $data->second_transactiontype15per = $request->second_transactiontype15per ? $request->second_transactiontype15per : "-";
        $data->second_paymenttype15per = $request->second_paymenttype15per ? $request->second_paymenttype15per : "-";
        $data->second_chequenumber15per = ($request->second_paymenttype15per == "Cheque") ? $request->second_chequenumber15per : "-";
        $data->second_neftid15per = ($request->second_paymenttype15per == "NEFT") ? $request->second_neftid15per : "-";
        $data->second_rtgsid15per = ($request->second_paymenttype15per == "RTGS") ? $request->second_rtgsid15per : "-";

        $third15pers = ($data->gross_amount * 10) / 100;
        $third15per = number_format((float)$third15pers, 2, '.', '');
        $data->third15per = $third15per;
        $data->third_received15per = $request->third_received15per ? $request->third_received15per : "0";
        $balances = $data->third15per - $data->third_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance15per = $balance;
        $data->third_paymentdate15per = $request->third_paymentdate15per ? $request->third_paymentdate15per : "-";
        $data->third_transactiontype15per = $request->third_transactiontype15per ? $request->third_transactiontype15per : "-";
        $data->third_paymenttype15per = $request->third_paymenttype15per ? $request->third_paymenttype15per : "-";
        $data->third_chequenumber15per = ($request->third_paymenttype15per == "Cheque") ? $request->third_chequenumber15per : "-";
        $data->third_neftid15per = ($request->third_paymenttype15per == "NEFT") ? $request->third_neftid15per : "-";
        $data->third_rtgsid15per = ($request->third_paymenttype15per == "RTGS") ? $request->third_rtgsid15per : "-";

        $fourth15pers = ($data->gross_amount * 5) / 100;
        $fourth15per = number_format((float)$fourth15pers, 2, '.', '');
        $data->fourth15per = $fourth15per;
        $data->fourth_received15per = $request->fourth_received15per ? $request->fourth_received15per : "0";
        $balances = $data->fourth15per - $data->fourth_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance15per = $balance;
        $data->fourth_paymentdate15per = $request->fourth_paymentdate15per ? $request->fourth_paymentdate15per : "-";
        $data->fourth_transactiontype15per = $request->fourth_transactiontype15per ? $request->fourth_transactiontype15per : "-";
        $data->fourth_paymenttype15per = $request->fourth_paymenttype15per ? $request->fourth_paymenttype15per : "-";
        $data->fourth_chequenumber15per = ($request->fourth_paymenttype15per == "Cheque") ? $request->fourth_chequenumber15per : "-";
        $data->fourth_neftid15per = ($request->fourth_paymenttype15per == "NEFT") ? $request->fourth_neftid15per : "-";
        $data->fourth_rtgsid15per = ($request->fourth_paymenttype15per == "RTGS") ? $request->fourth_rtgsid15per : "-";

        $fifth15pers = ($data->gross_amount * 5) / 100;
        $fifth15per = number_format((float)$fifth15pers, 2, '.', '');
        $data->fifth15per = $fifth15per;
        $data->fifth_received15per = $request->fifth_received15per ? $request->fifth_received15per : "0";
        $balances = $data->fifth15per - $data->fifth_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance15per = $balance;
        $data->fifth_paymentdate15per = $request->fifth_paymentdate15per ? $request->fifth_paymentdate15per : "-";
        $data->fifth_transactiontype15per = $request->fifth_transactiontype15per ? $request->fifth_transactiontype15per : "-";
        $data->fifth_paymenttype15per = $request->fifth_paymenttype15per ? $request->fifth_paymenttype15per : "-";
        $data->fifth_chequenumber15per = ($request->fifth_paymenttype15per == "Cheque") ? $request->fifth_chequenumber15per : "-";
        $data->fifth_neftid15per = ($request->fifth_paymenttype15per == "NEFT") ? $request->fifth_neftid15per : "-";
        $data->fifth_rtgsid15per = ($request->fifth_paymenttype15per == "RTGS") ? $request->fifth_rtgsid15per : "-";

        $handover15pers = ($data->gross_amount * 5) / 100;
        $handover15per = number_format((float)$handover15pers, 2, '.', '');
        $data->handover15per = $handover15per;
        $data->handover_received15per = $request->handover_received15per ? $request->handover_received15per : "0";
        $balances = $data->handover15per - $data->handover_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance15per = $balance;
        $data->handover_paymentdate15per = $request->handover_paymentdate15per ? $request->handover_paymentdate15per : "-";
        $data->handover_transactiontype15per = $request->handover_transactiontype15per ? $request->handover_transactiontype15per : "-";
        $data->handover_paymenttype15per = $request->handover_paymenttype15per ? $request->handover_paymenttype15per : "-";
        $data->handover_chequenumber15per = ($request->handover_paymenttype15per == "Cheque") ? $request->handover_chequenumber15per : "-";
        $data->handover_neftid15per = ($request->handover_paymenttype15per == "NEFT") ? $request->handover_neftid15per : "-";
        $data->handover_rtgsid15per = ($request->handover_paymenttype15per == "RTGS") ? $request->handover_rtgsid15per : "-";

        $onbook20pers = ($data->gross_amount * 20) / 100;
        $onbook20per = number_format((float)$onbook20pers, 2, '.', '');
        $data->onbook20per = $onbook20per;
        $data->onbook_received20per = $request->onbook_received20per ? $request->onbook_received20per : "0";
        $balances = $data->onbook20per - $data->onbook_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance20per = $balance;
        $data->onbook_paymentdate20per = $request->onbook_paymentdate20per ? $request->onbook_paymentdate20per : "-";
        $data->onbook_transactiontype20per = $request->onbook_transactiontype20per ? $request->onbook_transactiontype20per : "-";
        $data->onbook_paymenttype20per = $request->onbook_paymenttype20per ? $request->onbook_paymenttype20per : "-";
        $data->onbook_chequenumber20per = ($request->onbook_paymenttype20per == "Cheque") ? $request->onbook_chequenumber20per : "-";
        $data->onbook_neftid20per = ($request->onbook_paymenttype20per == "NEFT") ? $request->onbook_neftid20per : "-";
        $data->onbook_rtgsid20per = ($request->onbook_paymenttype20per == "RTGS") ? $request->onbook_rtgsid20per : "-";

        $payments20pers = ($data->gross_amount * 40) / 100;
        $payments20per = number_format((float)$payments20pers, 2, '.', '');
        $data->payments20per = $payments20per;
        $data->payments_received20per = $request->payments_received20per ? $request->payments_received20per : "0";
        $balances = $data->payments20per - $data->payments_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance20per = $balance;
        $data->payments_paymentdate20per = $request->payments_paymentdate20per ? $request->payments_paymentdate20per : "-";
        $data->payments_transactiontype20per = $request->payments_transactiontype20per ? $request->payments_transactiontype20per : "-";
        $data->payments_paymenttype20per = $request->payments_paymenttype20per ? $request->payments_paymenttype20per : "-";
        $data->payments_chequenumber20per = ($request->payments_paymenttype20per == "Cheque") ? $request->payments_chequenumber20per : "-";
        $data->payments_neftid20per = ($request->payments_paymenttype20per == "NEFT") ? $request->payments_neftid20per : "-";
        $data->payments_rtgsid20per = ($request->payments_paymenttype20per == "RTGS") ? $request->payments_rtgsid20per : "-";

        $first20pers = ($data->gross_amount * 10) / 100;
        $first20per = number_format((float)$first20pers, 2, '.', '');
        $data->first20per = $first20per;
        $data->first_received20per = $request->first_received20per ? $request->first_received20per : "0";
        $balances = $data->first20per - $data->first_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance20per = $balance;
        $data->first_paymentdate20per = $request->first_paymentdate20per ? $request->first_paymentdate20per : "-";
        $data->first_transactiontype20per = $request->first_transactiontype20per ? $request->first_transactiontype20per : "-";
        $data->first_paymenttype20per = $request->first_paymenttype20per ? $request->first_paymenttype20per : "-";
        $data->first_chequenumber20per = ($request->first_paymenttype20per == "Cheque") ? $request->first_chequenumber20per : "-";
        $data->first_neftid20per = ($request->first_paymenttype20per == "NEFT") ? $request->first_neftid20per : "-";
        $data->first_rtgsid20per = ($request->first_paymenttype20per == "RTGS") ? $request->first_rtgsid20per : "-";

        $second20pers = ($data->gross_amount * 10) / 100;
        $second20per = number_format((float)$second20pers, 2, '.', '');
        $data->second20per = $second20per;
        $data->second_received20per = $request->second_received20per ? $request->second_received20per : "0";
        $balances = $data->second20per - $data->second_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance20per = $balance;
        $data->second_paymentdate20per = $request->second_paymentdate20per ? $request->second_paymentdate20per : "-";
        $data->second_transactiontype20per = $request->second_transactiontype20per ? $request->second_transactiontype20per : "-";
        $data->second_paymenttype20per = $request->second_paymenttype20per ? $request->second_paymenttype20per : "-";
        $data->second_chequenumber20per = ($request->second_paymenttype20per == "Cheque") ? $request->second_chequenumber20per : "-";
        $data->second_neftid20per = ($request->second_paymenttype20per == "NEFT") ? $request->second_neftid20per : "-";
        $data->second_rtgsid20per = ($request->second_paymenttype20per == "RTGS") ? $request->second_rtgsid20per : "-";

        $third20pers = ($data->gross_amount * 5) / 100;
        $third20per = number_format((float)$third20pers, 2, '.', '');
        $data->third20per = $third20per;
        $data->third_received20per = $request->third_received20per ? $request->third_received20per : "0";
        $balances = $data->third20per - $data->third_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance20per = $balance;
        $data->third_paymentdate20per = $request->third_paymentdate20per ? $request->third_paymentdate20per : "-";
        $data->third_transactiontype20per = $request->third_transactiontype20per ? $request->third_transactiontype20per : "-";
        $data->third_paymenttype20per = $request->third_paymenttype20per ? $request->third_paymenttype20per : "-";
        $data->third_chequenumber20per = ($request->third_paymenttype20per == "Cheque") ? $request->third_chequenumber20per : "-";
        $data->third_neftid20per = ($request->third_paymenttype20per == "NEFT") ? $request->third_neftid20per : "-";
        $data->third_rtgsid20per = ($request->third_paymenttype20per == "RTGS") ? $request->third_rtgsid20per : "-";

        $fourth20pers = ($data->gross_amount * 5) / 100;
        $fourth20per = number_format((float)$fourth20pers, 2, '.', '');
        $data->fourth20per = $fourth20per;
        $data->fourth_received20per = $request->fourth_received20per ? $request->fourth_received20per : "0";
        $balances = $data->fourth20per - $data->fourth_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance20per = $balance;
        $data->fourth_paymentdate20per = $request->fourth_paymentdate20per ? $request->fourth_paymentdate20per : "-";
        $data->fourth_transactiontype20per = $request->fourth_transactiontype20per ? $request->fourth_transactiontype20per : "-";
        $data->fourth_paymenttype20per = $request->fourth_paymenttype20per ? $request->fourth_paymenttype20per : "-";
        $data->fourth_chequenumber20per = ($request->fourth_paymenttype20per == "Cheque") ? $request->fourth_chequenumber20per : "-";
        $data->fourth_neftid20per = ($request->fourth_paymenttype20per == "NEFT") ? $request->fourth_neftid20per : "-";
        $data->fourth_rtgsid20per = ($request->fourth_paymenttype20per == "RTGS") ? $request->fourth_rtgsid20per : "-";

        $fifth20pers = ($data->gross_amount * 5) / 100;
        $fifth20per = number_format((float)$fifth20pers, 2, '.', '');
        $data->fifth20per = $fifth20per;
        $data->fifth_received20per = $request->fifth_received20per ? $request->fifth_received20per : "0";
        $balances = $data->fifth20per - $data->fifth_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance20per = $balance;
        $data->fifth_paymentdate20per = $request->fifth_paymentdate20per ? $request->fifth_paymentdate20per : "-";
        $data->fifth_transactiontype20per = $request->fifth_transactiontype20per ? $request->fifth_transactiontype20per : "-";
        $data->fifth_paymenttype20per = $request->fifth_paymenttype20per ? $request->fifth_paymenttype20per : "-";
        $data->fifth_chequenumber20per = ($request->fifth_paymenttype20per == "Cheque") ? $request->fifth_chequenumber20per : "-";
        $data->fifth_neftid20per = ($request->fifth_paymenttype20per == "NEFT") ? $request->fifth_neftid20per : "-";
        $data->fifth_rtgsid20per = ($request->fifth_paymenttype20per == "RTGS") ? $request->fifth_rtgsid20per : "-";

        $handover20pers = ($data->gross_amount * 5) / 100;
        $handover20per = number_format((float)$handover20pers, 2, '.', '');
        $data->handover20per = $handover20per;
        $data->handover_received20per = $request->handover_received20per ? $request->handover_received20per : "0";
        $balances = $data->handover20per - $data->handover_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance20per = $balance;
        $data->handover_paymentdate20per = $request->handover_paymentdate20per ? $request->handover_paymentdate20per : "-";
        $data->handover_transactiontype20per = $request->handover_transactiontype20per ? $request->handover_transactiontype20per : "-";
        $data->handover_paymenttype20per = $request->handover_paymenttype20per ? $request->handover_paymenttype20per : "-";
        $data->handover_chequenumber20per = ($request->handover_paymenttype20per == "Cheque") ? $request->handover_chequenumber20per : "-";
        $data->handover_neftid20per = ($request->handover_paymenttype20per == "NEFT") ? $request->handover_neftid20per : "-";
        $data->handover_rtgsid20per = ($request->handover_paymenttype20per == "RTGS") ? $request->handover_rtgsid20per : "-";

        $data->addedby = $sessionadmin->username;
        $data->addmore = "0";
        $data->created_date = date('Y-m-d H:i:s');
        $data->save();
        Session::flash('message', 'Payment Details Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('payments.index', []);
    }
    public function edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Payment::where('payment_id', '=', $id)->first();
        return view('payments/edit', ['detail' => $detail]);
    }
    public function update(Request $request, $id = null)
    {

        $check = $this->validate($request, [
            'transaction_type' => ['required'],
        ]);
        $data = new Payment();
        $sessionadmin = Parent::checkadmin();
        $names = Payment::where('payment_id', $id)->first();
        $data->customer_id = $names->customer_id;
        $data->application_number = $names->application_number;
        $data->applicant_name = $names->applicant_name;
        $data->date_of_application = $names->date_of_application;
        $data->gross_amount = $names->gross_amount;
        $data->cost_id = $names->cost_id;
        $data->payment_schedule = $names->payment_schedule;
        $data->transaction_type = $request->transaction_type;
        $data->bank_type = ($request->transaction_type == "Bank") ? $request->bank_type : "-";
        $data->bank_name = ($request->bank_type == "OTHERS") ? $request->bank_name : "-";
        $data->loan_amount =  $request->loan_amount;

        $data->onbook10per = $names->onbook_balance10per;
        $data->onbook_received10per = $request->onbook_received10per ? $request->onbook_received10per : "0";
        $balances = $data->onbook10per - $data->onbook_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance10per = $balance;
        $data->onbook_paymentdate10per = $request->onbook_paymentdate10per ? $request->onbook_paymentdate10per : "-";
        $data->onbook_transactiontype10per = $request->onbook_transactiontype10per ? $request->onbook_transactiontype10per : "-";
        $data->onbook_paymenttype10per = $request->onbook_paymenttype10per ? $request->onbook_paymenttype10per : "-";
        $data->onbook_chequenumber10per = ($request->onbook_paymenttype10per == "Cheque") ? $request->onbook_chequenumber10per : "-";
        $data->onbook_neftid10per = ($request->onbook_paymenttype10per == "NEFT") ? $request->onbook_neftid10per : "-";
        $data->onbook_rtgsid10per = ($request->onbook_paymenttype10per == "RTGS") ? $request->onbook_rtgsid10per : "-";

        $data->payments10per = $names->payments_balance10per;
        $data->payments_received10per = $request->payments_received10per ? $request->payments_received10per : "0";
        $balances = $data->payments10per - $data->payments_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance10per = $balance;
        $data->payments_paymentdate10per = $request->payments_paymentdate10per ? $request->payments_paymentdate10per : "-";
        $data->payments_transactiontype10per = $request->payments_transactiontype10per ? $request->payments_transactiontype10per : "-";
        $data->payments_paymenttype10per = $request->payments_paymenttype10per ? $request->payments_paymenttype10per : "-";
        $data->payments_chequenumber10per = ($request->payments_paymenttype10per == "Cheque") ? $request->payments_chequenumber10per : "-";
        $data->payments_neftid10per = ($request->payments_paymenttype10per == "NEFT") ? $request->payments_neftid10per : "-";
        $data->payments_rtgsid10per = ($request->payments_paymenttype10per == "RTGS") ? $request->payments_rtgsid10per : "-";

        $data->first10per = $names->first_balance10per;
        $data->first_received10per = $request->first_received10per ? $request->first_received10per : "0";
        $balances = $data->first10per - $data->first_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance10per = $balance;
        $data->first_paymentdate10per = $request->first_paymentdate10per ? $request->first_paymentdate10per : "-";
        $data->first_transactiontype10per = $request->first_transactiontype10per ? $request->first_transactiontype10per : "-";
        $data->first_paymenttype10per = $request->first_paymenttype10per ? $request->first_paymenttype10per : "-";
        $data->first_chequenumber10per = ($request->first_paymenttype10per == "Cheque") ? $request->first_chequenumber10per : "-";
        $data->first_neftid10per = ($request->first_paymenttype10per == "NEFT") ? $request->first_neftid10per : "-";
        $data->first_rtgsid10per = ($request->first_paymenttype10per == "RTGS") ? $request->first_rtgsid10per : "-";

        $data->second10per = $names->second_balance10per;
        $data->second_received10per = $request->second_received10per ? $request->second_received10per : "0";
        $balances = $data->second10per - $data->second_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance10per = $balance;
        $data->second_paymentdate10per = $request->second_paymentdate10per ? $request->second_paymentdate10per : "-";
        $data->second_transactiontype10per = $request->second_transactiontype10per ? $request->second_transactiontype10per : "-";
        $data->second_paymenttype10per = $request->second_paymenttype10per ? $request->second_paymenttype10per : "-";
        $data->second_chequenumber10per = ($request->second_paymenttype10per == "Cheque") ? $request->second_chequenumber10per : "-";
        $data->second_neftid10per = ($request->second_paymenttype10per == "NEFT") ? $request->second_neftid10per : "-";
        $data->second_rtgsid10per = ($request->second_paymenttype10per == "RTGS") ? $request->second_rtgsid10per : "-";

        $data->third10per = $names->third_balance10per;
        $data->third_received10per = $request->third_received10per ? $request->third_received10per : "0";
        $balances = $data->third10per - $data->third_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance10per = $balance;
        $data->third_paymentdate10per = $request->third_paymentdate10per ? $request->third_paymentdate10per : "-";
        $data->third_transactiontype10per = $request->third_transactiontype10per ? $request->third_transactiontype10per : "-";
        $data->third_paymenttype10per = $request->third_paymenttype10per ? $request->third_paymenttype10per : "-";
        $data->third_chequenumber10per = ($request->third_paymenttype10per == "Cheque") ? $request->third_chequenumber10per : "-";
        $data->third_neftid10per = ($request->third_paymenttype10per == "NEFT") ? $request->third_neftid10per : "-";
        $data->third_rtgsid10per = ($request->third_paymenttype10per == "RTGS") ? $request->third_rtgsid10per : "-";

        $data->fourth10per = $names->fourth_balance10per;
        $data->fourth_received10per = $request->fourth_received10per ? $request->fourth_received10per : "0";
        $balances = $data->fourth10per - $data->fourth_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance10per = $balance;
        $data->fourth_paymentdate10per = $request->fourth_paymentdate10per ? $request->fourth_paymentdate10per : "-";
        $data->fourth_transactiontype10per = $request->fourth_transactiontype10per ? $request->fourth_transactiontype10per : "-";
        $data->fourth_paymenttype10per = $request->fourth_paymenttype10per ? $request->fourth_paymenttype10per : "-";
        $data->fourth_chequenumber10per = ($request->fourth_paymenttype10per == "Cheque") ? $request->fourth_chequenumber10per : "-";
        $data->fourth_neftid10per = ($request->fourth_paymenttype10per == "NEFT") ? $request->fourth_neftid10per : "-";
        $data->fourth_rtgsid10per = ($request->fourth_paymenttype10per == "RTGS") ? $request->fourth_rtgsid10per : "-";

        $data->fifth10per = $names->fifth_balance10per;
        $data->fifth_received10per = $request->fifth_received10per ? $request->fifth_received10per : "0";
        $balances = $data->fifth10per - $data->fifth_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance10per = $balance;
        $data->fifth_paymentdate10per = $request->fifth_paymentdate10per ? $request->fifth_paymentdate10per : "-";
        $data->fifth_transactiontype10per = $request->fifth_transactiontype10per ? $request->fifth_transactiontype10per : "-";
        $data->fifth_paymenttype10per = $request->fifth_paymenttype10per ? $request->fifth_paymenttype10per : "-";
        $data->fifth_chequenumber10per = ($request->fifth_paymenttype10per == "Cheque") ? $request->fifth_chequenumber10per : "-";
        $data->fifth_neftid10per = ($request->fifth_paymenttype10per == "NEFT") ? $request->fifth_neftid10per : "-";
        $data->fifth_rtgsid10per = ($request->fifth_paymenttype10per == "RTGS") ? $request->fifth_rtgsid10per : "-";

        $data->handover10per = $names->handover_balance10per;
        $data->handover_received10per = $request->handover_received10per ? $request->handover_received10per : "0";
        $balances = $data->handover10per - $data->handover_received10per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance10per = $balance;
        $data->handover_paymentdate10per = $request->handover_paymentdate10per ? $request->handover_paymentdate10per : "-";
        $data->handover_transactiontype10per = $request->handover_transactiontype10per ? $request->handover_transactiontype10per : "-";
        $data->handover_paymenttype10per = $request->handover_paymenttype10per ? $request->handover_paymenttype10per : "-";
        $data->handover_chequenumber10per = ($request->handover_paymenttype10per == "Cheque") ? $request->handover_chequenumber10per : "-";
        $data->handover_neftid10per = ($request->handover_paymenttype10per == "NEFT") ? $request->handover_neftid10per : "-";
        $data->handover_rtgsid10per = ($request->handover_paymenttype10per == "RTGS") ? $request->handover_rtgsid10per : "-";

        $data->onbook15per = $names->onbook_balance15per;
        $data->onbook_received15per = $request->onbook_received15per ? $request->onbook_received15per : "0";
        $balances = $data->onbook15per - $data->onbook_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance15per = $balance;
        $data->onbook_paymentdate15per = $request->onbook_paymentdate15per ? $request->onbook_paymentdate15per : "-";
        $data->onbook_transactiontype15per = $request->onbook_transactiontype15per ? $request->onbook_transactiontype15per : "-";
        $data->onbook_paymenttype15per = $request->onbook_paymenttype15per ? $request->onbook_paymenttype15per : "-";
        $data->onbook_chequenumber15per = ($request->onbook_paymenttype15per == "Cheque") ? $request->onbook_chequenumber15per : "-";
        $data->onbook_neftid15per = ($request->onbook_paymenttype15per == "NEFT") ? $request->onbook_neftid15per : "-";
        $data->onbook_rtgsid15per = ($request->onbook_paymenttype15per == "RTGS") ? $request->onbook_rtgsid15per : "-";

        $data->payments15per = $names->payments_balance15per;
        $data->payments_received15per = $request->payments_received15per ? $request->payments_received15per : "0";
        $balances = $data->payments15per - $data->payments_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance15per = $balance;
        $data->payments_paymentdate15per = $request->payments_paymentdate15per ? $request->payments_paymentdate15per : "-";
        $data->payments_transactiontype15per = $request->payments_transactiontype15per ? $request->payments_transactiontype15per : "-";
        $data->payments_paymenttype15per = $request->payments_paymenttype15per ? $request->payments_paymenttype15per : "-";
        $data->payments_chequenumber15per = ($request->payments_paymenttype15per == "Cheque") ? $request->payments_chequenumber15per : "-";
        $data->payments_neftid15per = ($request->payments_paymenttype15per == "NEFT") ? $request->payments_neftid15per : "-";
        $data->payments_rtgsid15per = ($request->payments_paymenttype15per == "RTGS") ? $request->payments_rtgsid15per : "-";

        $data->first15per = $names->first_balance15per;
        $data->first_received15per = $request->first_received15per ? $request->first_received15per : "0";
        $balances = $data->first15per - $data->first_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance15per = $balance;
        $data->first_paymentdate15per = $request->first_paymentdate15per ? $request->first_paymentdate15per : "-";
        $data->first_transactiontype15per = $request->first_transactiontype15per ? $request->first_transactiontype15per : "-";
        $data->first_paymenttype15per = $request->first_paymenttype15per ? $request->first_paymenttype15per : "-";
        $data->first_chequenumber15per = ($request->first_paymenttype15per == "Cheque") ? $request->first_chequenumber15per : "-";
        $data->first_neftid15per = ($request->first_paymenttype15per == "NEFT") ? $request->first_neftid15per : "-";
        $data->first_rtgsid15per = ($request->first_paymenttype15per == "RTGS") ? $request->first_rtgsid15per : "-";

        $data->second15per = $names->second_balance15per;
        $data->second_received15per = $request->second_received15per ? $request->second_received15per : "0";
        $balances = $data->second15per - $data->second_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance15per = $balance;
        $data->second_paymentdate15per = $request->second_paymentdate15per ? $request->second_paymentdate15per : "-";
        $data->second_transactiontype15per = $request->second_transactiontype15per ? $request->second_transactiontype15per : "-";
        $data->second_paymenttype15per = $request->second_paymenttype15per ? $request->second_paymenttype15per : "-";
        $data->second_chequenumber15per = ($request->second_paymenttype15per == "Cheque") ? $request->second_chequenumber15per : "-";
        $data->second_neftid15per = ($request->second_paymenttype15per == "NEFT") ? $request->second_neftid15per : "-";
        $data->second_rtgsid15per = ($request->second_paymenttype15per == "RTGS") ? $request->second_rtgsid15per : "-";

        $data->third15per = $names->third_balance15per;
        $data->third_received15per = $request->third_received15per ? $request->third_received15per : "0";
        $balances = $data->third15per - $data->third_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance15per = $balance;
        $data->third_paymentdate15per = $request->third_paymentdate15per ? $request->third_paymentdate15per : "-";
        $data->third_transactiontype15per = $request->third_transactiontype15per ? $request->third_transactiontype15per : "-";
        $data->third_paymenttype15per = $request->third_paymenttype15per ? $request->third_paymenttype15per : "-";
        $data->third_chequenumber15per = ($request->third_paymenttype15per == "Cheque") ? $request->third_chequenumber15per : "-";
        $data->third_neftid15per = ($request->third_paymenttype15per == "NEFT") ? $request->third_neftid15per : "-";
        $data->third_rtgsid15per = ($request->third_paymenttype15per == "RTGS") ? $request->third_rtgsid15per : "-";

        $data->fourth15per = $names->fourth_balance15per;
        $data->fourth_received15per = $request->fourth_received15per ? $request->fourth_received15per : "0";
        $balances = $data->fourth15per - $data->fourth_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance15per = $balance;
        $data->fourth_paymentdate15per = $request->fourth_paymentdate15per ? $request->fourth_paymentdate15per : "-";
        $data->fourth_transactiontype15per = $request->fourth_transactiontype15per ? $request->fourth_transactiontype15per : "-";
        $data->fourth_paymenttype15per = $request->fourth_paymenttype15per ? $request->fourth_paymenttype15per : "-";
        $data->fourth_chequenumber15per = ($request->fourth_paymenttype15per == "Cheque") ? $request->fourth_chequenumber15per : "-";
        $data->fourth_neftid15per = ($request->fourth_paymenttype15per == "NEFT") ? $request->fourth_neftid15per : "-";
        $data->fourth_rtgsid15per = ($request->fourth_paymenttype15per == "RTGS") ? $request->fourth_rtgsid15per : "-";

        $data->fifth15per = $names->fifth_balance15per;
        $data->fifth_received15per = $request->fifth_received15per ? $request->fifth_received15per : "0";
        $balances = $data->fifth15per - $data->fifth_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance15per = $balance;
        $data->fifth_paymentdate15per = $request->fifth_paymentdate15per ? $request->fifth_paymentdate15per : "-";
        $data->fifth_transactiontype15per = $request->fifth_transactiontype15per ? $request->fifth_transactiontype15per : "-";
        $data->fifth_paymenttype15per = $request->fifth_paymenttype15per ? $request->fifth_paymenttype15per : "-";
        $data->fifth_chequenumber15per = ($request->fifth_paymenttype15per == "Cheque") ? $request->fifth_chequenumber15per : "-";
        $data->fifth_neftid15per = ($request->fifth_paymenttype15per == "NEFT") ? $request->fifth_neftid15per : "-";
        $data->fifth_rtgsid15per = ($request->fifth_paymenttype15per == "RTGS") ? $request->fifth_rtgsid15per : "-";

        $data->handover15per = $names->handover_balance15per;
        $data->handover_received15per = $request->handover_received15per ? $request->handover_received15per : "0";
        $balances = $data->handover15per - $data->handover_received15per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance15per = $balance;
        $data->handover_paymentdate15per = $request->handover_paymentdate15per ? $request->handover_paymentdate15per : "-";
        $data->handover_transactiontype15per = $request->handover_transactiontype15per ? $request->handover_transactiontype15per : "-";
        $data->handover_paymenttype15per = $request->handover_paymenttype15per ? $request->handover_paymenttype15per : "-";
        $data->handover_chequenumber15per = ($request->handover_paymenttype15per == "Cheque") ? $request->handover_chequenumber15per : "-";
        $data->handover_neftid15per = ($request->handover_paymenttype15per == "NEFT") ? $request->handover_neftid15per : "-";
        $data->handover_rtgsid15per = ($request->handover_paymenttype15per == "RTGS") ? $request->handover_rtgsid15per : "-";

        $data->onbook20per = $names->onbook_balance20per;
        $data->onbook_received20per = $request->onbook_received20per ? $request->onbook_received20per : "0";
        $balances = $data->onbook20per - $data->onbook_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->onbook_balance20per = $balance;
        $data->onbook_paymentdate20per = $request->onbook_paymentdate20per ? $request->onbook_paymentdate20per : "-";
        $data->onbook_transactiontype20per = $request->onbook_transactiontype20per ? $request->onbook_transactiontype20per : "-";
        $data->onbook_paymenttype20per = $request->onbook_paymenttype20per ? $request->onbook_paymenttype20per : "-";
        $data->onbook_chequenumber20per = ($request->onbook_paymenttype20per == "Cheque") ? $request->onbook_chequenumber20per : "-";
        $data->onbook_neftid20per = ($request->onbook_paymenttype20per == "NEFT") ? $request->onbook_neftid20per : "-";
        $data->onbook_rtgsid20per = ($request->onbook_paymenttype20per == "RTGS") ? $request->onbook_rtgsid20per : "-";

        $data->payments20per = $names->payments_balance20per;
        $data->payments_received20per = $request->payments_received20per ? $request->payments_received20per : "0";
        $balances = $data->payments20per - $data->payments_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->payments_balance20per = $balance;
        $data->payments_paymentdate20per = $request->payments_paymentdate20per ? $request->payments_paymentdate20per : "-";
        $data->payments_transactiontype20per = $request->payments_transactiontype20per ? $request->payments_transactiontype20per : "-";
        $data->payments_paymenttype20per = $request->payments_paymenttype20per ? $request->payments_paymenttype20per : "-";
        $data->payments_chequenumber20per = ($request->payments_paymenttype20per == "Cheque") ? $request->payments_chequenumber20per : "-";
        $data->payments_neftid20per = ($request->payments_paymenttype20per == "NEFT") ? $request->payments_neftid20per : "-";
        $data->payments_rtgsid20per = ($request->payments_paymenttype20per == "RTGS") ? $request->payments_rtgsid20per : "-";

        $data->first20per = $names->first_balance20per;
        $data->first_received20per = $request->first_received20per ? $request->first_received20per : "0";
        $balances = $data->first20per - $data->first_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->first_balance20per = $balance;
        $data->first_paymentdate20per = $request->first_paymentdate20per ? $request->first_paymentdate20per : "-";
        $data->first_transactiontype20per = $request->first_transactiontype20per ? $request->first_transactiontype20per : "-";
        $data->first_paymenttype20per = $request->first_paymenttype20per ? $request->first_paymenttype20per : "-";
        $data->first_chequenumber20per = ($request->first_paymenttype20per == "Cheque") ? $request->first_chequenumber20per : "-";
        $data->first_neftid20per = ($request->first_paymenttype20per == "NEFT") ? $request->first_neftid20per : "-";
        $data->first_rtgsid20per = ($request->first_paymenttype20per == "RTGS") ? $request->first_rtgsid20per : "-";

        $data->second20per = $names->second_balance20per;
        $data->second_received20per = $request->second_received20per ? $request->second_received20per : "0";
        $balances = $data->second20per - $data->second_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->second_balance20per = $balance;
        $data->second_paymentdate20per = $request->second_paymentdate20per ? $request->second_paymentdate20per : "-";
        $data->second_transactiontype20per = $request->second_transactiontype20per ? $request->second_transactiontype20per : "-";
        $data->second_paymenttype20per = $request->second_paymenttype20per ? $request->second_paymenttype20per : "-";
        $data->second_chequenumber20per = ($request->second_paymenttype20per == "Cheque") ? $request->second_chequenumber20per : "-";
        $data->second_neftid20per = ($request->second_paymenttype20per == "NEFT") ? $request->second_neftid20per : "-";
        $data->second_rtgsid20per = ($request->second_paymenttype20per == "RTGS") ? $request->second_rtgsid20per : "-";

        $data->third20per = $names->third_balance20per;
        $data->third_received20per = $request->third_received20per ? $request->third_received20per : "0";
        $balances = $data->third20per - $data->third_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->third_balance20per = $balance;
        $data->third_paymentdate20per = $request->third_paymentdate20per ? $request->third_paymentdate20per : "-";
        $data->third_transactiontype20per = $request->third_transactiontype20per ? $request->third_transactiontype20per : "-";
        $data->third_paymenttype20per = $request->third_paymenttype20per ? $request->third_paymenttype20per : "-";
        $data->third_chequenumber20per = ($request->third_paymenttype20per == "Cheque") ? $request->third_chequenumber20per : "-";
        $data->third_neftid20per = ($request->third_paymenttype20per == "NEFT") ? $request->third_neftid20per : "-";
        $data->third_rtgsid20per = ($request->third_paymenttype20per == "RTGS") ? $request->third_rtgsid20per : "-";

        $data->fourth20per = $names->fourth_balance20per;
        $data->fourth_received20per = $request->fourth_received20per ? $request->fourth_received20per : "0";
        $balances = $data->fourth20per - $data->fourth_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fourth_balance20per = $balance;
        $data->fourth_paymentdate20per = $request->fourth_paymentdate20per ? $request->fourth_paymentdate20per : "-";
        $data->fourth_transactiontype20per = $request->fourth_transactiontype20per ? $request->fourth_transactiontype20per : "-";
        $data->fourth_paymenttype20per = $request->fourth_paymenttype20per ? $request->fourth_paymenttype20per : "-";
        $data->fourth_chequenumber20per = ($request->fourth_paymenttype20per == "Cheque") ? $request->fourth_chequenumber20per : "-";
        $data->fourth_neftid20per = ($request->fourth_paymenttype20per == "NEFT") ? $request->fourth_neftid20per : "-";
        $data->fourth_rtgsid20per = ($request->fourth_paymenttype20per == "RTGS") ? $request->fourth_rtgsid20per : "-";

        $data->fifth20per = $names->fifth_balance20per;
        $data->fifth_received20per = $request->fifth_received20per ? $request->fifth_received20per : "0";
        $balances = $data->fifth20per - $data->fifth_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->fifth_balance20per = $balance;
        $data->fifth_paymentdate20per = $request->fifth_paymentdate20per ? $request->fifth_paymentdate20per : "-";
        $data->fifth_transactiontype20per = $request->fifth_transactiontype20per ? $request->fifth_transactiontype20per : "-";
        $data->fifth_paymenttype20per = $request->fifth_paymenttype20per ? $request->fifth_paymenttype20per : "-";
        $data->fifth_chequenumber20per = ($request->fifth_paymenttype20per == "Cheque") ? $request->fifth_chequenumber20per : "-";
        $data->fifth_neftid20per = ($request->fifth_paymenttype20per == "NEFT") ? $request->fifth_neftid20per : "-";
        $data->fifth_rtgsid20per = ($request->fifth_paymenttype20per == "RTGS") ? $request->fifth_rtgsid20per : "-";

        $data->handover20per = $names->handover_balance20per;
        $data->handover_received20per = $request->handover_received20per ? $request->handover_received20per : "0";
        $balances = $data->handover20per - $data->handover_received20per;
        $balance = number_format((float)$balances, 2, '.', '');
        $data->handover_balance20per = $balance;
        $data->handover_paymentdate20per = $request->handover_paymentdate20per ? $request->handover_paymentdate20per : "-";
        $data->handover_transactiontype20per = $request->handover_transactiontype20per ? $request->handover_transactiontype20per : "-";
        $data->handover_paymenttype20per = $request->handover_paymenttype20per ? $request->handover_paymenttype20per : "-";
        $data->handover_chequenumber20per = ($request->handover_paymenttype20per == "Cheque") ? $request->handover_chequenumber20per : "-";
        $data->handover_neftid20per = ($request->handover_paymenttype20per == "NEFT") ? $request->handover_neftid20per : "-";
        $data->handover_rtgsid20per = ($request->handover_paymenttype20per == "RTGS") ? $request->handover_rtgsid20per : "-";

        $data->addedby = $sessionadmin->username;
        $data->created_date = date('Y-m-d H:i:s');
        $data->save();
        $data = Payment::where('payment_id',$id)->update(['addmore'=>1]);


        Session::flash('message', 'Payment Details Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('payments.index', []);
    }
    public function delete(Request $request, $id = null)
    {
        $payments = Payment::where('cost_id', '=', $id)->get();  
        foreach ($payments as $payment) {
            $last = $payment['payment_id'];
            $data = Payment::where('payment_id',$last)->update(['status'=>"Trash"]);
        }
        Session::flash('message', 'Deleted Sucessfully!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('payments.index', []);
    }
   
    public function map(Request $request)
    {
        if (!empty($_REQUEST['application_name'])) {
            $id = $_REQUEST['application_name'];
            $names = Customer::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control" name="applicant_name" value="' . $name->applicant_name . '"> ';
            }
            exit;
        } else  if (!empty($_REQUEST['application_date'])) {
            $id = $_REQUEST['application_date'];
            $dates = Customer::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($dates as $date) {
                echo ' <input type="text" disabled class="form-control" name="date_of_application" value="' . $date->date_of_application . '"> ';
            }
            exit;
        } else  if (!empty($_REQUEST['gross_amount'])) {
            $id = $_REQUEST['gross_amount'];
            $dates = Cost::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($dates as $date) {
                echo ' <input type="text" disabled class="form-control" id="purchase_price" name="gross_amount" value="' . $date->gross_amount . '"> ';
            }
            exit;
        }
    }

    public function view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Payment::where('customer_id', '=', $id)->where('status','Active');
       

         $detail = $detail->paginate(10);

        return view('payments/view', ['results' => $detail]);
    }
    public function invoicepdf($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        
        $pdf = PDF::loadView('payments/receiptform', ['customer_id' => $id]);
        
        $dates = Payment::where('customer_id', $id)->first();
        $file_name =  'payment_' . $dates['applicant_name'] . '_' . $dates['application_number'];
        return $pdf->download($file_name . '.pdf');
    }

    public function receiptform($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        return view('payments/receiptform', ['customer_id' => $id]);
    }
   
}