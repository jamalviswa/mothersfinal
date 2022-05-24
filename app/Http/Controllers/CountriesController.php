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
use App\Country;
class CountriesController extends Controller {

//Countries

    public function index() { 
        $sessionadmin = Parent::checkadmin();
        $result = Country::where('status', '<>', 'Trash')->orderBy('country_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];    
            $result->where(function ($query) use ($s) {
                 $query->where('country_name', 'LIKE', "%$s%");   
            });              
        } 
        $result = $result->paginate(10);
        return view('/countries/index', [
            'results' => $result
        ]);  
    }

    public function add() {
        $sessionadmin = Parent::checkadmin();
        return view('countries/add', []);
    }
    public function store(Request $request){
        $check= $this->validate($request, [
            'image'=>['required'],
            'country_code' => ['required'],
            'country_name' => ['required',Rule::unique('countries')->where(function ($query) use($request) {
                return $query->where('country_name', $request->country_name)->where('status','<>', 'Trash');
            })],
        ]);
        $data = new Country();
        $data->country_name = $request->country_name;
        $data->country_code = $request->country_code; 
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $imagename = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/files/countries/');
            $chck= $image->move($destinationPath, $imagename);          
            $data->image = $imagename;
        }   
        $data->status = "Active"; 
        $data->save();
        Session::flash('message', 'Country Details Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('countries.index', []); 
    }

    public function edit($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Country::where('country_id', '=', $id)->first();
        return view('countries/edit', ['detail' => $detail]);
    }
    public function update(Request $request, $id = null)
    {
    
        $check= $this->validate($request, [
            'country_code' => ['required'],
            
            'country_name' => ['required',Rule::unique('countries')->where(function ($query) use($request,$id) {
                         return $query->where('country_name', $request->country_name)->where('country_id','<>', $id)->where('status','<>', 'Trash');
                     })],
        ]);
        $data = Country::findOrFail($id);
        $data->country_name = $request->country_name;
        $data->country_code = $request->country_code;
       
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $imagename = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/files/countries/');
            $chck= $image->move($destinationPath, $imagename);          
            $data->image = $imagename;
        }  
       
        $data->save(); 
       
       
        Session::flash('message', 'Country Details Updated!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('countries.index', []);     
    }

    public function delete(Request $request, $id = null)
    {        
            $data = Country::findOrFail($id);
            $data->status = 'Trash';
            $data->save();
            Session::flash('message', 'Deleted Sucessfully!');
            Session::flash('alert-class', 'success');
                return \Redirect::route('countries.index', []);
        }
}
