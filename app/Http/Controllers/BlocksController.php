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
use App\Flatnumber;
use App\Block;
use App\Flattype;
use App\Document;
use App\Customer;
use PDF;

class BlocksController extends Controller
{

  public function index()
  {
    $sessionadmin = Parent::checkadmin();
    return view('/blocks/index', []);
  }
  public function map(Request $request)
  {
    if (!empty($_REQUEST['phase'])) {
      $id = $_REQUEST['phase'];
      $blocks = Block::where('block_name', $id)->first();
      $flats = Flatnumber::where('block', $blocks['block_id'])->orderBy('flatnumber', 'asc')->get();
      foreach ($flats as $flat) {
        $flattype = Flattype::where('flattype_id', $flat['flattype'])->first();
        $document = Document::where('flatnumber', $flat['flatnumber_id'])->where('status', 'Active')->first();
        
        if (!empty($document)) {
          $url = url("/blocks/view/{$document->customer_id}");
          echo '<div class="col-md-2 j-box lab-' . $flattype->flattype . ' sales">
          <a class="j_url" href='.$url.'>
        <div class="j-numb sales">' . $flat->flatnumber . '<br>
          <span>' . $flattype->flattype . '
          </span><br>
          <span>' . $document->applicant_name . '
          </span>
        </div>
        </a>
      </div>';
        } else {
          echo '<div class="col-md-2 j-box lab-' . $flattype->flattype . '">
        <div class="j-numb">' . $flat->flatnumber . '<br>
          <span>' . $flattype->flattype . '
          </span>
        </div>
      </div>';
        }
      }
      exit;
    }
  }

  public function view($id = null)
  {
    $sessionadmin = Parent::checkadmin();
    $detail = Customer::where('customer_id', '=', $id)->first();
    return view('blocks/view', ['detail' => $detail]);
  }
  public function invoicepdf($id = null)
  {
      $sessionadmin = Parent::checkadmin();
      $pdf = PDF::loadView('blocks/receiptform', ['customer_id' => $id]);
      $dates = Customer::where('customer_id', $id)->first();
      $file_name =  'block_' . $dates['applicant_name'] . '_' . $dates['application_number'];
      return $pdf->download($file_name . '.pdf');
  }

  public function receiptform($id = null)
  {
      $sessionadmin = Parent::checkadmin();
      return view('blocks/receiptform', ['customer_id' => $id]);
  }
}
