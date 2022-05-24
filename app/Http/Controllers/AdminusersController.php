<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rules\Email;
use Auth;
use Session;
use Redirect;
use App\Adminuser;

class AdminusersController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $adminuser = Adminuser::where('username', $request->username)->where('status', '<>', 'Trash')->first();
            if (!empty($adminuser)) {
                if ($adminuser->password == md5($request->password)) {
                    // Session::set('User', $adminuser);
                    Session::put('Adminuser', $adminuser);
                    return Redirect::to('customers/personal/index');
                } else {
                    Session::flash('message', 'Username / Password mismatch');
                    Session::flash('alert-class', 'error');
                }
            } else {
                Session::flash('message', 'Account not found');
                Session::flash('alert-class', 'error');
            }
        }
        return view('adminusers/login');
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }
    public function profile(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        if ($request->isMethod('post')) {
            $adminuser = Adminuser::where('email', $request->email)->where('admin_id', '!=', $sessionadmin->admin_id)->first();
            if (empty($adminuser)) {
                $data['username'] = $request->username;
                $data['email'] = $request->email;
                $file = $request->file('profile');
                if (!empty($file)) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $file->move('files/admin', $fileName);
                    $data['profile'] = $fileName;
                } else {
                    $data['profile'] = $sessionadmin->profile;
                }
                Adminuser::where('admin_id', $sessionadmin->admin_id)->update($data);
                Session::flash('message', 'Profile updated!');
                Session::flash('alert-class', 'success');
                return Redirect::to('customers/personal/index');
            }
        }
        return view('adminusers/profile');
    }
    public function changepassword(Request $request)
    {
        $sessionadmin = Parent::checkadmin();
        if ($request->isMethod('post')) {
            if ($sessionadmin->password == md5($request->oldpassword)) {
                $data['password'] = md5($request->password);
                $data['password_text'] = $request->password;
                Adminuser::where('admin_id', $sessionadmin->admin_id)->update($data);
                Session::flash('message', 'Password updated!');
                Session::flash('alert-class', 'success');
                return Redirect::to('adminusers/profile');
            } else {
                Session::flash('message', 'Old password mismatch!');
                Session::flash('alert-class', 'error');
                return Redirect::to('adminusers/profile');
            }
        }
    }
    public function subadmin_index()
    {
        $sessionadmin = Parent::checkadmin();
        $result = Adminuser::where('status', '<>', 'Trash')->where('adminname','Subadmin')->orderBy('admin_id', 'desc');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $result->where(function ($query) use ($s) {
                $query->where('username', 'LIKE', "%$s%");
            });
        }
        $result = $result->paginate(10);
        return view('/adminusers/subadmin_index', [
            'results' => $result
        ]);
    }
    public function subadmin_add()
    {
        $sessionadmin = Parent::checkadmin();
        return view('adminusers/subadmin_add', []);
    }
    public function subadmin_store(Request $request)
    {
        $check = $this->validate($request, [
            'password' => ['required'],
            'adminname' => ['required'],
            'profile' => ['required'],
            'email' => [
                'required', 'email', 'regex:/^\S*$/u',
                'regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', Rule::unique('adminusers')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)->where('status', '<>', 'Trash');
                })
            ],
            'username' => ['required', Rule::unique('adminusers')->where(function ($query) use ($request) {
                return $query->where('username', $request->username)->where('status', '<>', 'Trash');
            })],
        ]);
        $data = new Adminuser();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password_text = $request->password;
        $data->password = md5($request->password);
        $data->adminname = $request->adminname;
        if (!empty($request->file('profile'))) {
            $image = $request->file('profile');
            $imagename = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/files/admin/');
            $chck = $image->move($destinationPath, $imagename);
            $data->profile = $imagename;
        }
        $data->created_date = date('Y-m-d H:i:s');
        $data->status = "Active";
        $data->save();
        Session::flash('message', 'Subadmin Details Added!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('adminusers.subadmin_index', []);
    }

    public function subadmin_view($id = null)
    {
        $sessionadmin = Parent::checkadmin();
        $detail = Adminuser::where('admin_id', '=', $id)->first();
        return view('adminusers/subadmin_view', ['detail' => $detail]);
    }

    public function subadmin_delete(Request $request, $id = null)
    {
        $data = Adminuser::findOrFail($id);
        $data->status = 'Trash';
        $data->save();
        Session::flash('message', 'Deleted Sucessfully!');
        Session::flash('alert-class', 'success');
        return \Redirect::route('adminusers.subadmin_index', []);
    }
}

    // public function dashboard() {
    //     Parent::checkadmin();
    //     return view('adminusers/dashboard');
    // }
