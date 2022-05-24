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
use Redirect;
use App\Receipt;
use App\Customer;
use PDF;

class ReceiptsController extends Controller
{

    public function index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Receipt::where('status', '<>', 'Trash')
            ->orderBy('receipt_id', 'desc');
        if (!empty($_REQUEST['applicant_name'])) {
            $customer = $_REQUEST['applicant_name'];
            $result->where(function ($query) use ($customer) {
                $query->where('received', 'LIKE', "%$customer%");
            });
        }
        if (!empty($_REQUEST['application_number'])) {
            $customer = $_REQUEST['application_number'];
            $result->where(function ($query) use ($customer) {
                $query->where('application_number', 'LIKE', "%$customer%");
            });
        }

        $result = $result->paginate(10);

        return view('/receipts/index', [
            'results' => $result
        ]);
    }
    public function add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('receipts/add', []);
    }
    public function store(Request $request)
    {
        $check = $this->validate($request, [
            'receipt_date' => ['required'],
            'application_number' => ['required'],
            'final_amount' => ['required'],
        ]);
        $data = new Receipt();
        $sessionadmin = Parent::checkadmin();
        $data->receipt_no = $request->receipt_no;
        $data->receipt_date = $request->receipt_date;
        $data->customer_id = $request->application_number;
        $names = Customer::where('customer_id', $request->application_number)->first();
        $data->application_number = $names->application_number;
        $data->received = $names->applicant_name;
        $data->sum_rupees = $request->sum_rupees;
        $data->cheque_no = $request->cheque_no;
        $data->dated = $request->dated;
        $data->drawn_on = $request->drawn_on;
        $data->bank_towards = $request->bank_towards;
        $data->referred_by = $request->referred_by;
        $data->final_amount = $request->final_amount;
        $data->status = "Active";
        $data->created_date = date('Y-m-d H:i:s');
        $data->addedby = $sessionadmin->username;
        $data->save();
        Session::flash('message', 'Receipt Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('receipts.index', []);
    }

    public function map(Request $request)
    {
        if (!empty($_REQUEST['application_name'])) {
            $id = $_REQUEST['application_name'];
            $names = Customer::where('customer_id', $id)->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control"  value="' . $name->applicant_name . '"> ';
            }
            exit;
        }
    }

    public function view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Receipt::where('receipt_id', '=', $id)->first();
        return view('receipts/view', ['detail' => $detail]);
    }


    public function delete(Request $request, $id = null)
    {
        $data = Receipt::findOrFail($id);
        $data->status = 'Trash';
        $data->save();
        Session::flash('message', 'Deleted Sucessfully!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('receipts.index', []);
    }

    public function invoicepdf($id = null)
    {
       
        $sessionadmin = Parent::checkadmin();
        $pdf = PDF::loadView('receipts/receiptform', ['receipt_id' => $id]);
        //print_r($pdf);exit;
        $file_name =  'receipt_' . date('ymd') . $id;
        return $pdf->download($file_name . '.pdf');
    }

    public function receiptform($id = null)
    {
        
        $sessionadmin = Parent::checkadmin();
        return view('receipts/receiptform',['receipt_id' => $id]);   
    }
}
