<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Service;
use App\Emailcontent;
use App\Adminuser;
use App\Applog;
use App\Postlike;
use App\Following;
use App\Postcomment;
use App\Message;
use App\Sproviderdetail;
use App\Application;
use App\Subject;
use App\Tution_detail;
use App\Shedule;
use App\Booking;
use App\Notification;
use App\Entry_requirement;
use App\Document_list;
use App\UserApplication;
use App\ApplicationEducation;
use App\ApplicationEmployment;
use App\ApplicationRelation;
use App\ApplicationFinancial;
use App\Country;
use App\State;
use App\City;
use App\Institute;
use App\Institutecategory;
use App\DocInstitution;
use App\DocInstCountry;
use App\InstBasedDoc;
use App\Category;
use DB;
use File;
use App\Classes\Alipay;
use App\HealthService;
use App\HealthShedule;
use App\HealthBooking;
use App\ApplicationDetail;
use App\WalletSetting;
use App\Invoice;
use App\WalletHistory;
use App\Course;
define("undefined"," ");

class WebservicesController extends Controller {

    public function register(Request $request) {
        // $mail = mail("mohana.rayaz@gmail.com","My subject","sadasdasdasd");
        // echo "ASdsd";
        // $mail = Parent::sendmail("sadasdasdasd", "sdfsdfdfsdf", "admin@demofss.com", "vinga", "mohana.rayaz@gmail.com",'');        
        // print_r(error_get_last());exit;
        // dd($request);
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $applog = new Applog();
            $applog->params = $request->getContent();
            $applog->function = 'Register';
            $applog->datetime = date('Y-m-d H:i:s');
            $applog->save();
            $params = json_decode($request->getContent());
            $checkemail = User::where('status', '<>', 'Trash')->where('email', '=', $params->email)->first();
            if (empty($checkemail)) {
                if (!empty($params->mobile)) {
                    $checkmobile = User::where('status', '<>', 'Trash')->where('mobile', '=', $params->mobile)->first();
                    if (!empty($checkmobile)) {
                        $response = array('code' => '0', 'message' => 'Mobile number already exist!');
                        return response()->json($response);
                        exit;
                    }
                }
                $random = Str::random(8);
                $data = new User();
                // if(!empty($params->parent_code)) {
                //     $check_p = User::where('status', '=', 'Active')->where('token', '=', $params->parent_code)->first();
                //     if(!empty($check_p)) {
                //         $data->parent_code = !empty($params->parent_code) ? $params->parent_code : "";
                //     } else {
                //         $response = array('code' => '0','message' => 'Invalid Parent Code!');  
                //         return response()->json($response);
                //         exit;
                //     }
                // }
                $data->token = $random;
                $data->user_type = $params->user_type;
                $data->first_name = $params->first_name;
                $data->last_name = $params->last_name;
                $data->nick_name = $params->nick_name;
                $data->email = $params->email;
                $data->country = $params->country;
                $data->city = $params->city;
                $data->state = $params->state;
                $data->password = md5($params->password);
                $data->gender = $params->gender;
                $data->dob = !empty($params->dob) ? date('Y-m-d', strtotime($params->dob)) : "";
                $data->education_type = !empty($params->education_type) ? $params->education_type : "";
                $data->mobile = !empty($params->mobile) ? $params->mobile : "";
                $data->address = !empty($params->address) ? $params->address : "";
               
                $data->profile = (!empty($params->profile)) ? $this->base64_toimage($params->profile,  public_path('/files/proof/')) : "";
                
               // $data->profile = (!empty($filename)) ? $filename : "";
                $data->passport = (!empty($params->passport)) ? $params->passport : "";
                $data->student_code = !empty($params->student_code) ? $params->student_code : "";
                $data->datetime = date('Y-m-d H:i:s');
                $data->status = "Inactive";
                $data->save();
                $response = array('code' => '200', 'token' => $data->token, 'message' => 'Registered Successfully!');
                return response()->json($response);
                exit;
            } else {
                $response = array('code' => '0', 'message' => 'Email already exist!');
                return response()->json($response);
                exit;
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function parent_register(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $params = json_decode($request->getContent());
            $checkmobile = User::where('status', '<>', 'Trash')->where('mobile', '=', $params->mobile)->first();
            $checkname = User::where('status', '<>', 'Trash')->where('first_name', '=', $params->first_name)->first();
            $checkparent = User::where('status', '<>', 'Trash')->where('student_code', '=', $params->student_code)->first();
            if (empty($checkparent)) {
                if (empty($checkmobile)) {
                    if (empty($checkname)) {
                        if (!empty($params->mobile)) {
                            $checkmobile = User::where('status', '<>', 'Trash')->where('mobile', '=', $params->mobile)->first();
                            if (!empty($checkmobile)) {
                                $response = array('code' => '0', 'message' => 'Mobile number already exist!');
                                return response()->json($response);
                                exit;
                            }
                        }
                        $random = Str::random(8);
                        $data = new User();
                        $data->token = $random;
                        $data->user_type = "parent";
                        $data->first_name = $params->first_name;
                        $data->last_name = "";
                        $data->email = !empty($params->email) ? $params->email : "";
                        $data->country = !empty($params->country) ? $params->country : "";
                        $data->password = md5($params->password);
                        $data->gender = !empty($params->gender) ? $params->gender : "";
                        $data->dob = !empty($params->dob) ? date('Y-m-d', strtotime($params->dob)) : "";
                        $data->mobile = !empty($params->mobile) ? $params->mobile : "";
                        $data->address = !empty($params->address) ? $params->address : "";
                        $data->profile = (!empty($params->profile)) ? $this->base64_toimage($params->profile,  public_path('/files/proof/')) : "";
                        $data->passport = (!empty($params->passport)) ? $params->passport : "";
                        $data->student_code = !empty($params->student_code) ? $params->student_code : "";
                        // $data->city = $params->city;
                        $data->whatsapp_no = !empty($params->whatsapp_no) ? $params->whatsapp_no : "";
                        $data->line_id = !empty($params->line_id) ? $params->line_id : "";
                        $data->vchat_id = !empty($params->vchat_id) ? $params->vchat_id : "";
                        
                        $data->datetime = date('Y-m-d H:i:s');
                        $data->status = "Inactive";
                        $data->save();
                        $response = array('code' => '200', 'token' => $data->token, 'message' => 'Parent Registered Successfully!');
                        return response()->json($response);
                        exit;
                    } else {
                        $response = array('code' => '0', 'message' => 'User name already exist!');
                        return response()->json($response);
                        exit;
                    }
                } else {
                    $response = array('code' => '0', 'message' => 'Mobile already exist!');
                    return response()->json($response);
                    exit;
                }
            } else {
                $response = array('code' => '0', 'message' => 'Parent already exist for this student.');
                return response()->json($response);
                exit;
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function upload_image(Request $request) {
        extract($_REQUEST);
        try {
            $applog = new Applog();
            $applog->params = json_encode($request);
            $applog->function = 'Image Upload';
            $applog->datetime = date('Y-m-d H:i:s');
            $applog->save();

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/files/proof/');
                $request->file('profile')->move($destinationPath, $filename);
                $response = array("image_name" => $filename, "url" => asset('files/proof/' . $filename), "code" => "200", "message" => "Image uploaded successfully!");
                return response()->json($response);
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
 
    public function upload_doc(Request $request) {
        extract($_REQUEST);
        try {
            $applog = new Applog();
            $applog->params = json_encode($request);
            $applog->function = 'Document Upload';
            $applog->datetime = date('Y-m-d H:i:s');
            $applog->save();

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/files/proof/');
                $request->file('document')->move($destinationPath, $filename);
                $response = array("image_name" => $filename, "url" => asset('files/proof/' . $filename), "code" => "200", "message" => "Document uploaded successfully!");
                return response()->json($response);
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function sendOTP(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('token', $params->token)->first();
            if (!empty($user)) {
                $otp = Parent::str_rand('4', 'numeric');
                $u_params['otp'] = $otp;
                $sendsms = Parent::sendSMS($user->mobile, 'Your OTP is ' . $otp . ' - Vinga ');
                // print_r($sendsms);
                User::where('token', $params->token)
                        ->update($u_params);
                $response = array("token" => $user->token, "otp" => $otp, "mobile" => $user->mobile, "code" => "200", "message" => "OTP sent successfully!");
            }else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
     public function testsms(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
             $sendsms = Parent::sendSMS("8608541218", 'Your OTP is  - Vinga ');
               
                $response = array( "code" => "200", "message" => $sendsms);
           
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function verifyOTP(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('token', $params->token)->where('otp', $params->otp)->first();
            if (!empty($user)) {
                $u_params['isVerified'] = '1';
                // $u_params['status'] = 'Active';
                User::where('token', $params->token)
                        ->update($u_params);
                $response = array("token" => $user->token, "code" => "200", "message" => "OTP verified successfully! Wait for Admin Approval");
            } else {
                $response = array("message" => "Invalid OTP!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function change_mobile(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('token', $params->token)->first();
            if (!empty($user)) {
                $u_params['mobile'] = $params->mobile;
                User::where('token', $params->token)
                        ->update($u_params);
                $response = array("token" => $user->token, "code" => "200", "message" => "Updated successfully!");
            } else {
                $response = array("message" => "Invalid User!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function getprofile(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
           
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('token', $params->token)->first();
            $country = Country::where('id', $user->country)->first();
            // $city = City::where('id', $user->city)->first();
            if (!empty($user)) {
                $data = array(
                    'user_id' => $user->user_id,
                    'token' => $user->token,
                    'user_type' => $user->user_type,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "nick_name" => $user->nick_name,
                    "agent_code"=>!empty($user->agent_code)?$user->agent_code:"",
                    "email" => $user->email,
                    "gender" => $user->gender,
                    "dob" => $user->dob,
                    "education_type"=>$user->education_type,
                    "mobile" => $user->mobile,
                    "address" => $user->address,
                    "country" => $user->country,
                    "city" => !empty($user->city)? $user->city : "",
                    "state" => !empty($user->state)? $user->state : "",
                    "passport_no"=>!empty($user->passport_no)?$user->passport_no:"",
                    "country_code"=>!empty($country->country_code)? $country->country_code :"",
                    "mobile_no" => $user->mobile,
                    "followers" => $user->followers,
                    "profile" => !empty($user->profile) ? asset('files/proof/' . $user->profile) : "",
                    "passport" => !empty($user->passport) ? asset('files/proof/' . $user->passport) : "",
                );
              //  print_r($data);
                if ($user->user_type == "student") {
                    $parent = User::where('student_code', $params->token)->first();
                    if (!empty($parent)) {
                        $data['parent_details'] = array(
                            'user_id' => $parent->user_id,
                            'token' => $parent->token,
                            'user_type' => $parent->user_type,
                            "first_name" => $parent->first_name,
                            "last_name" => $parent->last_name,
                            "email" => $parent->email,
                            "gender" => $parent->gender,
                            "dob" => $parent->dob,
                            "mobile" => $parent->mobile,
                            "address" => $parent->address,
                            "country" => $parent->country, 
                            "followers" => $parent->followers,
                            "profile" => !empty($parent->profile) ? asset('files/proof/' . $parent->profile) : "",
                            "passport" => !empty($parent->passport) ? asset('files/proof/' . $parent->passport) : "",
                             "whatsapp_no" => $parent->whatsapp_no,
                            "line_id" => $parent->line_id,
                            "vchat_id" => $parent->vchat_id,
                        );
                    } else {
                        $data['parent_details'] = "";
                    }
                }
                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
public function update_stprofile(Request $request,$id) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $user = User::where('user_id', $id)->first();
                //print_r($user);exit;
            if (!empty($user)) {
                    $data1=array(
                        'user_type' => !empty($params->user_type)?$params->user_type : $user->user_type,
                        'first_name' => !empty($params->first_name)?$params->first_name : $user->first_name,
                        'last_name' =>!empty( $params->last_name)? $params->last_name : $user->last_name,
                        "nick_name" => !empty( $params->nick_name)? $params->nick_name : $user->nick_name,
                        'email' => !empty($params->email)? $params->email : $user->email,
                        "passport_no" => !empty($params->passport_no) ? $params->passport_no: "",
                        'mobile' => !empty($params->mobile)? $params->mobile : $user->mobile,
                        'address' =>!empty($params->address)? $params->address : $user->address,
                        "gender" => !empty($params->gender)?$params->gender : $user->gender,
                        "dob" => !empty($params->dob)?$params->dob : "$user->dob",
                        "education_type"=>!empty($params->education_type)?$params->education_type : $user->education_type,
                        "country" =>!empty($params->country)?$params->country : $user->country,
                        "city" =>!empty($params->city)?$params->city : $user->city,
                        "followers" => !empty($params->followers)? $params->followers : $user->followers,
                        "profile" => !empty($params->profile) ? $this->base64_toimage($params->profile,  public_path('/files/proof/')) : $user->profile,
                        "passport" => !empty($params->passport) ? asset('files/proof/' . $params->passport) : ""
                     );
                    User::where('user_id', $id)
                            ->update($data1);
                            $response = array("code" => "200", "message" => "Profile updated successfully!");
            }else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function services(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());

            $data = array();
            $services = Service::where('category', $params->category_id)->get();
            if (!empty($services)) {
                foreach ($services as $service) {
                    $data[] = array(
                        'service_id' => $service->service_id,
                        'name' => $service->name,
                        'image' => asset('files/services/' . $service->image),
                    );
                }

                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No Services!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function serviceproviders(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());

            $data = array();
            $sproviderdetails = User::join('sproviderdetails', 'users.user_id', '=', 'sproviderdetails.user_id')
                            ->where('users.user_type', 'Service provider')
                            ->where('users.status', '<>', 'Trash')
                            ->where('sproviderdetails.category_id', $params->category_id)
                            ->where('sproviderdetails.service_id', $params->service_id)
                            ->orderBy('users.user_id', 'desc')
                            ->select('users.*', 'sproviderdetails.*', 'users.status as status')->get();

            if (!empty($sproviderdetails)) {
                foreach ($sproviderdetails as $user) {
                    $country = Country::where('id', $user->country)->first();
                    $data[] = array(
                        'user_id' => $user->user_id,
                        'token' => $user->token,
                        'user_type' => $user->user_type,
                        "first_name" => $user->first_name,
                        "last_name" => $user->last_name,
                        "company_name" => $user->company_name,
                        "email" => $user->email,
                        "gender" => $user->gender,
                        "dob" => $user->dob,
                        "country_code"=>$country->country_code,
                        "mobile" => $user->mobile,
                        "address" => $user->address,
                        "profile" => !empty($user->profile) ? asset('files/proof/' . $user->profile) : "",
                        "idproof" => !empty($user->idproof) ? asset('files/proof/' . $user->idproof) : ""
                    );
                }
                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No Services!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function login(Request $request){
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('email', $params->email)->where('status', '<>', 'Trash')->where('user_type','student')->first();
            // print_r($user);exit;
            if (!empty($user)) {
                if ($user->isVerified == '1') {
                    if ($user->status == 'Active') {
                        if ($user->password == md5($params->password)) {
                            $response = array("token" => $user->token, "user_id" => $user->user_id, "code" => "200", "message" => "Logged in Successfully!");
                        } else {
                            $response = array("message" => "Email/password mismatch", "code" => "0");
                        }
                    } else {
                        $response = array("message" => "Your account is Inactive! Please contact Admin.", "code" => "1");
                    }
                } else {
                    $response = array("message" => "Mobile Number is not verified!", "mobile" => $user->mobile, "token" => $user->token, "code" => "2");
                }
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function parent_login(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('first_name', $params->first_name)->where('status', '<>', 'Trash')->first();
            if (!empty($user)) {
                if ($user->isVerified == '1') {
                    if ($user->status == 'Active') {
                        if ($user->password == md5($params->password)) {
                            $response = array("token" => $user->token, "user_id" => $user->user_id, "code" => "200", "message" => "Logged in Successfully!");
                        } else {
                            $response = array("message" => "User name and password mismatch", "code" => "0");
                        }
                    } else {
                        $response = array("message" => "Your account is Inactive! Please contact Admin.", "code" => "1");
                    }
                } else {
                    $response = array("message" => "Mobile Number is not verified!", "mobile" => $user->mobile, "token" => $user->token, "code" => "2");
                }
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function fb_login_validate(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            if (!empty($params->email)) {
                $user = User::where('email', $params->email)->where('status', '<>', 'Trash')->first();
            } else if (!empty($params->mobile)) {
                $user = User::where('mobile', $params->mobile)->where('status', '<>', 'Trash')->first();
            }
            if (!empty($user)) {
                if ($user->status == 'Active') {
                    if ($user->isVerified == '1') {
                        $response = array("token" => $user->token, "user_id" => $user->user_id, "code" => "200", "message" => "Logged in Successfully!");
                    } else {
                        $response = array("message" => "Mobile Number is not verified!", "mobile" => $user->mobile, "token" => $user->token, "code" => "2");
                    }
                } else {
                    $response = array("message" => "Your account is Inactive! Please contact Admin.", "code" => "1");
                }
            } else {
                $response = array("message" => "New User", "code" => "200");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function fb_login(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $random = Str::random(8);
            $data = new User();
            $data->token = $random;
            $data->user_type = $params->user_type;
            $data->first_name = $params->first_name;
            $data->last_name = $params->last_name;
            $data->email = !empty($params->email) ? $params->email : "";
            $data->nick_name = !empty($params->nick_name) ? $params->nick_name : "";
            $data->password = "";
            $data->gender = !empty($params->gender) ? $params->gender : "";
            $data->dob = !empty($params->dob) ? date('Y-m-d', strtotime($params->dob)) : "";
            $data->mobile = !empty($params->mobile) ? $params->mobile : "";
            $data->address = !empty($params->address) ? $params->address : "";
            $data->profile = (!empty($params->profile)) ? $params->profile : "";
            $data->datetime = date('Y-m-d H:i:s');
            $data->status = "Inactive";
            $data->fbid = !empty($params->fbid) ? $params->fbid : "";
            $data->save();
            $response = array('code' => '200', 'token' => $data->token, "user_id" => $data->user_id, 'message' => 'Logged in Successfully! Wait for Admin Approval');
            return response()->json($response);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function send_mail(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('email', $params->email)->first();
            if (!empty($user)) {
                $otp = Parent::str_rand('4', 'numeric');
                $u_params['otp'] = $otp;
                $u_params['isVerified'] = '1';
                // $emailcontent = Emailcontent::where('id', '2')->first();
                //   if (!empty($emailcontent)) {
                //   $message = str_replace(array('{otp}'), array($otp), $emailcontent->emailcontent);
                //    $mail = Parent::sendmail($message, $emailcontent->subject, $emailcontent->from_email, $emailcontent->from_name, $params->email,'');
                // }
                User::where('token', $user->token)
                        ->update($u_params);
                // $response = array("token" => $user->token,"email"=>$user->email, "code" => "200","message" => "OTP sent to your Mail Id!");
                $response = array("token" => $user->token, "email" => $user->email, "code" => "200", "message" => "Verfified Successfully");
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function create_post(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('token');
            // print_r($user_id);exit;
            $applog = new Applog();
            $applog->params = $request->getContent();
            $applog->function = 'Create Post';
            $applog->datetime = date('Y-m-d H:i:s');
            $applog->save();
            $params = json_decode($request->getContent());

            if (!empty($user_id)) {
                $user_details = User::where('token', $user_id)->first();
                $params = json_decode($request->getContent());
                $data = new Post();
                $data->user_id = $user_details->user_id;
                $data->post_content = (!empty($params->post_content)) ? $params->post_content : "";
                // $data->post_image = (!empty($params->post_image)) ? $params->post_image : "";
                $data->post_image = (!empty($params->post_image)) ? $this->base64_toimage($params->post_image,  public_path('/files/proof/')) : "";
                $data->status = 'Active';
                $data->created_date = date('Y-m-d H:i:s');
                $data->modified_date = date('Y-m-d H:i:s');
                $data->save();
                $response = array('code' => '200', 'message' => 'Post Created!');
            } else {
                $response = array('code' => '0', 'message' => 'User not found');
            }
            return response()->json($response);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function allposts(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('token');
            $login_user = User::where('token', $user_id)->first();
           // $params = json_decode($request->getContent());
           // print_r($params);exit;
            if (!empty($user_id)) {
                $data = array();
                $posts = Post::where('status', 'Active')->orderBy('post_id', 'desc')->get();
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        $user_details = User::where('user_id', $post->user_id)->first();
                        if(!empty($user_details)) { 
                        $checklike = Postlike::where('user_id', $user_details->user_id)->where('post_id', $post->post_id)->first();
                        $checkfollow = Following::where('user_id', $post->user_id)->where('following_id', $login_user->user_id)->first();
                        $data[] = array(
                            'post_id' => $post->post_id,
                            'user_id' => $post->user_id,
                            'first_name' => !empty($user_details->first_name) ? $user_details->first_name : "",
                            'last_name' => !empty($user_details->last_name) ? $user_details->last_name : "",
                            'profile' => !empty($user_details->profile) ? asset('files/proof/' . $user_details->profile) : "",
                            'post_content' => !empty($post->post_content) ? $post->post_content : "",
                            'post_image' => !empty($post->post_image) ? asset('files/proof/' . $post->post_image) : "",
                            'likes' => !empty($post->likes) ? $post->likes : "",
                            'comments' => !empty($post->comments) ? $post->comments : "",
                            'timeago' => Parent::ago(strtotime($post->created_date)),
                            'created_date' => date('d-m-Y h:i', strtotime($post->created_date)),
                            'modified_date' => date('d-m-Y h:i', strtotime($post->modified_date)),
                            'status' => $post->status,
                            'liked' => (!empty($checklike)) ? true : false,
                            'following' => (!empty($checkfollow)) ? true : false
                        );
                        }
                    }

                    $response = array("data" => $data, "code" => "200");
                } else {
                    $response = array("message" => "No Post", "code" => "0");
                }
            } else {
                $response = array('code' => '0', 'message' => 'User not found');
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function myposts(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('token');
            $params = json_decode($request->getContent());
            $user_details = User::where('token', $user_id)->first();
            if (!empty($user_details)) {
                $data = array();
                $posts = Post::where('status', 'Active')->where('user_id', $user_details->user_id)->orderBy('post_id', 'desc')->get();
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        $checklike = Postlike::where('user_id', $user_details->user_id)->where('post_id', $post->post_id)->first();
                        $data[] = array(
                            'post_id' => $post->post_id,
                            'user_id' => $post->user_id,
                            'first_name' => !empty($user_details->first_name) ? $user_details->first_name : "",
                            'last_name' => !empty($user_details->last_name) ? $user_details->last_name : "",
                            'profile' => !empty($user_details->profile) ? asset('files/proof/' . $user_details->profile) : "",
                            'post_content' => !empty($post->post_content) ? $post->post_content : "",
                            'post_image' => !empty($post->post_image) ? asset('files/proof/' . $post->post_image) : "",
                            'likes' => !empty($post->likes) ? $post->likes : "",
                            'comments' => !empty($post->comments) ? $post->comments : "",
                            'timeago' => Parent::ago(strtotime($post->created_date)),
                            'created_date' => date('d-m-Y h:i', strtotime($post->created_date)),
                            'modified_date' => date('d-m-Y h:i', strtotime($post->modified_date)),
                            'status' => $post->status,
                            'liked' => (!empty($checklike)) ? true : false,
                        );
                    }

                    $response = array("data" => $data, "code" => "200");
                } else {
                    $response = array("message" => "No Post", "code" => "0");
                }
            } else {
                $response = array('code' => '0', 'message' => 'User not found');
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function likePost(Request $request, $id = NULL){
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $check = Postlike::where('post_id', $id)->where('user_id', $user_id)->first();
            if (empty($check)) {
                $data = new Postlike();
                $data->user_id = $user_id;
                $data->post_id = $id;
                $data->created_date = date('Y-m-d H:i:s');
                $data->save();
                Post::where('post_id', $id)
                        ->update([
                            'likes' => DB::raw('likes+1')
                ]);
                // $user = Socialpost::find($id);
                // if ($user->user_id != $user_id) {
                //     $this->postNotification(array('action' => 'like', 'node_id' => $id, 'to_userid' => $user->user_id, 'from_userid' => $user_id));
                // }
            } else {
                $check->delete();
                Post::where('post_id', $id)
                        ->update([
                            'likes' => DB::raw('likes-1')
                ]);
            }
            $response = array('code' => '200', 'message' => 'Updated');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function newComment(Request $request, $id) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $params = json_decode($request->getContent());
            $data = new Postcomment();
            $data->comment = $params->comment;
            $data->post_id = $id;
            $data->user_id = $user_id;
            $data->created_date = date('Y-m-d H:i:s');
            $data->save();
            Post::where('post_id', $id)
                    ->update(array('comments' => DB::raw('`comments` + 1')));

            // $user = Post::find($id);
            // if ($user->user_id != $user_id) {
            //     $this->postNotification(array('action' => (!empty($parent_id)) ? 'reply' : 'comment', 'node_id' => $id, 'to_userid' => $user->user_id, 'from_userid' => $user_id));
            // }

            $response = array('code' => '200', 'message' => 'Comment created');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function updateComment(Request $request, $id) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $params = json_decode($request->getContent());
            $data = Postcomment::find($id);
            $data->comment = $params->comment;
            $data->created_date = date('Y-m-d H:i:s');
            $data->save();
            $response = array('code' => '200', 'message' => 'Comment updated');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function deletecomment($id = NULL) {
        extract($_REQUEST);
        try {
            $data = new Socialcommentlike();
            $comment = Postcomment::where('comment_id', $id)->first();
            Post::where('post_id', $comment->post_id)
                    ->update(array('comments' => DB::raw('`comments` - 1')));
            Postcomment::where('comment_id', $id)->delete();
            $response = array('code' => '200', 'message' => 'Comment deleted');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function comments(Request $request, $id) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $post = Post::where('post_id', $id)->first();
            $checklike = Postlike::where('user_id', $user_id)->where('post_id', $id)->first();
            $post_user = User::where('user_id', $post->user_id)->first();



            $i = 0;
            $data = array(
                'first_name' => $post_user->first_name,
                'last_name' => $post_user->last_name,
                'profile' => !empty($post_user->profile) ? asset('files/proof/' . $post_user->profile) : "",
                'post_id' => $post->post_id,
                'post_content' => !empty($post->post_content) ? $post->post_content : "",
                'post_image' => !empty($post->post_image) ? asset('files/proof/' . $post->post_image) : "",
                'time' => $post->created_date,
                'totalcomments' => $post->comments,
                'totallikes' => $post->likes,
                'edit_delete' => ($post->user_id == $user_id) ? true : false,
                'liked' => (!empty($checklike)) ? true : false,
                'timeago' => Parent::ago(strtotime($post->created_date)),
                'post_day' => date('D', strtotime($post->created_date)),
                'post_time' => date('h:i a', strtotime($post->created_date))
            );
            $postcomments = Postcomment::where('post_id', $id)->orderBy('created_date', 'desc')->get();
            $comments = array();
            $i = 0;
            foreach ($postcomments as $postcomment) {
                $user_detail = User::where('user_id', $postcomment->user_id)->first();
                $comments[$i] = array(
                    'first_name' => $user_detail->first_name,
                    'last_name' => $user_detail->last_name,
                    'profile' => !empty($user_detail->profile) ? asset('files/proof/' . $user_detail->profile) : "",
                    'gender' => $user_detail->gender,
                    'comment_id' => $postcomment->comment_id,
                    'comment' => $postcomment->comment,
                    'edit_delete' => ($postcomment->user_id == $user_id) ? true : false,
                    'timeago' => Parent::comments_ago(strtotime($postcomment->created_date)),
                    'comment_day' => date('D', strtotime($postcomment->created_date)),
                    'comment_time' => date('h:i a', strtotime($postcomment->created_date))
                );
                $i++;
            }
            $data['comments'] = $comments;
            $response = array('code' => '200', 'data' => $data);
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function follow(Request $request, $id = NULL) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $check = Following::where('user_id', $id)->where('following_id', $user_id)->first();
            if (empty($check)) {
                $data = new Following();
                $data->following_id = $user_id;
                $data->user_id = $id;
                $data->created_date = date('Y-m-d H:i:s');
                $data->save();
                User::where('user_id', $id)
                        ->update([
                            'followers' => DB::raw('followers+1')
                ]);
                // $user = Socialpost::find($id);
                // if ($user->user_id != $user_id) {
                //     $this->postNotification(array('action' => 'like', 'node_id' => $id, 'to_userid' => $user->user_id, 'from_userid' => $user_id));
                // }
            } else {
                $check->delete();
                User::where('user_id', $id)
                        ->update([
                            'followers' => DB::raw('followers-1')
                ]);
            }
            $response = array('code' => '200', 'message' => 'Updated');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function sendMessage(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $params = json_decode($request->getContent());
            $data = new Message();
            $data->from_id = $user_id;
            $data->to_id = $params->to_id;
            $data->message_type = $params->message_type;
            $data->message = (!empty($params->message)) ? $params->message : "";
            $data->attach = (!empty($params->attach)) ? $params->attach : "";
            $data->created_date = date('Y-m-d H:i:s');
            $data->save();
            //  $this->postNotification(array('action' => 'message', 'node_id' => $user_id, 'to_userid' => $params->to_id, 'from_userid' => $user_id));

            $response = array('code' => '200', 'message' => 'Success');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function messages(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $date = date('Y-m-d', strtotime("-7 days"));
            $messages = DB::select('select T1.user2_id, max(cdate) messageId from
       (select to_id user2_id, max(message_id) cdate
       from `messages` 
       where messages.from_id=' . $user_id . ' AND DATE(`created_date`) >= "' . $date . '" AND (FIND_IN_SET(' . $user_id . ',`delete`) = 0 OR `delete` IS NULL)
       group by to_id
       union distinct
       (select  from_id user2_id, max(message_id) cdate
       from messages  where to_id = ' . $user_id . ' AND DATE(`created_date`) >= "' . $date . '" AND (FIND_IN_SET(' . $user_id . ',`delete`) = 0 OR `delete` IS NULL)
       group by from_id)) T1
       inner join `users` on (users.user_id = T1.user2_id)
       group by T1.user2_id
       order by messageId desc');
            $data = array();
            foreach ($messages as $message) {
                $user = User::where('user_id', $message->user2_id)->first();
                $msg = Message::where('message_id', $message->messageId)->first();
                $msgcount = Message::where('to_id', $user_id)->where('from_id', $message->user2_id)->where('read', '0')->count();
                $data[] = array(
                    'user_id' => $user->user_id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'nick_name' => !empty($user->nick_name) ? $user->nick_name : "",
                    'gender' => $user->gender,
                    'message_type' => $msg->message_type,
                    'profile' => !empty($user->profile) ? (($user->user_id != '1') ? asset('files/proof/' . $user->profile) : asset('files/admin/' . $user->profile)) : "",
                    'message' => (!empty($msg->message)) ? $msg->message : 'an attachment from' . $user->full_name,
                    'count' => $msgcount,
                    'date' => $this->get_day_name(strtotime($msg->created_date)),
                    'time' => date('h:i A', strtotime($msg->created_date)),
                );
            }
            $response = array('code' => '200', 'data' => $data);
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function userMessages(Request $request, $id) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $user = User::where('user_id', $id)->first();
            // $checkblock = Blockeduser::where('blocked_by', $user_id)->where('user_id', $id)->first();
            // $checkblock_2 = Blockeduser::where('blocked_by', $id)->where('user_id', $user_id)->first();
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $date = date('d-m-Y', strtotime("-7 days"));
            $messages = Message::whereRaw('DATE(created_date) > ' . '"' . $date . '"')->where(function ($query) use($user_id) {
                        $query->whereRaw('FIND_IN_SET(' . $user_id . ',`delete`) = 0')->orWhereNull('delete');
                    })->where(function ($query) use($user_id, $id) {
                        $query->where(function ($query) use($user_id, $id) {
                            $query->where('from_id', '=', $user_id)
                                    ->where('to_id', '=', $id);
                        })->orWhere(function ($query) use ($user_id, $id) {
                            $query->where('from_id', '=', $id)
                                    ->Where('to_id', '=', $user_id);
                        });
                    })->get();

            $data[] = array(
                'user_id' => $user->user_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'gender' => $user->gender,
                'profile' => !empty($user->profile) ? (($user->user_id != '1') ? asset('files/proof/' . $user->profile) : asset('files/admin/' . $user->profile)) : "",
                    // 'blocked' => (!empty($checkblock) || !empty($checkblock_2)) ? "1" : "0",
                    // 'unblock' => (!empty($checkblock)) ? "1" : "0",
            );
            $msgs = array();
            foreach ($messages as $message) {
                $from_id_details = User::where('user_id', $message->from_id)->first();
                $to_id_details = User::where('user_id', $message->to_id)->first();
                $msgs[] = array(
                    'message_id' => $message->message_id,
                    'from_id' => $message->from_id,
                    'to_id' => $message->to_id,
                    'from_id_profile' => !empty($from_id_details->profile) ? (($from_id_details->user_id != '1') ? asset('files/proof/' . $from_id_details->profile) : asset('files/admin/' . $from_id_details->profile)) : "",
                    'to_id_profile' => !empty($to_id_details->profile) ? (($to_id_details->user_id != '1') ? asset('files/proof/' . $to_id_details->profile) : asset('files/admin/' . $to_id_details->profile)) : "",
                    'message_type' => $message->message_type,
                    'message' => (!empty($message->message)) ? $message->message : '',
                    'attach' => (!empty($message->attach)) ? asset('files/proof/' . $message->attach) : "",
                    // 'date' => $this->get_day_name(strtotime($message->created_date)),
                    'time' => date('h:i A', strtotime($message->created_date)),
                    'read' => $message->read,
                );
            }
            $data['messages'] = $msgs;
            $update_read = Message::where('to_id', $user_id)->where('from_id', $id)->update(['read' => '1']);
            $response = array('code' => '200', 'data' => $data);
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function forgotPW(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('mobile', $params->mobile)->first();
            if (!empty($user)) {
                $random_pwd = Str::random(8);
                $md5_pwd = md5($random_pwd);

                $u_params['password'] = $md5_pwd;
                $sendsms = Parent::sendSMS($user->mobile, 'Hi, here is your random password for login: ' . $random_pwd . ' - Vinga ');
                User::where('mobile', $params->mobile)
                        ->update($u_params);
                $response = array("token" => $user->token, "mobile" => $user->mobile, "code" => "200", "message" => "Password sent successfully!");
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function changePW(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            // $wp_hasher = new PasswordHash(8, TRUE);
            $user = User::where('token', $params->token)->first();
            if (!empty($user)) {
                if ($user->password == md5($params->old_password)) {
                    $md5_pwd = md5($params->password);
                    $u_params['password'] = $md5_pwd;
                    User::where('token', $params->token)
                            ->update($u_params);
                    $response = array("code" => "200", "message" => "Password updated successfully!");
                } else {
                    $response = array("message" => "Old password mismatch!", "code" => "0");
                }
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function institute_categories(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $data = array();
            if(!empty($_REQUEST['s'])){
                $s=$_REQUEST['s'];
               $cats = Institutecategory::leftjoin("courses",\DB::raw("FIND_IN_SET(courses.category_id,institutecategories.id)"),">",\DB::raw("'0'"))
                                        ->where('institutecategories.status', 'Active') 
                                        ->select("institutecategories.*",'institutecategories.id as cat_id')
                                        ->groupBy('courses.category_id')
                                        ->where(function ($q) use ($s) {
                                         $q->Orwhere('institutecategories.name','LIKE',"%$s%")
                                         ->Orwhere('courses.course_name','LIKE',"%$s%");
                                         
                                         })->get(); 
          
            }else{
               $cats = Institutecategory::where('status', 'Active')->select("institutecategories.*",'institutecategories.id as cat_id')->get();
            }
            
            if (!empty($cats)) {
                foreach ($cats as $cat) {
                    $data[] = array(
                        'id' => $cat->cat_id,
                        'name' => $cat->name,
                        'cover_image'=>(!empty($cat->cover_image)) ? asset('files/institutes/' . $cat->cover_image) : "",
                    );
                }

                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No categories!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function institutes(Request $request, $id) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $data = array();
            if(!empty($_REQUEST['s'])){
                $s=$_REQUEST['s'];
               $institutes = Institute::leftjoin("courses",\DB::raw("FIND_IN_SET(courses.id,institutes.course_id)"),">",\DB::raw("'0'"))
                                      ->where('institutes.status', 'Active')->where('institutes.category', $id)
                                      ->select("institutes.*",'institutes.id as institute_id')
                                      ->groupBy('institutes.id')
                                      ->where(function ($q) use ($s) {
                                         $q->Orwhere('institute_name','LIKE',"%$s%")
                                           ->Orwhere('courses.course_name','LIKE',"%$s%")
                                           ->Orwhere('location','LIKE',"%$s%");
                                         })->get(); 
            }else{
               $institutes = Institute::where('status', 'Active')->where('category', $id)->select("institutes.*",'institutes.id as institute_id')->get(); 
            }
            
            if (!empty($institutes)) {
                foreach ($institutes as $institute) {
                     $courses=array();
                if(!empty($institute->course_id)){
                     foreach(explode(',',$institute->course_id) as $course){
                         $ins= Course::where('id','=',$course)->where('status','=','Active')->first();
                         if(!empty($ins)){
                             $courses[]=array(
                                "course_id"=>$ins->id, 
                                "course_name"=>$ins->course_name
                                 );
                         }
                     }
                }
                    $cat = Institutecategory::where('status', 'Active')->where('id', $institute->category)->first();
                    $data[] = array(
                        'institute_id' => $institute->institute_id,
                        'category' => $cat->name,
                        'courses'=>$courses,
                        'institute_name' => $institute->institute_name,
                        'institute_logo' => !empty($institute->institute_logo) ? asset('files/institutes/' . $institute->institute_logo) : "",
                        'image' => !empty($institute->image) ? asset('files/institutes/' . $institute->image) : "",
                        'description' => $institute->description,
                        'location' => $institute->location,
                        'application_fee' => $institute->application_fee,
                        'application_form' => !empty($institute->application_form) ? asset('files/forms/' . $institute->application_form) : "",
                        
                    );
                }

                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No institutes!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function institute_detail(Request $request, $id) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $user = User::where('user_id', $id)->first();
            $params = json_decode($request->getContent());
            $data = array();
            
            $institute = Institute::where('status', 'Active')->where('id', $id)->first();
            if (!empty($institute)) {
                 $cat = Institutecategory::where('status', 'Active')->where('id', $institute->category)->first();
                 $find_payment = Application::where('user_id', $user_id)->where('institute_id', $id)->first();
                 $application=array();
                 if(!empty($find_payment)){
                 $application=ApplicationDetail::where('application_id',$find_payment->application_id)->get();
                 }
                 $online_form = UserApplication::where('userId', $user_id)->where('inst_id',$id)->first();
                //  $country = Country::where('status', 'Active')->get(); //print_r($country);exit;
                $courses=array();
                if(!empty($institute->course_id)){
                     foreach(explode(',',$institute->course_id) as $course){
                         $ins= Course::where('id','=',$course)->where('status','=','Active')->first();
                         if(!empty($ins)){
                             $courses[]=array(
                                "course_id"=>$ins->id, 
                                "course_name"=>$ins->course_name
                                 );
                         }
                     }
                }
               $data['details'][] = array(
                    'institute_id' => $institute->id,
                    'category' => $cat->name,
                    "courses"=>$courses,
                    'institute_name' => $institute->institute_name,
                    'institute_logo' => !empty($institute->institute_logo) ? asset('files/institutes/' . $institute->institute_logo) : "",
                    'image' => !empty($institute->image) ? asset('files/institutes/' . $institute->image) : "",
                    'description' => $institute->description,
                    'location' => $institute->location,
                    'application_fee' => $institute->application_fee,
                    'application_form' => !empty($institute->application_form) ? asset('files/forms/' . $institute->application_form) : "",
                    'fee_structure' => !empty($institute->fee_structure) ? asset('files/forms/' . $institute->fee_structure) : "",
                    'broucher_form' => !empty($institute->brochure_form) ? asset('files/forms/' . $institute->brochure_form) : "",
                    'program_fee' => !empty($institute->program_fee) ? $institute->program_fee : "",
                    'commencement_date' => !empty($institute->commencement_date) ?$institute->commencement_date : "",
                    'application_id' => !empty($find_payment) ? $find_payment->application_id : "" ,
                    'application_status' => !empty($find_payment) ? $find_payment->status : "" ,
                    'application_payment_status' => !empty($find_payment) ? $find_payment->payment_status : "",
                    'agent_fee_status' => !empty($find_payment) ? $find_payment->agent_fee_status : "" ,
                    'program_feepayment_status' => !empty($find_payment) ? $find_payment->program_fee_status : "" ,
                    'upload_documents' => !empty($application) ? "submitted" : "" ,
                    'online_application_form' => !empty($online_form) ? "submitted" : "" ,
                 );
                 
                  $docs = Entry_requirement::where('status', 'Active')->where('institute_id', $id)->get();
                  if(!empty($docs)){
                    foreach($docs as $doc){
                      $data['entry_requirements'][]=array(
                      'name'=>$doc->requirements
                      );
                  }
                 $docs = Document_list::where('status', 'Active')->where('institute_id', $id)->get();
                 foreach($docs as $doc){
                      $data['document_list'][]=array(
                      'file_name'=>$doc->documents
                      );
                  }
                  

          
           }
                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No institutes!", "code" => "0");
            }
            return response()->json($response);
        } 
        catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
     public function countries(Request $request) {
        extract($_REQUEST);
        try {
            $country = Country::where('status', 'Active')->orderBy('order_data', 'DESC')->get();
            foreach($country as $con){
                $data[]=array(
                    "country_name"=>$con->country,
                    "value"=>$con->id,
                    "label"=>$con->country
                    );
            }
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function states(Request $request) {
        extract($_REQUEST);
        try {
            if(!empty($_REQUEST['s'])){
                $states = State::where('country_id', $_REQUEST['s'])->get();
                foreach($states as $state){
                    $data[]=array(
                        "country_id"=>$state->country_id,
                        "state_id"=>$state->id,
                        "state_name"=>$state->name,
                        "value"=>$state->id,
                        "label"=>$state->name
                        );
                }
            }else{
               $states = State::get();
                foreach($states as $state){
                    $data[]=array(
                        "country_id"=>$state->country_id,
                        "state_id"=>$state->id,
                        "state_name"=>$state->name,
                        "value"=>$state->id,
                        "label"=>$state->name
                        );
                } 
            }
            
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function cities(Request $request) {
        extract($_REQUEST);
        try {
            if(!empty($_REQUEST['s'])){
                $cities = City::where('state_id', $_REQUEST['s'])->get();
                foreach($cities as $city){
                    $data[]=array(
                        "state_id"=>$city->state_id,
                        "city_id"=>$city->id,
                        "city_name"=>$city->name,
                        "value"=>$city->id,
                        "label"=>$city->name
                        );
                }
            }else{
               $cities = City::get();
                foreach($cities as $city){
                    $data[]=array(
                        "state_id"=>$city->state_id,
                        "city_id"=>$city->id,
                        "city_name"=>$city->name,
                        "value"=>$city->id,
                        "label"=>$city->name
                        );
                }
            }
            
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function search(Request $request) {
        extract($_REQUEST);
        try {
            $services = Service::where('category', $type)->where('name', 'LIKE', "%$s%")->where('status', '<>', 'Trash')->orderBy('service_id', 'desc')->get();
            $data = array();
            foreach ($services as $service) {
                $data[] = array(
                    'service_id' => $service->service_id,
                    'name' => $service->name,
                    'image' => asset('files/services/' . $service->image),
                );
            }
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function upload_application(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $applog = new Applog();
            $applog->params = $request->getContent();
            $applog->function = 'Upload application form';
            $applog->datetime = date('Y-m-d H:i:s');
            $applog->save();
            $params = json_decode($request->getContent());

            if (!empty($user_id)) {
                $user_details = User::where('user_id', $user_id)->first();
                $params = json_decode($request->getContent());
                
                foreach($params->documents as $param){
                $data = new Application();
                $data->user_id = $user_id;
                $data->institute_id = $params->institute_id;
                $data = new ApplicationDetail();
                $data->application_id = $lastid;
                $data->document_name = $docs->document_name;
                $data->form = !empty($docs->document)? $this->base64_toimage($docs->document,  public_path('/files/forms/')) : "";
                $data->save();
                $data->payment_status = $params->payment_status;
                $data->status = 'Pending';
                $data->created_date = date('Y-m-d H:i:s');
                $data->save();
                }
                $response = array('code' => '200', 'message' => 'Upload successfully!');
            } else {
                $response = array('code' => '0', 'message' => 'User not found');
            }
            return response()->json($response);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    

    public function application_list(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('user-id');
            $appls = Application::where('user_id', $user_id)->where('status', '<>', 'Trash')->orderBy('application_id', 'desc')->get();
            $data = array();
            foreach ($appls as $appl) {
                $institute = Institute::where('status', 'Active')->where('id', $appl->institute_id)->first();
                $data[] = array(
                    'application_id' => $appl->application_id,
                    'institute_id' => $appl->institute_id,
                    'institute_name' => $institute->institute_name,
                    'institute_logo' => !empty($institute->institute_logo) ? asset('files/institutes/' . $institute->institute_logo) : "",
                    'image' => !empty($institute->image) ? asset('files/institutes/' . $institute->image) : "",
                    'application' => asset('files/proof/' . $appl->application),
                    'status' => $appl->status,
                    'creaed_date' => date('d-m-Y H:i:s', strtotime($appl->creaed_date)),
                );
            }
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    // public function postNotification($args) {
    //     $user = Member::find($args['to_userid']);
    //     $data = new Usernotification();
    //     $data->from_userid = $args['from_userid'];
    //     $data->to_userid = $args['to_userid'];
    //     $data->action = $args['action'];
    //     $data->node_id = $args['node_id'];
    //     $data->created_date = date('Y-m-d H:i:s');
    //     $data->save();
    //     $notification = $this->getNotification($data->notification_id);
    //     $msg = array('message' => $notification->message, 'node_id' => $notification->node_id, 'action' => $notification->action);
    //     if ($notification->action == 'match') {
    //         $frm = Member::find($notification->from_userid);
    //         $msg['name'] = $frm->full_name;
    //         $msg['gender'] = $frm->gender;
    //         $msg['profile'] = (!empty($frm->imgname)) ? 'https://staging.loveexpress.com.sg/wp-content/uploads/picture_member/' . $frm->imgname : "";
    //     }
    //     $this->send_push_notification($user->fcmid, $msg);
    //     Usernotification::where('notification_id', $data->notification_id)->update(array('message' => $notification->message));
    //     return true;
    // }


    public function alipay_amount(Request $request,$id=NULL) {
        extract($_REQUEST);
        try { 
        $params = json_decode($request->getContent());
        $user=User::where('user_id', $id)->first();
          $amount=$params->amount;
        $user_amount=$user->wallet_amount;
        $wallet=WalletSetting::where('id', "2")->first();
        $coin_value=$wallet->value;
        $coins=$coin_value*$amount;
        // print_r($user_amount);exit;
        $total= $amount + $user_amount;
        // print_r($total);exit;
        $coin_value=$coin_value*$total;
        $data=array(
            "wallet_amount"=>$total,
            "coins"=>$coin_value
            ); 
        User::where('user_id', $id)
                            ->update($data);
             $data = new Notification();
             $data->to_id = "1";
             $data->from_id = $id;
             $data->subject = "topup";
             $data->label = "wallet amount updated";
             $data->save();
               $user=User::where('user_id', "1")->first();
               $sender=User::where('user_id', $id)->first();
               $fcmid[] = $user['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'Admin', 'from_id' => $id, 'name' => 'Vinga Admin', 'to_id' => "1", 'message' => $sender['first_name'].' '.$sender['first_name'].' had Top up the Wallet' , 'notify_from' => 'Package', 'id' => "1"));
               $this->send_push_notification($fcmid, $message);
             $data = new Notification();
             $data->to_id = $id;
             $data->from_id = "1";
              $data->subject = "topup";
             $data->label = "Your wallet amount updated";
             $data->save();
             $user=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user['first_name'].' '.$user['first_name'] , 'to_id' => $id, 'message' => "Your wallet has been updated!" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
             $data = new WalletHistory();
             $data->user_id = $id;
             $data->amount = $params->amount;
             $data->coins = $coins;
             $data->action = "top_up";
             $data->save();
                  return json_encode(array("code" => 200, "message" => "Wallet amount Updated"));          
        }catch(Exception $e) { 
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
     public function alipay(Request $request) {
        extract($_REQUEST);
        try { 
        $params = json_decode($request->getContent());
        $sale_id = rand(100,100000);
        $amount = $_REQUEST['amount'];
        $description = $_REQUEST['description'];
        $uuid = $this->uuid();
        // print_r($description);exit;
// Associate the sale id with uuid in your database for a look up once Alipay
// pings your notify_url
        $return_url = url('/') . "/webservices/alipay_return?sale_id=$sale_id";
        $notify_url = url('/') . "/webservices/alipay_notify?id=$uuid";
// print_r($return_url);exit;
        $alipay = new Alipay();
// Generates a one-time URL to redirect the Buyer to
        $approve = $alipay->createPayment($sale_id, $amount, "USD", $description, $return_url, $notify_url);
        echo "<a href='$approve'>Test Transaction Link</a>";
        exit;
            
        }catch(Exception $e) { 
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    function uuid() {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0010
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function alipay_return() {
        $sale_id = $_GET['sale_id'];

        echo "<h4>Your payment is being processed. Thank you!</h4>";
        echo "<small>Sale ID: $sale_id.</small>";
        exit;
    }

    public function alipay_notify() {
        // print_r($_POST['out_trade_no']);exit;
        $tid = $_POST['out_trade_no'];
        $tno = $_POST['trade_no'];
        $total_amount = $_POST['total_fee']; // don't forget to substract Alipay Transaction fee
        $alipay = new Alipay();

// @todo: Verify system transaction ID hasn't been used by looking it up in your DB.

        try {
            if ($alipay->verifyPayment($_POST) === false) { // Transaction isn't complete
                echo "Unable to verify payment.";
                return false;
            } else {
                
            }
        } catch (Exception $e) { // Connection error
            echo $e->getMessage();
            return false;
        } catch (AlipayException $e) { // Hash or invalid transaction error
            echo $e->getMessage();
            return false;
        }
    }
    public function sprovider_login(Request $request){
        extract($_REQUEST);
        try { 
           $params = json_decode($request->getContent());
           
           $user = User::where('email', $params->email)->where('status', '<>', 'Trash')->where('status', '<>', 'Inactive')->first();
           $provider=Sproviderdetail::where('user_id', $user->user_id)->first();
           $category=Service::where('category', $provider->category_id)->first();
           $categorys=Category::where('id',$category->category)->first();
            if (!empty($user)) {
                if ($user->isVerified == '1') {
                    if ($user->status == 'Active') {
                        if ($user->password == md5($params->password)) {
                            $response = array("token" => $user->token, "user_id" => $user->user_id,"category"=>$categorys->category, "code" => "200", "message" => "Logged in Successfully!");
                        } else {
                            $response = array("message" => "Email Id and password mismatch", "code" => "0");
                        }
                    } else {
                        $response = array("message" => "Your account is Inactive! Please contact Admin.", "code" => "1");
                    }
                } else {
                    $response = array("message" => "Mobile Number is not verified!", "mobile" => $user->mobile, "token" => $user->token, "code" => "2");
                }
            } else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        }catch(Exception $e) { 
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function sp_getprofile(Request $request,$id) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $user = User::where('user_id', $id)->where('status','Active')->first();
            $country = Country::where('id', $user->country)->first();
            if (!empty($user)) {
                $sprovider = User::where('user_id', $id)->first();
                $pro=Sproviderdetail::where('user_id',$id)->first();
                $data = array(                    
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "email" => $user->email,
                    "country_code"=>$country->country_code,
                    "mobile" => $user->mobile,
                    "address" => $user->address,
                    "profile" => !empty($user->profile) ? asset('files/proof/' . $user->profile) : "",
                    "idproof" => !empty($user->passport) ? asset('files/proof/' . $user->idproof) : "",
                    'tution_name' => $pro->tution_name,
                    'company_name' => $pro->company_name,
                     'description' => $pro->description,
                    'cover_image' => !empty($pro->cover_image) ? asset('files/services/' . $pro->cover_image) : "",
                );
                $response = array("data" => $data, "code" => "200");
            }
            else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
        return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }         
    public function update_sp_profile(Request $request,$id) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $user = User::where('user_id', $id)->first();
                //print_r($user);exit;
            if (!empty($user)) {
                    $data1=array(
                        'first_name' => !empty($params->first_name)?$params->first_name : "$user->first_name",
                        'last_name' =>!empty( $params->last_name)? $params->last_name : "$user->last_name",
                        'email' => !empty($params->email)? $params->email : "$user->email",
                        'mobile' => !empty($params->mobile)? $params->mobile : "$user->mobile",
                        'address' =>!empty($params->address)? $params->address : "$user->address",
                        'profile' => (!empty($params->profile)) ? $this->base64_toimage($params->profile,  public_path('/files/profile/')) : "$params->profile",
                        'idproof' => (!empty($params->idproof)) ? $this->base64_toimage($params->idproof,  public_path('/files/proof/')) : "$params->idproof"
                     );
                    User::where('user_id', $id)
                            ->update($data1);
                    $sprovider =Sproviderdetail::where('user_id',$id)->first();
                   
                    if (!empty($sprovider)) {
                            $data1=array(
                                'tution_name' => !empty($params->tution_name) ? $params->tution_name : "$sprovider->tution_name" ,
                                'description' => !empty($params->description) ? $params->description : "$sprovider->description" ,
                                 'cover_image' => (!empty($params->cover_image)) ? $this->base64_toimage($params->cover_image,  public_path('/files/services/')) : "$sprovider->cover_image"
                                    );
                            
                             Sproviderdetail::where('user_id', $id)
                                    ->update($data1);
                            }
                            $response = array("code" => "200", "message" => "Profile updated successfully!");
                    
            }else {
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    
    
    public function addsubject(Request $request){
        extract($_REQUEST);
        try{
            $params = json_decode($request->getContent());
            // print_r($params);
            //   exit;
            $data = new Subject();
            $data->provider_id = $params->provider_id;
            $data->subject_title = $params->subject_title;
            $data->tution_id=$params->tution_id;
             $data->cover_image = (!empty($params->cover_image)) ? $this->base64_toimage($params->cover_image,  public_path('/files/services/')) : "";
            $data->save();
            $response = array('code' => '200', 'message' => 'Subject added successfully!');
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }

    }
    //subject list based on provider
    public function getsubject(Request $request,$id) {
        extract($_REQUEST);
        try {
            
            $subject = Subject::where('status','Active' )->where('provider_id', $id)->get();
            $sub_count=$subject->count();
            //print_r($sub_count);exit;
            if ($sub_count > 0) {
                foreach($subject as $subjects){
                $data[]=array(
                    "provider_id"=>$id,
                    "subject_id"=>$subjects->subject_id,
                    "subject_title" => $subjects->subject_title,
                    "cover_image" => !empty($subjects->cover_image)? asset('files/services/' .$subjects->cover_image) :""
                );
                }
                $response = array("data" => $data, "code" => "200");
            }else {
                $response = array("message" => "Subject not exists!", "code" => "0");
            }
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    //Subject details
     public function getsubject_detail(Request $request,$id) {
        extract($_REQUEST);
        try {
            
            $subject = Subject::where('status','Active' )->where('subject_id', $id)->first();
           // print_r($subject);exit;
                $data[]=array(
                    "provider_id"=>$subject->provider_id,
                    "subject_id"=>$subject->subject_id,
                    "subject_title" => $subject->subject_title,
                    "cover_image" => !empty($subject->cover_image)? asset('files/services/' .$subject->cover_image) :""
                );
         
                $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
}
    
    
    public function updatesubject(Request $request,$id) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $subject = Subject::where('subject_id',$id )->first();
            if(!empty($subject)){
                $data=array(
                    "subject_title" => !empty($params->subject_title) ? $params->subject_title : "$subject->subject_title",
                    'cover_image' => (!empty($params->cover_image)) ? $this->base64_toimage($params->cover_image,  public_path('/files/services/')) :"$subject->cover_image"
                );
                Subject::where('subject_id', $id )
                ->update($data);
                $response = array('code' => '200', 'message' => 'Subject updated');
                
            }
            else{
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response); 
        }catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function deletesubject(Request $request,$id) {
        extract($_REQUEST);
        try {
                $subject = Subject::where('subject_id',$id)
                                    ->where('status','Active')->first();
                //print_r($subject);exit;
                if(!empty($subject)){
                    $data=array(
                        "status"=>"Trash",
                        );
                Subject::where('subject_id',$id) ->update($data);        
                $response = array('code' => '200', 'message' => 'Subject Deleted');
                }
            else{
                $response = array('code' => '0', 'message' => 'Subject Not exists');
            }
                return response()->json($response); 
            
        }
        catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function addtution(Request $request){
        extract($_REQUEST);
        try{
            $params = json_decode($request->getContent());
            //print_r($params);exit;
            $data = new Tution_detail();
            $data->sprovider_id = !empty($params->sprovider_id)? $params->sprovider_id :"";
            $data->subject_id = !empty($params->subject_id)? $params->subject_id: "";
            $data->class_mode = !empty($params->class_mode) ? $params->class_mode :"" ;
            $data->class_type = !empty($params->class_type) ? $params->class_type : "";
            $data->location = !empty($params->location) ? $params->location : "";
            $data->price = !empty($params->price) ? $params->price :"";
            $data->save();
            $id = $data->id;
            foreach($params->shedules as $shedule){
               $timings= $shedule->timing;
            $i=0;
               foreach($timings as $timing){
                 
                   $data=new Shedule();
            $data->tution_id =$id;
            $data->sprovider_id = !empty($params->sprovider_id)? $params->sprovider_id :"";
            $data->subject_id = !empty($params->subject_id)? $params->subject_id :"";
            $data->date = !empty($shedule->date) ?  date('Y-m-d',strtotime($shedule->date)): "";
           
            $data->from_time = !empty($timings[$i]->from_time)?$timings[$i]->from_time:"";
            $data->to_time = !empty($timings[$i]->to_time)?$timings[$i]->to_time:"";
            $data->created_date =  date('Y-m-d H:i:s');
            //print_r($params);exit;
            $data->save();
                }
             $i++;
             }
            $response = array('code' => '200', 'message' => 'Tution added successfully!');
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function tution_list(Request $request,$id) {
        extract($_REQUEST);
        try {
            $tution = Subject::where('provider_id',$id)
                        ->GroupBy('subject_title')->get();
            $sub_count=$tution->count();
            //print_r($sub_count);exit;
                if ($sub_count > 0) {
                foreach($tution as $tutions){
                $data[]=array(
                    "subject_title" => $tutions->subject_title,
                    "subject_id"=>$tutions->subject_id
                );
                }
                $response = array("data" => $data, "code" => "200");
            }else {
                $response = array("message" => "Subject not exists!", "code" => "0");
            }
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    
     public function remaining_sub(Request $request){
        extract($_REQUEST);
         try {
             $user_id = $request->header('user-id'); 
             $sub= Subject::where('provider_id',$user_id) ->get();
              foreach($sub as $subject){
                 //print_r($subject->subject_id);exit; 
                $shedule=Shedule::where('subject_id',$subject->subject_id)->first();
                 $data= array();
                //  print_r($shedule);exit;
               if(empty($shedule)){
                  $data=array(
                         "subject_title" => $subject->subject_title,
                         "subject_id"=>$subject->subject_id
                         );
                      print_r($data);exit;   
                     $response = array("data" => $data, "code" => "200");
               }
               $response = array("data" => $data, "code" => "200");
              }
             return response()->json($response);
         } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
     }
    //tution shedule
     public function get_tution(Request $request,$id){
        extract($_REQUEST);
        try {
            $subject = Subject::where('subject_id', $id)->first();
            $tution = Tution_detail::where('subject_id',$subject->subject_id)
                                       ->where('sprovider_id',$subject->provider_id)
                                       ->where('status','Active')->first();
            $shedule=Shedule::where('subject_id',$subject->subject_id )
                                ->where('status','Active')->get(); //print_r($shedule);exit;
            if(!empty($shedule)){
                $data['detail'][]= array( 
                    "subject_id"=>$id,
                    "tution_id"=>$shedule[0]->tution_id,
                    "subject_title" => $subject->subject_title,
                    "cover_image" => !empty($subject->cover_image)?asset('files/services/' .$subject->cover_image):"",
                    "class_mode" =>  $tution->class_mode,
                    "class_type" =>$tution->class_type,
                    "location" => $tution->location,
                    "price" =>$tution->price
                    );//print_r($data);exit;
            //$data['timing']=$data['dates']=array();
                
              foreach($shedule as $shed){
                 
              $data['timing'][] = array(  
                    "date" => $shed->date,
                    "from_time" => $shed->from_time,
                    "to_time" => $shed->to_time,
                );
             }
             foreach($shedule as $shed){
              $data['dates'][]=array(
                     "date" => $shed['date'],
                    );
             }
                $response = array("data" => $data, "code" => "200");
            }else{
                $response = array("message" =>"Tution Not Sheduled", "code" => "0");
            }
            
        return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function deletetution(Request $request,$id) {
        extract($_REQUEST);
        try {
                $data=array(
                        "status"=>"Inactive",
                        );
                        
                Shedule::where('tution_id',$id) ->update($data);  
                Tution_detail::where('id',$id) ->update($data);  
                $response = array('code' => '200', 'message' => 'Tution details successfully Deleted');
               return response()->json($response); 
            
        }catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function update_tution(Request $request,$id){
        extract($_REQUEST);
        try{
            $params = json_decode($request->getContent());
            $subject = Subject::where('subject_id', $id)->first();
            $tution = Tution_detail::where('subject_id',$subject->subject_id)
                                     ->where('sprovider_id',$subject->provider_id)->first();
            $shedule=Shedule::where('subject_id',$subject->subject_id )->first();
            //print_r($params);exit;
            $data1=array(
                    "subject_title" =>!empty($params->subject_title) ? $params->subject_title : "$subject->subject_title",
                    "subject_id" =>!empty($params->subject_id) ? $params->subject_id : "$subject->subject_id",
                    );
            Subject::where('subject_id',$params->subject_id)->update($data1);
            $data=array(
            "class_mode" => !empty($params->class_mode) ? $params->class_mode :"$tution->class_mode",
            "class_type" => !empty($params->class_type) ? $params->class_type : "$tution->class_type",
            "location" => !empty($params->location) ? $params->location : "$tution->location",
            "price" => !empty($params->price) ? $params->price :"$tution->price"
            );
            //print_r($data);exit;
            Tution_detail::where('subject_id',$params->subject_id)->update($data);
            $data1=array(
                
            "date" => !empty($params->date) ? $params->date :" $shedule->date",
            "from_time" => !empty($params->from_time)?$params->from_time:"$shedule->from_time",
            "to_time" => !empty($params->to_time)?$params->to_time:"$shedule->to_time"
           );
           Shedule::where('subject_id',$params->subject_id)->update($data1);
            $response = array('code' => '200', 'message' => 'Tution Updated Successfully');
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    //list tution based on user edu_type
    public function stu_list_tution(Request $request,$id){
         extract($_REQUEST);
         try {
         $user = User::where('user_id', $id)
                    ->select('education_type')->first();
         $sevice=Service::where('name',$user->education_type)
                    ->select('service_id')->first();   
        $provider=Sproviderdetail::where('service_id',$sevice->service_id)
                    ->get();
        //print_r($provider);exit;
        foreach($provider as $tutions){
            
                $data[]=array(
                    "sprovider_id"=>$tutions->user_id,
                    "tution_name" => $tutions->tution_name,
                    "tution_id"=> $tutions->id
                 );
                }
                $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    //subject list while click the sp tution(user)
    public function stu_sp_tution(Request $request,$id) {
        
        extract($_REQUEST); 
        try {
            $tution = Subject::where('tution_id',$id)
                        ->get();
            $sub_count=$tution->count();
           // print_r($tution->provider_id);exit;
            $pro_detail=User::where('user_id',$tution[0]->provider_id)
                    ->first();
             $image=Sproviderdetail::where('user_id',$tution[0]->provider_id)
                    ->first();       
                     $country = Country::where('id', $pro_detail->country)->first();
                if ($sub_count > 0) {
                
                $data['detail'][]=array(
                    "provider_fname"=>$pro_detail->first_name,
                    "provider_lname"=>$pro_detail->last_name,
                     "cover_image"=>!empty($image->cover_image)?asset('files/services/' .$image->cover_image):"",
                    "email"=>$pro_detail->email,
                    "country_code"=>$country->country_code,
                    "mobile" => $pro_detail->mobile,
                    "location"=>$pro_detail->address,
                    );
                
                foreach($tution as $tutions){
                    $data['subject'][]=array(
                    "subject_title" => $tutions->subject_title,
                    "subject_id"=>$tutions->subject_id,
                    "cover_image"=>!empty($tutions->cover_image)?asset('files/services/' .$tutions->cover_image):"",
                );
                }
                $response = array("data" => $data, "code" => "200");
            }else {
                $response = array("message" => "Subject not exists!", "code" => "0");
            }
          return response()->json($response);
        }catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
     public function get_shedule(Request $request,$id){
        extract($_REQUEST);
        try {
            //print_r($id);exit;
            $subject = Subject::where('subject_id', $id)->first();
            $tution = Tution_detail::where('subject_id',$subject->subject_id)
                                       ->where('sprovider_id',$subject->provider_id)->first();
                                       
            $shedule=Shedule::where('subject_id',$subject->subject_id )->get();//print_r($shedule);exit;
            if(!empty($shedule)){
              $data['detail'][] = array( 
                   "subject_title" => $subject->subject_title,
                    "cover_image" => !empty($subject->cover_image)?asset('files/services/' .$subject->cover_image):"",
                    "class_mode" =>  $tution->class_mode,
                    "class_type" =>$tution->class_type,
                    "location" => $tution->location,
                    "price" =>$tution->price, 
                   );
              foreach($shedule as $shedules) {  
                   $data['shedules'][] = array( 
                    "shedule_id"=> $shedules->shedule_id,
                    "date" => $shedules->date,
                    "from_time" => $shedules->from_time,
                    "to_time" => $shedules->to_time,
                );
              }
                $response = array("data" => $data, "code" => "200");
            }else{
                $response = array("message" =>"Tution Not Exist", "code" => "0");
            }
            
        return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    //student request for timing
    public function get_timing(Request $request,$id){
        extract($_REQUEST);
        try{
             $shedule_id=$id;
             $shedule=Shedule::where('shedule_id',$shedule_id )->first();
             //print_r($shedule);exit;
             $data = array( 
            "date" => $shedule->date,
             "from_time" => $shedule->from_time,
            "to_time" => $shedule->to_time,
            );
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        }
        
    }
    //Student send request
     public function send_request(Request $request,$id){
        extract($_REQUEST);
        try{
            
             $params = json_decode($request->getContent());
             $tution=Sproviderdetail::where('user_id',$params->provider_id) ->get();
             $data = new Booking();
             //print_r($tution);exit;
             $data->shedule_id = $params->shedule_id;
             $data->user_id = $id;
             $data->provider_id = $params->provider_id;
             $data->tution_id = $tution[0]->id;
             $data->save();
             
             
            $response = array("data" => $data,"message" =>"Your booking request sent", "code" => "200"); 
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        }
    }
    public function request_tu_list(Request $request,$id){
         extract($_REQUEST);
         try {
         $book = Booking::where('user_id', $id)
                 ->GroupBy('tution_id') ->get(); //print_r($book);exit;
         foreach($book as $books){
          $bid=$books->shedule_id; //print_r($bid);exit;   
          $shedule=Shedule::where('shedule_id',$bid)->first();
          $sub= Subject::where('subject_id',$shedule->subject_id) ->first();
          $tution=Tution_detail::where('id',$sub->tution_id) ->first();
          $image=Sproviderdetail::where('user_id',$tution->sprovider_id) ->get();
                  $data[]=array(
                    "sprovider_id"=>$tution->sprovider_id,
                    "tution_name" => $image[0]->tution_name,
                    "tution_id"=> $image[0]->id,
                    "cover_image"=>!empty($image[0]->cover_image)?asset('files/services/' .$image[0]->cover_image):"",
                 );
         }
        //print_r($data);exit;
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    //Requested subject student
    public function request_sub_list($tution=NULL,$user=NULL){
         extract($_REQUEST);
         try {
          $book = Booking::where('user_id', $user)
                           -> where('tution_id', $tution)->get();  //print_r($book);exit;
          foreach($book as $books){
          $bid=$books->shedule_id; //print_r($bid);exit;   
          $shedule=Shedule::where('shedule_id',$bid)->first();
          $sub= Subject::where('subject_id',$shedule->subject_id) ->first();
          $data[]=array(
                    "sprovider_id"=>$sub->provider_id,
                    "subject_name" => $sub->subject_title,
                    "subject_id"=> $sub->subject_id,
                    "cover_image" => !empty($sub->cover_image)?asset('files/services/' .$sub->cover_image):"",

                 );
          }
        //print_r($sub);exit;
        
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
 public function request_status($id){
         extract($_REQUEST);
         try {
          $book = Booking::where('booking_id','=', $id)->first();    
          $shedule=Shedule::where('shedule_id',$book->shedule_id)->first();
          $sub= Subject::where('subject_id',$shedule->subject_id) ->first();
               $data[]=array(
                    "shedule_id"=>$shedule->shedule_id,
                    "subject_id"=>$shedule->subject_id,
                    "subject_name" => $sub->subject_title,
                    "date"=>$shedule->date,
                    "from_time" => $shedule->from_time,
                    "to_time" => $shedule->to_time,
                    "status"=>$book->status,
                    "booking_id"=>$book->booking_id
                 );
         $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
     public function booking($id=NULL){
         extract($_REQUEST);
         try {
          $book = Booking::where('booking_id', $id)->first();  
          $shedule=Shedule::where('shedule_id',$book->shedule_id)->first();
          $sub= Subject::where('subject_id',$shedule->subject_id) ->first();
          //print_r($sub);exit;
                $data[]=array(
                    "shedule_id"=>$shedule->shedule_id,
                    "subject_id"=>$shedule->subject_id,
                    "date"=>$shedule->date,
                    "from_time" => $shedule->from_time,
                    "to_time" => $shedule->to_time,
                    "subject_title"=>$sub->subject_title
                 );
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    
    
    //service provider- Student request list
    public function request_stu_list(Request $request){
         extract($_REQUEST);
         try {
         $user_id = $request->header('user-id');
         $book = Booking::where('provider_id', $user_id)->get();
         foreach($book as $books){
          $uid=$books->user_id;   
          $shedule_id=$books->shedule_id;
          $shedule=Shedule::where('shedule_id',$shedule_id)->first();
          $sub= Subject::where('subject_id',$shedule->subject_id) ->first();
          $user=User::where('user_id',$uid) ->first();
                  $data[]=array(
                    "user_id"=>$uid,
                    "user_fname" => $user->first_name ,
                    "user_lname" => $user->last_name ,
                    'nick_name' => !empty($user->nick_name) ? $user->nick_name : "",
                    "subject_id"=> $shedule->subject_id,
                    "Subject_title"=>$sub->subject_title,
                    "date"=>$shedule->date,
                    "from_time" => $shedule->from_time,
                    "to_time" => $shedule->to_time,
                    "status"=>$books->status,
                    "booking_id"=>$books->booking_id
                 );
                 
         }
        //print_r($data);exit;
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
   
   public function update_send_request(Request $request){
        extract($_REQUEST);
        try{
             $booking_id = $request->header('booking_id');
             $book = Booking::where('booking_id', $booking_id)->first();
             $data=array(
                 "status"=>"Accepted",
                 "payment_status"=>"Pending"
                 );
             Booking::where('booking_id',$booking_id)->update($data);
             $data = new Notification();
             $data->to_id = $book->user_id;
             $data->from_id = $book->provider_id ;
             $data->subject = "tution";
             $data->booking_id = $booking_id;
             $data->label = "Request of booking tution accepted";
             $data->save();
             
             $response = array( "message" => "Request Accepted","code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
  public function payment(Request $request){
        extract($_REQUEST);
        try{
           $booking_id = $request->header('booking_id');
             $book = Booking::where('booking_id', $booking_id)->first();
             $data=array(
                 "payment_status"=>"Paid"
                 );
             Booking::where('booking_id',$booking_id)->update($data);
             $data = new Notification();
             $data->to_id = $book->provider_id;
             $data->from_id =$book->user_id;
             $data->subject = "tution";
             $data->booking_id = $booking_id;
             $data->label = "Payment Paid";
             $data->save();
             
             $response = array( "message" => "Tution fee paid","code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
    //subject - attendance list
    public function attendance_sub(Request $request){
        extract($_REQUEST);
        try{
             $provider_id = $request->header('provider_id');
             $tution = Tution_detail::where('sprovider_id', $provider_id)
                                        ->GroupBy('subject_id')->get();
            //print_r($tution);exit;                            
            foreach($tution as $tutions){
                $sub= Subject::where('subject_id',$tutions->subject_id) ->first();
                $data[]=array(
                    "subject_title"=>$sub->subject_title,
                    "subject_id"=>$tutions->subject_id
                    );
            } 
             $response = array( "data" => $data,"code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
    //student - attendance list
    public function attendance_student(Request $request){
        extract($_REQUEST);
        try{
             $current_date = $request->header('current_date');
             $subject_id = $request->header('subject_id');
             $shedule = Shedule::where('subject_id', $subject_id)
                                 ->where('subject_id', $subject_id)
                                 ->where('date', $current_date)
                                 ->where('status', "Active")->get();
             //print_r($shedule);exit;                 
             foreach($shedule as $shedules){
               $book = Booking::where('shedule_id', $shedules->shedule_id)
                                -> where('status', "Accepted")
                                 ->where('payment_status',"Paid")->first();
               $uid=$book['user_id'];             
               $user=User::where('user_id',$uid)->first();
               if(!empty($user)){
               $data[]=array(
                    "user_id"=>$uid,
                    "user_fname" => $user['first_name'] ,
                    "user_lname" => $user['last_name' ],
                    'nick_name' => !empty($user->nick_name) ? $user->nick_name : "",
                    "subject_id"=>$subject_id,
                    "provider_id"=>$book['provider_id'],
                    "booking_id"=>$book['booking_id']
                    );
            } 
            }
             $response = array( "data" => $data,"code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
     public function attendance_status(Request $request){
        extract($_REQUEST);
        try{
            $params = json_decode($request->getContent());
             $booking_id = $request->header('booking_id');
             $book = Booking::where('booking_id', $booking_id)
                                -> where('status', "Accepted")
                                 ->where('payment_status',"Paid")->first();
          if(!empty($book)){
                $data=array(
                    "attendance_status" => !empty($params->attendance_status) ? $params->attendance_status : "$book->attendance_status",
                   );     
                Booking::where('booking_id', $booking_id )
                ->update($data);
                $response = array('code' => '200', 'message' => 'Status updated');
            }
            else{
                $response = array("message" => "User not exists!", "code" => "0");
            }
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
private function contentFormat($content,$type= "string")
{
    if(!isset($content) || empty($content) || $content == 'undefined')
    {
        if($type == 'string')
        {
            return "";
        }
        else
        {
            return 0;
        }
    }
    else
    {
        return $content;
    }
} 
    
public function create_application(Request $request) {
    
    extract($_REQUEST);
 
    try {
        
        //print_r($user_id);exit;
        $applog = new Applog();
        $applog->params = $request->getContent();
        $applog->function = 'Create application';
        $applog->datetime = date('Y-m-d H:i:s');
        $applog->save();
        $content = $request->getContent();
        $validContent = str_replace("undefined,","\"\",",$content);
        $params = json_decode($validContent);
        $user_id = $request->header('token');
        if (!empty($user_id)) {
            $user_details = User::where('token', $user_id)->first();
            $user_application=UserApplication::where('userId', $user_details->user_id)->where('inst_id',$params->inst_id)->first();
            // dd($params);
            // echo "<pre>"; print_r($params); echo "</pre>"; exit;
            if(empty($user_application)){
            $data = new UserApplication();
            $data->userId = $user_details->user_id;
            $data->chineseName = $this->contentFormat($params->chineseName);
            // dd($data);
            $data->previousName = $this->contentFormat($params->previousName);
            $data->englishName = $this->contentFormat($params->englishName);
            $data->passportNo = $this->contentFormat($params->passportNo);
            $data->passportIssueDate = $this->contentFormat($params->passportIssueDate);
            $data->passportExpiryDate = $this->contentFormat($params->passportExpiryDate);
            $data->applicantPhoto = (!empty($params->applicantPhoto)) ? $this->base64_toimage($params->applicantPhoto,  public_path('/files/proof/')) :"";
            $data->dob = $this->contentFormat($params->dob);
            $data->sex = $this->contentFormat(isset($params->sex)?$params->sex:0,'numeric');
            $data->country = $this->contentFormat($params->country);
            $data->country = $this->contentFormat($params->city);
            $data->homeAddress = $this->contentFormat(isset($params->homeAddress)?$params->homeAddress:'');
            $data->inst_id = $this->contentFormat(isset($params->inst_id)?$params->inst_id:0);
            // $data->postalCode = $this->contentFormat($params->postalCode);
            $data->contactNo = $this->contentFormat($params->contactNo);
            $data->emailAddress = $this->contentFormat($params->emailAddress);
            $data->otherFinancialSupport = $this->contentFormat($params->otherFinancialSupport);
            $data->antecedentQuestion1 = $this->contentFormat($params->antecedentQuestion1);
            $data->antecedentQuestion2 = $this->contentFormat($params->antecedentQuestion2);
            $data->antecedentQuestion3 = $this->contentFormat($params->antecedentQuestion3);
            $data->antecedentQuestion4 = $this->contentFormat($params->antecedentQuestion4);
            $data->studentName = $this->contentFormat($params->studentName);
            $data->studentSignature = (!empty($params->studentSignature)) ? $this->base64_toimage($params->studentSignature,  public_path('/files/sign/')) :"";
            $data->studentDate = $this->contentFormat($params->studentDate);
            $data->parentName = $this->contentFormat($params->parentName);
            $data->parentSignature = (!empty($params->parentSignature)) ? $this->base64_toimage($params->parentSignature,  public_path('/files/sign/')) :"";
            $data->parentDate = $this->contentFormat($params->parentDate);
            $data->save(); //$data->id
            if(!empty($params->educational)){
                 if(count($params->educational) > 0){
                foreach($params->educational as $educational){ //ApplicationEducation
                    $data1 = new ApplicationEducation();
                    $data1->application_id = $data->id;
                    $data1->nameOfSchools = $this->contentFormat(isset($educational->schoolname)?$educational->schoolname:'');
                    $data1->country = $this->contentFormat($educational->country);
                    $data1->state = $this->contentFormat(isset($educational->mystate)?$educational->mystate:'');
                    $data1->languageOfInstruction = $this->contentFormat(isset($educational->language)?$educational->language:"");
                    $data1->studyFrom = $this->contentFormat(isset($educational->studyFrom)?$educational->studyFrom:"");
                    $data1->studyTo = $this->contentFormat(isset($educational->studyTo)?$educational->studyTo:"");
                    $data1->qualification = $this->contentFormat($educational->qualification);
                    $data1->certificateNo = "";
                    $data1->save();   
                }
            }
            }
            if(!empty($params->employment)){
            if(count($params->employment) > 0){
                foreach($params->employment as $employment){ //ApplicationEducation
                    $data2 = new ApplicationEmployment();
                    $data2->application_id = $data->id;
                    $data2->companyName = $this->contentFormat(isset($employment->companyname)?$employment->companyname:"");
                    $data2->country = $this->contentFormat(isset($employment->country)?$employment->country:"");
                    $data2->periodFrom = $this->contentFormat(isset($employment->periodFrom)?$employment->periodFrom:"");
                    $data2->periodTo = $this->contentFormat(isset($employment->periodTo)?$employment->periodTo:"");
                    $data2->positionHeld = $this->contentFormat(isset($employment->position)?$employment->position:"");
                    $data2->natureOfDuties = $this->contentFormat(isset($employment->Nature)?$employment->Nature:"");
                    $data2->save();   
                }
            }
        }
            if(!empty($params->relations)){
            if(count($params->relations) > 0){
                foreach($params->relations as $relations){ //ApplicationEducation
                    $data3 = new ApplicationRelation();
                    $data3->application_id = $data->id;
                    $data3->fullName = $this->contentFormat(isset($relations->fullname)?$relations->fullname:"");
                    $data3->relationship = $this->contentFormat(isset($relations->relationship)?$relations->relationship:"");
                    $data3->dob = $this->contentFormat(isset($relations->parentDate)?$relations->parentDate:"");
                    $data3->placeOfBirth = $this->contentFormat(isset($relations->birthplace)?$relations->birthplace:"");
                    $data3->nationality = "";
                    $data3->nricNo = $this->contentFormat(isset($relations->formTrue)?$relations->formTrue:"");
                    $data3->finNo = $this->contentFormat(isset($relations->acknowledgeTrue)?$relations->acknowledgeTrue:"");
                    $data3->residentialStatusNone = "";
                    $data3->occupation = $this->contentFormat(isset($relations->occupation)?$relations->occupation:"");
                    $data3->parent_sibling = ""; 
                    $data3->save();   
                }
            }
        }
         if(!empty($params->financial)){
            if(count($params->financial) > 0){
                foreach($params->financial as $financial){ //ApplicationEducation
                    $data3 = new ApplicationFinancial();
                    $data3->application_id = $data->id;
                    $data3->monthlyIncome = $this->contentFormat(isset($financial->monthlyIncome)?$financial->monthlyIncome:"");
                    $data3->currentSaving = $this->contentFormat(isset($financial->currentSaving)?$financial->monthlyIncome:"");
                    $data3->memberType = $this->contentFormat($financial->memberType,'numeric');
                    $data3->save();   
                }
            }
        }
        $response = array('code' => '200', 'message' => 'Appliaction Created!','data'=>$data->id);
        }else{
            $response = array('code' => '0', 'message' => 'Appliaction Already submitted!');
        }
            
        } else {
            $response = array('code' => '0', 'message' => 'User not found');
        }
        return response()->json($response);
        exit;
    } catch (Exception $e) {
        return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
        exit;
    }
}
public function get_online_app(Request $request,$id=NULL,$inst_id=NULL){
     extract($_REQUEST);
     try {
            $user_id = $request->header('user_id');
            $user_application=UserApplication::where('userId',$id)->first();
            // print_r($user_id);exit;
            $data['user_application']=UserApplication::where('userId',$user_id)->where('inst_id',$inst_id)->first();
            $data['application_education']=ApplicationEducation::where('application_id',$user_application->id)->get();
            $data['application_employment']=ApplicationEmployment::where('application_id',$user_application->id)->get();
            $data['application_relation']=ApplicationRelation::where('application_id',$user_application->id)->get();
            $data['application_finance']=ApplicationFinancial::where('application_id',$user_application->id)->get();
            return json_encode(array('code' => '200', 'data' => $data));
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
}
public function get_document1(Request $request) {
        extract($_REQUEST);
        try {
            $user_id = $request->header('token');
            $login_user = User::where('token', $user_id)->first();
           if (!empty($user_id)) {
                $inst_id=$request->header('institute_id');
                $document = DocInstitution::join('doc_inst_countries as b', 'doc_institutions.id', '=', 'b.doc_instutions_id')->join('inst_based_docs as c', 'b.id', '=', 'c.doc_inst_coun_list_id')->join('institutes as d','d.id','=','doc_institutions.inst_id')->join('institutecategories as e','e.id','=','doc_institutions.inst_cat_id')->join('countries as f','f.id','=','b.country_id')->select('c.id','c.document_name')->where('d.id',$inst_id)->where('f.country',$login_user->country)->get();
                print_r($document);exit;
                $response = array('code' => '200', 'message' => 'Data Found','document'=>$document);
                
            } else {
                $response = array('code' => '0', 'message' => 'User not found');
            }
            
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
public function get_document(Request $request) {
    extract($_REQUEST);
        try {
            $data=array();
        $id = $request->header('institute_id');
        $stu_id=$request->header('user_id');
        $cat_id=$request->header('category_id');
        $docs=array();
        $stu= User::where('user_id','=',$stu_id)->where('status','=','Active')->first();
        $detail = Institute::where('id', '=', $id)->where('status','=','Active')->first();
        
        $result = DocInstitution::where('inst_id',$id)->where('inst_cat_id',$cat_id)->where('status','Active')->get();
        if(!empty($result)){
              foreach($result as $results ){ 
                $country1= DocInstCountry::where('doc_instutions_id',$results->id)->where('country_id',$stu->country)->where('status',"Active")->first();
              
                $country = Country::where('id',$country1['country_id'])->where('status','Active')->first();
                $documents= InstBasedDoc::where('doc_inst_coun_list_id',$country['id'])->where('status',"Active")->get(); 
                $data['country']=array(  
                    'country'=>$country->country
                    );
                
                foreach($documents as $document){
                          
                           $data['documents'][]=array(
                               'document'=>$document['document_name']
                            );
                } 
            }
            $response = array('code' => '200', 'data'=>$data); 
        }else{
             $response = array('code' => '0', 'message' => "No Data found");
        }
        return response()->json($response);
}catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    
}

//List of health category
 public function health_services(Request $request) {
        extract($_REQUEST);
        try {
           
            // print_r($ser);exit;
            $data = array();
            $services = Service::where('category', "6")->where('status',"Active")->get();
            if(!empty($ser)){
                $services = Service::where('category', "6")->where('name',"like", "%" . $ser . "%")->where('status',"Active")->get();
            }
            if (!empty($services)) {
                foreach ($services as $service) {
                    $data[] = array(
                        'service_id' => $service->service_id,
                        'name' => $service->name,
                        'image' => asset('files/services/' . $service->image),
                    );
                }

                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No Services!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//Provider list based on health category    
    public function category_sprovider_list(Request $request) {
        extract($_REQUEST);
        try {
            $service_id = $request->header('service_id');
            $data = array();
           
            
            if (!empty($s)) {
                 $services = HealthService::join('users','health_services.sprovider_id', '=', 'users.user_id')->join('sproviderdetails','health_services.sprovider_id', '=', 'sproviderdetails.user_id')
                 ->where('health_services.category_id', $service_id)
                 ->where(function ($q) use ($s) {
                     $q->Orwhere('first_name','LIKE',"%$s%")
                       ->Orwhere('last_name','LIKE',"%$s%")
                       ->Orwhere('company_name','LIKE',"%$s%")
                       ->Orwhere('address','LIKE',"%$s%");
                     })
                 ->where('health_services.status',"Active")
                 ->where('users.status',"Active")->groupBy('health_services.sprovider_id')->get();
                //   print_r($services);exit;
                if(!empty($services)){
                $i=0;
                foreach ($services as $service) {
                    $provider_detail = Sproviderdetail::where('user_id',$service->sprovider_id)->first();
                    $provider = User::where('user_id',$service->sprovider_id)->first();
                    $ser_cat = HealthService::where('category_id', $service_id)->where('sprovider_id',$service->sprovider_id)->where('status',"Active")->get();
                    //  print_r($ser_cat);exit;
                    
                    $data['providers'][$i] = array(
                        'provider_name'=>$provider->first_name." ".$provider->last_name,
                        'provider_id'=>$service->sprovider_id,
                        'company_name'=>$provider_detail->company_name,
                        'address'=>$provider->address,
                        'profile'=>asset('files/proof/' . $provider->profile),
                       
                    );
                    foreach($ser_cat as $ser_cats){
                    $data['providers'][$i]['service'][]=array(
                        'service_id' => $ser_cats->id,
                        'service_name' => $ser_cats->service_name,
                        'image' => asset('files/services/' . $ser_cats->image),
                        );
                    }
                    $i++;
                }

                $response = array("data" => $data, "code" => "200");
            }else {
                $response = array("message" => "Not Found!", "code" => "0");
            }
            }else {
                $services = HealthService::where('health_services.category_id', $service_id)
                                  ->where('health_services.status',"Active")
                                  ->groupBy('health_services.sprovider_id')->get();
                //   print_r($services);exit;
                if(!empty($services)){
                $i=0;
                foreach ($services as $service) {
                    $provider_detail = Sproviderdetail::where('user_id',$service->sprovider_id)->first();
                    $provider = User::where('user_id',$service->sprovider_id)->first();
                    $ser_cat = HealthService::where('category_id', $service_id)->where('sprovider_id',$service->sprovider_id)->where('status',"Active")->get();
                    //  print_r($ser_cat);exit;
                    
                    $data['providers'][$i] = array(
                        'provider_name'=>$provider->first_name." ".$provider->last_name,
                        'provider_id'=>$service->sprovider_id,
                        'company_name'=>$provider_detail->company_name,
                        'address'=>$provider->address,
                        'profile'=>asset('files/proof/' . $provider->profile),
                       
                    );
                    foreach($ser_cat as $ser_cats){
                    $data['providers'][$i]['service'][]=array(
                        'service_id' => $ser_cats->id,
                        'service_name' => $ser_cats->service_name,
                        'image' => asset('files/services/' . $ser_cats->image),
                        );
                    }
                    $i++;
                }

                $response = array("data" => $data, "code" => "200");
            }else {
                $response = array("message" => "No Services!", "code" => "0");
            }
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//Service provider profile and their services     
     public function sprovider_cat_detail(Request $request) {
        extract($_REQUEST);
        try {
            $sprovider_id= $request->header('sprovider_id');
             $cat_id= $request->header('category_id');
            $data = array();
            $services = HealthService::where('sprovider_id', $sprovider_id)->where('category_id', $cat_id)->where('status',"Active")->get();
            
            if (!empty($services)) {
                $provider_detail = Sproviderdetail::where('user_id',$services[0]->sprovider_id)->first();
                $provider = User::where('user_id',$services[0]->sprovider_id)->first();
                // $country = Country::where('id', $provider->country)->first(); //print_r($provider);exit;
                 $data['details'] = array(
                        'provider_name'=>$provider->first_name." ".$provider->last_name,
                        'provider_id'=>$services[0]->sprovider_id,
                        'company_name'=>$provider_detail->company_name,
                        'address'=>$provider->address,
                        'profile'=>asset('files/proof/' . $provider->profile),
                        'mail_id'=>$provider->email,
                        // "country_code" => $country->country_code,
                        'mobile'=>$provider->mobile,
                        );
                foreach ($services as $service) {
                    
                    // print_r($provider);exit;
                    $data['services'][] = array(
                        'service_id' => $service->id,
                        'service_name' => $service->service_name,
                        'image' => asset('files/services/' . $service->image),
                        'fee'=>$service->fee,
                        'description'=>$service->description
                    );
                }

                $response = array("data" => $data, "code" => "200");
            } else {
                $response = array("message" => "No Services!", "code" => "0");
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//view service detail    
    public function service_detail(Request $request) {
        extract($_REQUEST);
        try {
            $service_id= $request->header('service_id');
            $user_id= $request->header('user_id');
            $data = array();
            $services = HealthService::where('id', $service_id)->where('status',"Active")->first();
            $category=Service::where('service_id', $services->category_id)->first();
            //  print_r($category);exit;
            if (!empty($services)) {
                $provider_detail = Sproviderdetail::where('user_id',$services->sprovider_id)->first();
                $provider = User::where('user_id',$services->sprovider_id)->first();
                $services_shed = HealthShedule::where('service_id', $service_id)->where('status',"Active")->get();
                 $data['details'] = array(
                        'provider_name'=>$provider->first_name." ".$provider->last_name,
                         'provider_email'=>$provider->email,
                          'provider_mobile'=>$provider->mobile,
                        'provider_id'=>$services->sprovider_id,
                        'company_name'=>$provider_detail->company_name,
                        'address'=>$provider->address,
                        'profile'=>asset('files/proof/' . $provider->profile),
                        'service_id' => $services->id,
                        'service_name' => $services->service_name,
                        'category' => $category->name,
                        'fee'=>$services->fee,
                        'image' => asset('files/services/' . $services->image)
                        );
                        $booked="";
                        foreach($services_shed as $shedule){
                          $booked= HealthBooking::where('shedule_id',$shedule->id)->where('user_id',$user_id)->first();
                          
                            $data['shedules'][] = array(
                                'id'=>$shedule->id,
                                'date'=>date('Y-m-d',strtotime($shedule->date)),
                                'from_time'=>$shedule->from_time,
                                'to_time'=>$shedule->to_time,
                                 "booking_status"=>!empty($booked)?$booked->status:"",
                                "payment_status"=>!empty($booked)?$booked->payment_status:"",
                                "reason"=>!empty($booked)?$booked->reason:"",
                                "requested_date"=>!empty($booked->requested_date)?date('d-m-Y',strtotime($booked->requested_date)):"",
                                "created_date"=>!empty($booked->created_date)?date('d-m-Y ',strtotime($booked->created_date)):"",
                                "updated_date"=>!empty($booked->updated_date)?date('d-m-Y',strtotime($booked->updated_date)):"",
                                );
                        }
                 $response = array("data" => $data, "code" => "200");
                }else{
                    $response = array("message" => "Not found", "code" => "0");
                }
                
                return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//Popup health timing
 public function get_health_timing(Request $request,$id){
        extract($_REQUEST);
        try{
             $shedule_id=$id;
             $shedule=HealthShedule::where('id',$shedule_id )->first();
             //print_r($shedule);exit;
             $data = array( 
            "date" => $shedule->date,
            "from_time" => $shedule->from_time,
            "to_time" => $shedule->to_time,
            );
            $response = array("data" => $data, "code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        }
        
    }
// send booking request
public function health_send_request(Request $request){
        extract($_REQUEST);
        try{
             $params = json_decode($request->getContent());
             $shedule= HealthShedule::where('id',$params->shedule_id)->where('status',"Active")->first();
            //  print_r($params->shedule_id);exit;
             $booked= HealthBooking::where('shedule_id',$params->shedule_id)->where('user_id',$params->user_id)->first();
             if(empty($booked)){
             $data = new HealthBooking();
             $data->shedule_id = $params->shedule_id;
             $data->user_id = $params->user_id;
             $data->provider_id = $shedule->sprovider_id;
             $data->service_id = $shedule->service_id;
             $data->requested_date = date('Y-m-d H:i:s');
             $data->save();
             $data1 = new Notification();
             $data1->to_id = $shedule->sprovider_id;
             $data1->from_id = $params->user_id;
             $data1->subject = "health";
             $data1->booking_id =  $data->id;
             $data1->label = "Sending request to booking the clinic Appointment ";
             $data1->save();
            $response = array("data" => $data,"message" =>"Your booking request sent", "code" => "200"); 
            return response()->json($response);
        }else{
             $response = array("message" =>"You already sent request", "code" => "0"); 
            return response()->json($response);
        }
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        }
    }
//Pending request for health service
public function health_req_list(Request $request){
         extract($_REQUEST);
         $user_id= $request->header('user_id');
         try {
             $data=array();
         $book = HealthBooking::where('user_id', $user_id) ->get();// print_r($book);exit;
         if(!empty($book)){
         foreach($book as $books){
            //  print_r($book);exit;
          $shed_id=$books->shedule_id; 
          $shedule=HealthShedule::where('id',$shed_id)->first();
          $service=HealthService::where('id',$books->service_id) ->first();
          if(!empty($service)){
          $sp_detail=User::where('user_id',$service->sprovider_id)->first();
          $provider=Sproviderdetail::where('user_id',$service->sprovider_id) ->first();
        //   print_r($service->sprovider_id);
                  $data[]=array(
                    "booking_id"=>$books->id,
                    "sprovider_id"=>$service->sprovider_id,
                    "provider_name"=>$sp_detail->first_name.' '.$sp_detail->last_name,
                    "provider_profile"=>!empty($sp_detail->profile)?asset('files/proof/' .$sp_detail->profile):"",
                    "company_name" => $provider->company_name,
                    "service_id"=>$books->service_id,
                    "service_name"=>$service->service_name,
                    "cover_image"=>!empty($service->image)?asset('files/services/' .$service->image):"",
                    "created_date"=>!empty($books->created_date)?date('d-m-Y',strtotime($books->created_date)):"",
                    "from_time"=>$shedule->from_time,
                    "to_time"=>$shedule->to_time,
                    "shedule_date"=>$shedule->date,
                    "booking_status"=>$books->status,
                     "reason"=>!empty($books->reason)?$books->reason:"",
                     "requested_date"=>!empty($books->requested_date)?date('d-m-Y',strtotime($books->requested_date)):"",
                     "updated_date"=>!empty($books->updated_date)?date('d-m-Y',strtotime($books->updated_date)):"",
                         );
         }
         }
         $response = array("data" => $data, "code" => "200");
          return response()->json($response);
         }else{
            $response = array("message" => "Not found", "code" => "0");
          return response()->json($response); 
         }
        //print_r($data);exit;
          
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
 public function upload_document(Request $request){
        $params = json_decode($request->getContent());
        $student = Application::where('user_id',$params->student_id)->where('institute_id',$params->institute_id)->where('status','<>','Rejected')->first();
        // print_r($student);exit;
        if(empty($student)){
        $data = new Application();
        $data->user_id = $params->student_id;
        $data->institute_id = $params->institute_id;
        $data->save();
        $lastid=$data->application_id;
        // print_r($params->student_id);exit;
        
        foreach($params->documents as $docs){
                $data = new ApplicationDetail();
                $data->application_id = $lastid;
                $data->document_name = $docs->document_name;
                $data->form = !empty($docs->document)? $this->base64_toimage($docs->document,  public_path('/files/forms/')) : "";
                $data->save();
        
         }
        $response = array("meesage" => "Successfully Applied !", "code" => "200");
        return response()->json($response);
        }else{
           $response = array("meesage" => "You already Applied to this Institute", "code" => "0");
          return response()->json($response);
        }
       
    }
    
//Provider    
//Addd the new services and shedule 
public function add_new_service(Request $request) {
        extract($_REQUEST);
        try {
            $params = json_decode($request->getContent());
            $data = new HealthService();
            $data->service_name =  !empty($params->service_name)? $params->service_name :"";
            $data->category_id = !empty($params->category_id)? $params->category_id :"";
            $data->sprovider_id = !empty($params->sprovider_id)? $params->sprovider_id :"";
            $data->description = !empty($params->description)? $params->description :"";
            $data->fee = !empty($params->fee)? $params->fee :"";
            $data->image = (!empty($params->image)) ? $this->base64_toimage($params->image,  public_path('/files/services/')) : "";
            $data->datetime = date('Y-m-d H:i:s');
            $data->save();
            $lastid=$data->id;
            // print_r($lastid);exit;
            foreach($params->shedules as $shedule){
            $data=new HealthShedule();
            $data->service_id =$lastid;
            $data->sprovider_id = !empty($params->sprovider_id)? $params->sprovider_id :"";
            $data->date = !empty($shedule->date) ?  date('d-m-Y',strtotime($shedule->date)): "";
            $data->from_time = !empty($shedule->from_time)?$shedule->from_time:"";
            $data->to_time = !empty($shedule->to_time)?$shedule->to_time:"";
            $data->created_date =  date('d-m-Y H:i:s');
            $data->save();
             }
             
            $response = array('code' => '200', 'message' => 'Service Added!');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }  
    public function health_service_list(Request $request){
        extract($_REQUEST);
        try {
            $sprovider_id = $request->header('sprovider_id');
            // print_r($sprovider_id);exit;
            $services = HealthService::where('sprovider_id',$sprovider_id)->where('status','Active')->get();
            // print_r($services);exit;
            $data=array();
            foreach($services as $service){
                $data[]=array(
                    "service_id"=>!empty($service->id)? $service->id:"",
                    "service_name"=>!empty($service->service_name)?$service->service_name :"",
                    "image"=>!empty($service->image)?  asset('files/services/' .$service->image) :"",
                    "description"=>!empty($service->description)?$service->description:"",
                    "fee"=>!empty($service->fee)?$service->fee:""
                    );
            }
            $response = array('code' => '200', 'data' => $data);
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }  
    public function update_shedule(Request $request) {
        extract($_REQUEST);
        try {
            $service_id= $request->header('service_id');
            $params = json_decode($request->getContent());
            // print_R($params);exit;
            $data = HealthService::find($service_id);
            $data->service_name =  !empty($params->service_name)? $params->service_name :"";
            $data->category_id = !empty($params->category_id)? $params->category_id :"";
            $data->sprovider_id = !empty($params->sprovider_id)? $params->sprovider_id :"";
            $data->description = !empty($params->description)? $params->description :"";
            $data->fee = !empty($params->fee)? $params->fee :"";
            $data->image = (!empty($params->image)) ? $this->base64_toimage($params->image,  public_path('/files/services/')) : "";
            $data->save();
            foreach($params->shedules as $shedule){
            $data=new HealthShedule();
            $data->service_id =$service_id;
            $data->sprovider_id = !empty($shedule->sprovider_id)? $shedule->sprovider_id :"";
            $data->date = !empty($shedule->date) ?  date('Y-m-d',strtotime($shedule->date)): "";
            $data->from_time = !empty($shedule->from_time)?$shedule->from_time:"";
            $data->to_time = !empty($shedule->to_time)?$shedule->to_time:"";
            $data->created_date =  date('Y-m-d H:i:s');
            $data->save();
             }
             
            $response = array('code' => '200', 'message' => 'Shedule Updated!');
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    } 
    //Requested list 
public function sp_health_req_list(Request $request){
         extract($_REQUEST);
         $provider_id= $request->header('provider_id');
         try {
         $book = HealthBooking::where('provider_id', $provider_id) ->get(); //print_r($book);exit;
         foreach($book as $books){
          $shed_id=$books->shedule_id; 
          $shedule=HealthShedule::where('id',$shed_id)->first();
          $service=HealthService::where('id',$books->service_id) ->first();
          if(!empty($service)){
          $user=User::where('user_id',$books->user_id)->first();
         
                  $data[]=array(
                    "booking_id"=>$books->id,
                    "user_id"=>$books->user_id,
                    "provider_id"=>$provider_id,
                    "user_name"=>$user->first_name.' '.$user->last_name,
                    "user_profile"=>!empty($user->profile)?asset('files/proof/' .$user->profile):"",
                    "service_id"=>$books->service_id,
                    "service_name"=>$service->service_name,
                    "created_date"=>!empty($books->created_date)?date('d-m-Y',strtotime($books->created_date)):"",
                    "from_time"=>$shedule->from_time,
                    "to_time"=>$shedule->to_time,
                    "shedule_date"=>$shedule->date,
                    "booking_status"=>$books->status,
                    "reason"=>!empty($books->reason)?$books->reason:"",
                    "requested_date"=>!empty($books->requested_date)?date('d-m-Y',strtotime($books->requested_date)):"",
                     "updated_date"=>!empty($books->updated_date)?date('d-m-Y',strtotime($books->updated_date)):"",
                         );
         }
         }
        //print_r($data);exit;
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function provider_booking_details(Request $request,$id=NULL){
         extract($_REQUEST);
         try {
          $books = HealthBooking::where('id', $id) ->first(); //print_r($books);exit;
          $shed_id=$books->shedule_id; 
          $shedule=HealthShedule::where('id',$shed_id)->first();
          $service=HealthService::where('id',$books->service_id) ->first();
          
          $user=User::where('user_id',$books->user_id)->first();
          $data['user']=array(
              "user_id"=>$user->user_id,
              "user_name"=>$user->first_name.' '.$user->last_name,
              "nick_name"=>$user->nick_name,
              "mobile"=>$user->mobile,
              "address"=>$user->address,
              "email"=>$user->email,
              "user_profile"=>!empty($user->profile)?asset('files/proof/' .$user->profile):""
              );
          $data['service']=array(
              "service_id"=>$service->id,
              "service_name"=>$service->service_name,
              "description"=>$service->description,
              "fee"=>$service->fee,
              "cover_image"=>!empty($service->image)?  asset('files/services/' .$service->image) :"",
              );
          $data['shedule']=array(
              "date"=>date('d-m-Y',strtotime($shedule->date)),
              "frome_time"=>$shedule->from_time,
              "to_time"=>$shedule->to_time,
              );
         $data['booking_details']=array(
              "booking_id"=>$books->id,
              "payment_status"=>$books->payment_status,
              "booking_status"=>$books->status,
              "invoice_id"=>$books->invoice_id,
              );
         
        //print_r($data);exit;
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
    public function stu_booking_details(Request $request,$id=NULL){
         extract($_REQUEST);
         try {
          $books = HealthBooking::where('id', $id) ->first(); //print_r($books);exit;
          $shed_id=$books->shedule_id; 
          $shedule=HealthShedule::where('id',$shed_id)->first();
          $service=HealthService::where('id',$books->service_id) ->first();
          
          $user=User::where('user_id',$books->provider_id)->first();
          $pro=Sproviderdetail::where('user_id',$books->provider_id)->first();
          $data['user']=array(
              "user_id"=>$user->user_id,
              "user_name"=>$user->first_name.' '.$user->last_name,
              "mobile"=>$user->mobile,
              "address"=>$user->address,
              "email"=>$user->email,
              "user_profile"=>!empty($user->profile)?asset('files/proof/' .$user->profile):"",
              "description"=>$pro->description,
              "company_name"=>$pro->company_name,
              );
          $data['service']=array(
              "service_id"=>$service->id,
              "service_name"=>$service->service_name,
              "description"=>$service->description,
              "fee"=>$service->fee,
              "cover_image"=>!empty($service->image)?  asset('files/services/' .$service->image) :"",
              );
          $data['shedule']=array(
              "date"=>date('d-m-Y',strtotime($shedule->date)),
              "frome_time"=>$shedule->from_time,
              "to_time"=>$shedule->to_time,
              );
         $data['booking_details']=array(
              "booking_id"=>$books->id,
              "payment_status"=>$books->payment_status,
              "booking_status"=>$books->status,
              "invoice_id"=>$books->invoice_id,
              );
         
        //print_r($data);exit;
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
public function generate_invoice(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $user=User::where('token',$token)->first();
           $data=new Invoice();
           foreach($params->fee as $amount){
            //   print_r($amount->fee_type);exit;
               $fee[]=array(
                   "fee_type"=>$amount->fee_type,
                   "fee"=>$amount->fee_amount
                   );
           }
          $fee=json_encode($fee);
        //   print_r($fee);exit;
                    $data->booking_id=$params->booking_id;
                    $data->user_id=$user->user_id;
                    $data->service_type=$params->service_type;
                    $data->fee=$fee;
                  
         $data->save();
        //  print_r($data->id);exit;
         $data1=array(
             "invoice_id"=>$data->id);
         HealthBooking::where('id',$params->booking_id)->update($data1);
         // print_r($data);exit;
        
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }    
public function institute_pay_amount(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $params = json_decode($request->getContent());
           $user=User::where('token', $token)->first();
           $amount=$params->amount;
           $user_amount=$user->wallet_amount;
             $id=$user->user_id;
            if($amount<=$user_amount){
                 $total=  ($user->wallet_amount) - $amount;
                $wallet=WalletSetting::where('id', "2")->first();
                $coin_value=$wallet->value;
                $less_coins=$amount*$coin_value;
                $coin_value=$coin_value*$total;
                $data=array(
                "wallet_amount"=>$total,
                "coins"=>$coin_value
                ); 
                User::where('user_id', $user->user_id)
                                ->update($data);
             
             $data = new Notification();
             $data->to_id = $user->user_id;
             $data->from_id = "1";
             $data->label = "Payment transfered!";
             $data->subject = "institute";
             $data->booking_id = $params->application_id;
             $data->save();
             $id=$user->user_id;
             $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Your payment successfully completed" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
             $data = new Notification();
             $data->to_id = "1";
             $data->from_id = $id;
              $data->label = "Payment transfered!";
             $data->subject = "institute";
              $data->booking_id = $params->application_id;
             $data->save();
               $user=User::where('user_id', "1")->first();
               $sender=User::where('user_id', $id)->first();
               $fcmid[] = $user['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'Admin', 'from_id' => $id, 'name' => 'Vinga Admin', 'to_id' => "1", 'message' => $sender['first_name'].' '.$sender['first_name'].' Paid from wallet' , 'notify_from' => 'Package', 'id' => "1"));
               $this->send_push_notification($fcmid, $message);
            
            
             $data = new WalletHistory();
             $data->user_id = $id;
             $data->amount = $amount;
             $data->coins = $less_coins;
             $data->action = "institute"; 
             $data->save();
             $data=array();
             $data =Application::find($params->application_id);
             $data->payment_status = "Paid";
             $data->save();
            return json_encode(array("code" =>200, "message" => "Paid ! Your balance in wallet $coin_value"));  
             
            }else{
                 $data = new Notification();
                 $data->to_id = $user->user_id;
                 $data->from_id = "1";
                 $data->subject = "topup";
                 $data->label = "Please Topup your wallet!";
                 $data->save();
                 $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Please topup your wallet amount !" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
                 return json_encode(array("code" => 0, "message" => "There is no enogh money in wallet to pay!"));  
                
            }
            // print_r($user_amount);exit;
            
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }    
public function appl_programfee(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $params = json_decode($request->getContent());
           $user=User::where('token', $token)->first();
           $amount=$params->amount;
           $user_amount=$user->wallet_amount;
             $id=$user->user_id;
             $application=Application::where('application_id',$params->application_id)->first();
            if($application->status=="Approved"){
               $docs=ApplicationDetail::where('application_id',$params->application_id)->get();
               
            if($amount<=$user_amount){
                 $total=  ($user->wallet_amount) - $amount;
                $wallet=WalletSetting::where('id', "2")->first();
                $coin_value=$wallet->value;
                $less_coins=$amount*$coin_value;
                $coin_value=$coin_value*$total;
                $data=array(
                "wallet_amount"=>$total,
                "coins"=>$coin_value
                ); 
                User::where('user_id', $user->user_id)
                                ->update($data);
             
             $data = new Notification();
             $data->to_id = $user->user_id;
             $data->from_id = "1";
             $data->label = "Payment transfered!";
             $data->subject = "institute";
             $data->booking_id = $params->application_id;
             $data->save();
             $id=$user->user_id;
             $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Your payment successfully completed" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
             $data = new Notification();
             $data->to_id = "1";
             $data->from_id = $id;
              $data->label = "Payment transfered!";
             $data->subject = "institute";
              $data->booking_id = $params->application_id;
             $data->save();
               $user=User::where('user_id', "1")->first();
               $sender=User::where('user_id', $id)->first();
               $fcmid[] = $user['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'Admin', 'from_id' => $id, 'name' => 'Vinga Admin', 'to_id' => "1", 'message' => $sender['first_name'].' '.$sender['first_name'].' Paid from wallet' , 'notify_from' => 'Package', 'id' => "1"));
               $this->send_push_notification($fcmid, $message);
            
            
             $data = new WalletHistory();
             $data->user_id = $id;
             $data->amount = $amount;
             $data->coins = $less_coins;
             $data->action = "institute_application"; 
             $data->save();
             $data=array();
             $data =Application::find($params->application_id);
             $data->program_fee_status = "Paid";
             $data->save();
            return json_encode(array("code" =>200, "message" => "Paid ! Your balance in wallet $coin_value"));  
             
            }else{
                 $data = new Notification();
                 $data->to_id = $user->user_id;
                 $data->from_id = "1";
                 $data->subject = "topup";
                 $data->label = "Please Topup your wallet!";
                 $data->save();
                 $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Please topup your wallet amount !" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
                 return json_encode(array("code" => 0, "message" => "There is no enogh money in wallet to pay!"));  
                
            }
             }else{
                 return json_encode(array("code" => 0, "message" => "Your Application is not get approval!"));  
             }
            // print_r($user_amount);exit;
            
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }        
public function pay_amount(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $params = json_decode($request->getContent());
           $user=User::where('token', $token)->first();
           $amount=$params->amount;
           $user_amount=$user->wallet_amount;
             $id=$user->user_id;
            if($amount<=$user_amount){
                 $total=  ($user->wallet_amount) - $amount;
                // print_r($total);exit;
                $booking=HealthBooking::where('id',$params->booking_id)->first();
                $provider=User::where('user_id', $booking->provider_id)->first();
                // print_r($provider);exit;
                $wallet=WalletSetting::where('id', "2")->first();
                $coin_value=$wallet->value;
                $less_coins=$amount*$coin_value;
                $coin_value=$coin_value*$total;
                $data=array(
                "wallet_amount"=>$total,
                "coins"=>$coin_value
                ); 
                User::where('user_id', $user->user_id)
                                ->update($data);
             $data = new Notification();
             $data->to_id = $user->user_id;
             $data->from_id = "1";
             $data->subject = "health";
             $data->booking_id = $params->booking_id; 
             $data->label = "Your payment successfully completed!";
             $data->save();
             $id=$user->user_id;
             $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Your payment successfully completed" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
             $data = new Notification();
             $data->to_id = "1";
             $data->from_id = $id;
             $data->subject = "health";
             $data->booking_id = $params->booking_id; 
             $data->label = "Payment transfered!";
             $data->save();
               $user=User::where('user_id', "1")->first();
               $sender=User::where('user_id', $id)->first();
               $fcmid[] = $user['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'Admin', 'from_id' => $id, 'name' => 'Vinga Admin', 'to_id' => "1", 'message' => $sender['first_name'].' '.$sender['first_name'].' Paid from wallet' , 'notify_from' => 'Package', 'id' => "1"));
               $this->send_push_notification($fcmid, $message);
            
             $data = new Notification();
             $data->to_id = $provider->user_id;
             $data->from_id = $id;
             $data->subject = "health";
             $data->booking_id = $params->booking_id; 
             $data->label = "Payment transfered!";
             $data->save();
               $user1=User::where('user_id', $provider->user_id)->first();
               $sender=User::where('user_id',$id )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => $id, 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $provider->user_id, 'message' => $sender['first_name'].' '.$sender['first_name'].' makes their payment', 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
            //  print_r("fchg");exit;
             $data = new WalletHistory();
             $data->user_id = $id;
             $data->amount = $amount;
             $data->coins = $less_coins;
             $data->action = "health"; 
             $data->save();
             $data=array();
             $data =HealthBooking::find($params->booking_id);
             $data->status = "Paid";
             $data->save();
            return json_encode(array("code" =>200, "message" => "Your balance in wallet $coin_value"));  
             
            }else{
                 $data = new Notification();
                 $data->to_id = $user->user_id;
                 $data->from_id = "1";
                 $data->subject = "topup";
                 $data->booking_id = $params->booking_id; 
                 $data->label = "Please topup your wallet amount !";
                 $data->save();
                 $user1=User::where('user_id', $id)->first();
               $sender=User::where('user_id',"1" )->first();
               $fcmid[] = $user1['User']['fcmid'];
               $message = array("notifydata" => array('to' => 'user', 'from_id' => "1", 'name' => $user1['first_name'].' '.$user1['first_name'] , 'to_id' => $id, 'message' => "Please topup your wallet amount !" , 'notify_from' => 'Package', 'id' => $id));
               $this->send_push_notification($fcmid, $message);
                 return json_encode(array("code" => 0, "message" => "There is no enogh money in wallet to pay!"));  
                
            }
            // print_r($user_amount);exit;
            
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    } 
            
  public function notification_list(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $user=User::where('token',$token)->first();
           $notification=Notification::where('to_id',$user->user_id)->get();
           foreach($notification as $notifications){
               if($notifications->from_id==1){
                   $from="Admin";
               }else{
                   $provider=User::where('token',$token)->first();
                   $from="Service Provider,".$provider->first_name;
               }
            //   print_r($amount->fee_type);exit;
               $data[]=array(
                    "from"=>$from, 
                    "message"=>$notifications->label,
                    "service"=>$notifications->subject,
                    "date"=>date('d-M-Y h:i a',strtotime($notifications->created_date)),
                   );
           }
         
          $response = array("data" => $data, "code" => "200");
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }       
     public function wallethistory(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $user=User::where('token',$token)->first();
           $wallets=WalletHistory::where('user_id',$user->user_id)->get();
            $data=array();
               foreach($wallets as $wallet){
            //   print_r($amount->fee_type);exit;
               $data[]=array(
                    "user_id"=>$wallet->user_id,
                    "amount"=>$wallet->amount,
                    "for"=>$wallet->action,
                    "date"=>date('d-M-Y h:i a',strtotime($wallet->created_date)),
                   );
                 
           }
           $total_coins=$user->coins;
            $response = array("data" => $data,"coins"=>$total_coins, "code" => "200");
           
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
 public function update_health_req(Request $request){
        extract($_REQUEST); 
        try{
            $params = json_decode($request->getContent());
             $booking_id = $request->header('booking_id');
             $book = HealthBooking::where('id', $booking_id)->first();
            //  print_r($book);exit;
             $data=array(
                "status"=>!empty($params->status)?$params->status:$book->status,
                "reason"=>!empty($params->reason)?$params->reason:$book->reason,
                "updated_date"=>date('Y-m-d H:i:s')
                        );
             HealthBooking::where('id',$booking_id)->update($data);
             $data = new Notification();
             $data->to_id = $book->user_id;
             $data->from_id = $book->provider_id;
             $data->subject = "health";
             $data->booking_id = $booking_id; 
             $data->label = "Your Request status Upadated";
             $data->save();
              $notification = Notification::find($data->id);
              $user=User::where('user_id', $notification->to_id)->first();
               $msg = array('message' => $notification->label, 'node_id' => '1', 'action' => 'match');
                // if ($notification->action == 'match') {
                    $frm = User::find($notification->from_id);
                    $msg['name'] = $frm->first_name.' '.$frm->last_name;
                    $msg['gender'] = $frm->gender;
                    $msg['profile'] = "";
                //   }
                $this->send_push_notification($user->fcmid, $msg);
             $response = array( "message" => "Request status Upadated","code" => "200");
            return response()->json($response);
        }catch(Exception $e){
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit; 
        } 
    } 
  public function invoice_details(Request $request,$id=null){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $booking=HealthBooking::where('id',$id)->first();
           if(!empty($booking->invoice_id)){
           $invoice=Invoice::where('id',$booking->invoice_id)->first();
        //   print_r($invoice);exit;
        $fees= json_decode($invoice->fee);
        $amount=0;
            foreach($fees as $fee){ 
                $amount= $amount+$fee->fee;
            }
            $data=array();
                $data['booking_details']=array(
                    "booking_id"=>$id,
                    "amount"=>json_decode($invoice->fee),
                    "created_date"=>date('d-M-Y h:i a',strtotime($invoice->created_date)),
                   );
            $user = User::where('user_id', $booking->user_id)->first();
            $country = Country::where('id', $user->country)->first();
            // $city = City::where('id', $user->city)->first();
            if (!empty($user)) {
                $data['user_detail'] = array(
                    'user_id' => $user->user_id,
                    'token' => $user->token,
                    'user_type' => $user->user_type,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "nick_name" => $user->nick_name,
                    "agent_code"=>!empty($user->agent_code)?$user->agent_code:"",
                    "email" => $user->email,
                    "gender" => $user->gender,
                    "dob" => $user->dob,
                    "education_type"=>$user->education_type,
                    "mobile" => $user->mobile,
                    "address" => $user->address,
                    "country" => $user->country,
                    "city" => !empty($user->city)? $user->city : "",
                    "passport_no"=>!empty($user->passport_no) ? $user->passport_no: "",
                    "country_code"=>!empty($country->country_code)? $country->country_code :"",
                    "mobile_no" => $user->mobile,
                    "followers" => $user->followers,
                    "profile" => !empty($user->profile) ? asset('files/proof/' . $user->profile) : "",
                    "passport" => !empty($user->passport) ? asset('files/proof/' . $user->passport) : "",
                );
            }
             $user = User::where('user_id', $booking->provider_id)->where('status','Active')->first();
            $country = Country::where('id', $user->country)->first();
            if (!empty($user)) {
                $pro=Sproviderdetail::where('user_id',$booking->provider_id)->first();
                $data['provider_details'] = array(                    
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "email" => $user->email,
                    "country_code"=>$country->country_code,
                    "mobile" => $user->mobile,
                    "address" => $user->address,
                    "profile" => !empty($user->profile) ? asset('files/proof/' . $user->profile) : "",
                    "idproof" => !empty($user->passport) ? asset('files/proof/' . $user->idproof) : "",
                    'company_name' => $pro->company_name,
                     'description' => $pro->description,
                    'cover_image' => !empty($pro->cover_image) ? asset('files/services/' . $pro->cover_image) : "",
                );
            }
           $response = array("data" => $data,'total_amount'=>$amount, "code" => "200");
           }else{
               $response = array("message" => "Invoice Not Found", "code" => "0");
           }
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
 public function status_list(Request $request){
         extract($_REQUEST);
         $token= $request->header('token');
         $params = json_decode($request->getContent());
         try {
           $user=User::where('token',$token)->first();
           $applications=Application::where('user_id',$user->user_id)->get();
           if(!empty($applications)){
            $data=array();
               foreach($applications as $application){
                   $institute = Institute::where('status', 'Active')->where('id', $application->institute_id)->first();
                   $cat = Institutecategory::where('status', 'Active')->where('id', $institute->category)->first();
                    $data[] = array(
                        'application_id'=>$application->application_id,
                        'institute_id' => $institute->id,
                        'institute_category' => $cat->name,
                        'institute_name' => $institute->institute_name,
                        'institute_logo' => !empty($institute->institute_logo) ? asset('files/institutes/' . $institute->institute_logo) : "",
                        'institute_image' => !empty($institute->image) ? asset('files/institutes/' . $institute->image) : "",
                        'institute_description' => $institute->description,
                        'institute_location' => $institute->location,
                        'institute_application_fee' => $institute->application_fee,
                        'institute_application_form' => !empty($institute->application_form) ? asset('files/forms/' . $institute->application_form) : "",
                        "application_status"=>$application->status,
                        "application_payment_status"=>$application->payment_status,
                        "agent_payment_status"=>$application->agent_fee_status,
                        'program_feepayment_status' =>  $application->program_fee_status ,
                        "created_date"=>date('d-m-Y',strtotime($application->created_date)),
                    );
               
           }
           $response = array("data" => $data, "code" => "200");
           }else{
              $response = array("message" => "No data found", "code" => "0"); 
           }
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
    public function status_detail(Request $request,$id=NULL){
         extract($_REQUEST);
         $params = json_decode($request->getContent());
         try {
           
           $application=Application::where('application_id',$id)->first();
          if(!empty($application)){
            $data=array();
                $docs=ApplicationDetail::where('application_id',$id)->get();

                   $institute = Institute::where('status', 'Active')->where('id', $application->institute_id)->first();
                   $cat = Institutecategory::where('status', 'Active')->where('id', $institute->category)->first();
                    $data[] = array(
                        'application_id'=>$application->application_id,
                        'institute_id' => $institute->id,
                        'institute_category' => $cat->name,
                        'institute_name' => $institute->institute_name,
                        'institute_logo' => !empty($institute->institute_logo) ? asset('files/institutes/' . $institute->institute_logo) : "",
                        'institute_image' => !empty($institute->image) ? asset('files/institutes/' . $institute->image) : "",
                        'institute_description' => $institute->description,
                        'institute_location' => $institute->location,
                        'institute_program_fee' => !empty($institute->program_fee) ? $institute->program_fee : "",
                        'institute_application_fee' => $institute->application_fee,
                        'institute_application_form' => !empty($institute->application_form) ? asset('files/forms/' . $institute->application_form) : "",
                        "application_status"=>$application->status,
                        "application_payment_status"=>$application->payment_status,
                        "agent_payment_status"=>$application->agent_fee_status,
                        'program_feepayment_status' => !empty($application) ? $application->program_fee_status : "" ,
                        "created_date"=>date('d-m-Y',strtotime($application->created_date)),
                        'upload_documents' => !empty($docs) ? "submitted" : "" ,
                    );
             
           $response = array("data" => $data, "code" => "200");
           }else{
              $response = array("message" => "No data found", "code" => "0"); 
           }
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
     public function update_token(Request $request){
         extract($_REQUEST);
         $params = json_decode($request->getContent());
         try {
            //  print_r("hjgh");exit;
           $user=User::find($params->user_id);
           $user->fcmid=$params->fcmid;
           $user->save();
           $response = array("message" => "Fcm id Updated!", "code" => "200"); 
           
          return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }   
}