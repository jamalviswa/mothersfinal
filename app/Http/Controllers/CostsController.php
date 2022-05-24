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
use App\Cost;
use App\Customer;
use App\Document;
use App\Block;
use App\Flatnumber;
use App\Flattype;
use App\Floor;
use App\Payment;
use PDF;

class CostsController extends Controller
{

    public function index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Cost::where('status', '<>', 'Trash')->orderBy('cost_id', 'desc');
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
        $result = $result->paginate(10);
        return view('/costs/index', [
            'results' => $result
        ]);
    }

    public function add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('costs/add', []);
    }
    public function store(Request $request)
    {
        $check = $this->validate($request, [
            'guideline_value' => ['required'],
            'electricity_charges' => ['required'],
            'water_supply' => ['required'],
            'car_park' => ['required'],
            'amenities_charges' => ['required'],
            'maintenance' => ['required'],
            'rate_sqft' => ['required'],
            'corpus_fund' => ['required'],

        ]);
        $data = new Cost();
        $sessionadmin = Parent::checkadmin();
        $data->customer_id = $request->application_number;
        $names = Customer::where('customer_id', $request->application_number)->where('status', 'Active')->first();
        $data->application_number = $names->application_number;
        $data->applicant_name = $names->applicant_name;
        $documents = Document::where('customer_id', $request->application_number)->where('status', 'Active')->first();
        $data->document_id = $documents->document_id;
        $data->sal_area = $documents->salable_area;
        $data->uds_area = $documents->uds_area;
        $data->block = $documents->block;
        $data->flatnumber = $documents->flatnumber;
        $data->flattype = $documents->flattype;
        $data->floor = $documents->floor;
        $data->facing = $documents->facing;
        $data->rate_sqft = $request->rate_sqft;
        $salable_values = $request->rate_sqft * $documents->salable_area;
        $salable_value = number_format((float)$salable_values, 2, '.', '');
        $data->salable_value = $salable_value;
        $data->guideline_value = $request->guideline_value;
        $land_costs = $documents->uds_area * $request->guideline_value;
        $land_cost = number_format((float)$land_costs, 2, '.', '');
        $data->land_cost = $land_cost;
        $construction_costs = $salable_value - $land_cost;
        $construction_cost = number_format((float)$construction_costs, 2, '.', '');
        $data->construction_cost = $construction_cost;
        $data->electricity_charges = $request->electricity_charges;
        $data->water_supply = $request->water_supply;
        $data->car_park = $request->car_park;
        $data->amenities_charges = $request->amenities_charges;
        $data->maintenance = $request->maintenance;
        $gross_amounts = $land_cost + $construction_cost + $request->electricity_charges + $request->water_supply + $request->car_park + $request->amenities_charges + $request->maintenance;
        $gross_amount = number_format((float)$gross_amounts, 2, '.', '');
        $data->gross_amount = $gross_amount;
        $stamps = ($land_cost * 7) / 100;
        $stamp = number_format((float)$stamps, 2, '.', '');
        $data->stamp = $stamp;
        $registrations = ($land_cost * 4) / 100;
        $registration = number_format((float)$registrations, 2, '.', '');
        $data->registration = $registration;
        $constructions = (($construction_cost + $request->electricity_charges + $request->water_supply + $request->car_park + $request->amenities_charges + $request->maintenance) * 2) / 100;
        $construction = number_format((float)$constructions, 2, '.', '');
        $data->construction = $construction;
        $data->corpus_fund = $request->corpus_fund;
        $gsts = ($gross_amount * 1) / 100;
        $gst = number_format((float)$gsts, 2, '.', '');
        $data->gst = $gst;
        $totals = $gross_amount + $stamp +  $registration + $construction + $request->corpus_fund + $gst;
        $total = number_format((float)$totals, 2, '.', '');
        $data->total_amount = $total;
        $data->created_date = date('Y-m-d H:i:s');
        $data->addedby = $sessionadmin->username;
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Cost Details Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('costs.index', []);
    }

    public function edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Cost::where('cost_id', '=', $id)->first();
        return view('costs/edit', ['detail' => $detail]);
    }
    public function update(Request $request, $id = null)
    {

        $check = $this->validate($request, [
          
        ]);
        $data = Cost::findOrFail($id);
        $data->name = $request->name;
        $data->pack = $request->pack;
        $data->num_cards = $request->num_cards;
        $data->category = $request->category;
        $data->price = ($request->pack == "Premium") ? $request->price : "";
        $data->duration = $request->duration;
        $data->status = $request->status;
        $data->save();
        Session::flash('message', 'Package Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('packages.index', []);
    }

    // --------------Cost Delete---------------

    public function delete(Request $request, $id = null)
    {
        $data = Cost::findOrFail($id);
        $data->status = 'Trash';
        $data->save();
        $payments = Payment::where('cost_id', '=', $id)->get();  
        foreach ($payments as $payment) {
            $last = $payment['payment_id'];
            $data = Payment::where('payment_id',$last)->update(['status'=>"Trash"]);
        }
        Session::flash('message', 'Deleted Sucessfully!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('costs.index', []);
    }

    // --------------Cost View---------------

    public function view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Cost::where('cost_id', '=', $id)->first();
        return view('costs/view', ['detail' => $detail]);
    }

    // ----------------Ajax Function Map--------------------

    public function map(Request $request)
    {
        if (!empty($_REQUEST['application_name'])) {
            $id = $_REQUEST['application_name'];
            $names = Customer::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control"  name="applicant_name" value="' . $name->applicant_name . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['salable_area'])) {
            $id = $_REQUEST['salable_area'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control" name="sal_area" id="Text2" value="' . $name->salable_area . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['uds_area'])) {
            $id = $_REQUEST['uds_area'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control" name="uds_area" id="Text3" value="' . $name->uds_area . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['block'])) {
            $id = $_REQUEST['block'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                $block = Block::where('block_id', $name['block'])->first();
                echo '<input type="text" disabled class="form-control" name="block"  value="' . $block->block_name . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['flatnumber'])) {
            $id = $_REQUEST['flatnumber'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                $block = Flatnumber::where('flatnumber_id', $name['flatnumber'])->first();
                echo '<input type="text" disabled class="form-control" name="flatnumber"  value="' . $block->flatnumber . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['flattype'])) {
            $id = $_REQUEST['flattype'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                $block = Flattype::where('flattype_id', $name['flattype'])->first();
                echo '<input type="text" disabled class="form-control" name="flattype"  value="' . $block->flattype . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['floor'])) {
            $id = $_REQUEST['floor'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                $block = Floor::where('floor_id', $name['floor'])->first();
                echo '<input type="text" disabled class="form-control" name="floor"  value="' . $block->floor_name . '"> ';
            }
            exit;
        } else if (!empty($_REQUEST['facing'])) {
            $id = $_REQUEST['facing'];
            $names = Document::where('customer_id', $id)->where('status', 'Active')->get();
            foreach ($names as $name) {
                echo '<input type="text" disabled class="form-control" name="facing"  value="' . $name->facing . '"> ';
            }
            exit;
        }
    }
      // Cost details pdf function

      public function invoicepdf($id = null)
      {
          $sessionadmin = Parent::checkadmin();
          $pdf = PDF::loadView('costs/receiptform', ['customer_id' => $id]);
          $dates = Cost::where('customer_id', $id)->first();
          $file_name =  'cost_' . $dates['applicant_name'] . '_' . $dates['application_number'];
          return $pdf->download($file_name . '.pdf');
      }
  
      public function receiptform($id = null)
      {
          $sessionadmin = Parent::checkadmin();
          return view('costs/receiptform', ['customer_id' => $id]);
      }
}
