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
use App\Customer;
use App\Document;
use App\Cost;
use App\Receipt;
use App\Payment;

class DeletesController extends Controller
{
    //---------------Customers Personal Details---------------//

    public function personal_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Customer::where('status', '<>', 'Active')->orderBy('customer_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('applicant_name', 'LIKE', "%$s%");
            });
        }
        if (!empty($_REQUEST['gender'])) {
            $category = $_REQUEST['gender'];
            $result->where(function ($query) use ($category) {
                $query->where('gender', 'LIKE', "%$category%");
            });
        }
        $result = $result->paginate(10);
        return view('/deletes/personal_index', [
            'results' => $result
        ]);
    }

    public function personal_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Customer::where('customer_id', '=', $id)->first();
        return view('deletes/personal_view', ['detail' => $detail]);
    }
  


    public function official_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Document::where('status', '<>', 'Active')->orderBy('document_id', 'desc');
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
        return view('/deletes/official_index', [
            'results' => $result
        ]);
    }

    public function official_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Document::where('document_id', '=', $id)->first();
        return view('deletes/official_view', ['detail' => $detail]);
    }

    public function cost_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Cost::where('status', '<>', 'Active')->orderBy('cost_id', 'desc');
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
        return view('/deletes/cost_index', [
            'results' => $result
        ]);
    }

    public function cost_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Cost::where('cost_id', '=', $id)->first();
        return view('deletes/cost_view', ['detail' => $detail]);
    }

    public function receipt_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Receipt::where('status', '<>', 'Active')
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

        return view('/deletes/receipt_index', [
            'results' => $result
        ]);
    }

    public function receipt_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Receipt::where('receipt_id', '=', $id)->first();
        return view('deletes/receipt_view', ['detail' => $detail]);
    }
    public function payment_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Payment::where('status', '<>', 'Active')->where('addmore','=','0')
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

        return view('/deletes/payment_index', [
            'results' => $result
        ]);
    }
    public function payment_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Payment::where('customer_id', '=', $id)->where('status','Trash');
       

         $detail = $detail->paginate(10);

        return view('deletes/payment_view', ['results' => $detail]);
    }
}