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
use App\Package;

class PostsController extends Controller {
    
    public function index() {       
         $sessionadmin = Parent::checkadmin();
//        $result = Package::where('status', '<>', 'Trash')
//                        ->orderBy('package_id', 'desc');
//        if (!empty($_REQUEST['s'])) {
//            $s = $_REQUEST['s'];    
//            $result->where(function ($query) use ($s) {
//                 $query->where('name', 'LIKE', "%$s%");   
//            });              
//        } 
//        if (!empty($_REQUEST['package'])) {
//            $package = $_REQUEST['package'];  
//            $result->where(function ($query) use ($package) {
//                 $query->where('package', 'LIKE', "%$package%");   
//            });              
//        } 
//        
//        $result = $result->paginate(10);
        
        return view('/posts/index', [
//            'results' => $result
        ]);      
    }
    public function add() {
         $sessionadmin = Parent::checkadmin();
        return view('posts/add', []);
    }
//     public function store(Request $request)
//    {
//         $check= $this->validate($request, [
//              'category' => ['required'],
//            'num_cards' => ['required'],
//             'price' => ['required'],
//            'name' => ['required'],
//               
//           
//            'duration' => ['required'],
//        ]);
//          $data = new Package();
//        $data->name = $request->name;
//        $data->num_cards = $request->num_cards;
//         $data->category_id = $request->category;
//         $data->price = $request->price;
//        $data->created_date = date('Y-m-d H:i:s');
//        $data->duration = $request->duration; 
//        $data->save();
//         Session::flash('message', 'Package Added!');
//                Session::flash('alert-class', 'success');
//        return \Redirect::route('packages.index', []);
//        
//    }
//     public function edit($id = null)
//    {
//        $sessionadmin = Parent::checkadmin();
//        $detail = Package::where('package_id', '=', $id)->first();
//        return view('packages/edit', ['detail' => $detail]);
//    }
//      public function update(Request $request, $id = null)
//    {
//    
//        $check= $this->validate($request, [
//            'category' => ['required'],
//            'num_cards' => ['required'],
//             'price' => ['required'],
//            'name' => ['required'],
//               
//            'duration' => ['required'],
//        ]);
//        $data = Package::findOrFail($id);
//        $data->name = $request->name;
//        $data->num_cards = $request->num_cards;
//         $data->category_id = $request->category;
//         $data->price = $request->price;
//           $data->duration = $request->duration; 
//        $data->save();
//         Session::flash('message', 'Package Updated!');
//                Session::flash('alert-class', 'success');
//        return \Redirect::route('packages.index', []);
//        
//    }
//      public function delete(Request $request, $id = null)
//    {        
//            $data = Package::findOrFail($id);
//            $data->status = 'Trash';
//            $data->save();
//            Session::flash('message', 'Deleted Sucessfully!');
//            Session::flash('alert-class', 'success');
//                return \Redirect::route('packages.index', []);
//        }
}
