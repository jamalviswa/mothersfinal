<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
use Session;
use Redirect;
use App\Adminuser;
use Carbon\Carbon;
use Mail;

abstract class Controller extends BaseController {
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
    public function sendmail($content, $subject, $from, $from_name, $to, $to_name, $attachments = NULL) {
            $data = array('content' => $content);
            $mail = Mail::send('mail', $data, function($message)use ($subject, $from, $from_name, $to, $to_name, $attachments) {
                        $message->from($from, $from_name);
                        $message->to($to, $to_name)->subject
                                ($subject);
                    });
            return $mail;
    }

    public function checkadmin() {
        $session_admin = Session::get('Adminuser');
        if (!empty($session_admin)) {
            $admin = Adminuser::where('admin_id', $session_admin->admin_id)->first();
            if (!empty($admin)) {
                View::share('sessionadmin', $admin);
                return $admin;
            } else {
                header('location:http://localhost/mothersvillage/');
                exit;
            }
        } else {
            header('location:http://localhost/mothersvillage/');
            exit;
            // return Redirect::to('admin/adminusers/login');
            // exit;
        }
    }
   
    
    public function str_rand($length = 8, $output = 'alphanum') {
        // Possible seeds
                $outputs['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
                $outputs['numeric'] = '0123456789';
                $outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
                $outputs['hexadec'] = '0123456789abcdef';
        
        // Choose seed
                if (isset($outputs[$output])) {
                    $output = $outputs[$output];
                }
        
        // Seed generator
                list($usec, $sec) = explode(' ', microtime());
                $seed = (float) $sec + ((float) $usec * 100000);
                mt_srand($seed);
        
        // Generate
                $str = "";
                $output_count = strlen($output);
                for ($i = 0; $length > $i; $i++) {
                    $str .= $output[
                        mt_rand(0, $output_count - 1)
                    ];
                }
        
                return $str;
            }
        public function sendSMS($number, $message){
        
        $apiKey = urlencode('jQW2tY2RvQ0-EJ8QY95YMXGN4s80suFVbXierTlFB9');
       // Message details
       //$numbers = array($number);
       $sender = urlencode('TXTLCL');
       //$message = rawurlencode('Hellp');
        $message="Mobile Number Already Exists ";
       //$numbers = implode(',', $numbers);
        
       // Prepare data for POST request
       $data = array('apikey' => $apiKey, 'numbers' => $number, "sender" => $sender, "message" => $message);
    //   print_r($data);exit;
        // Send the POST request with cURL
       $ch = curl_init('https://api.textlocal.in/send/');
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $response = curl_exec($ch);
       curl_close($ch);
       
       // Process your response here
       return $response;
           }
   
    function get_day_name($timestamp) {
        $date = date('d-m-Y', $timestamp);
        if ($date == date('d-m-Y')) {
            $date = 'Today';
        } else if ($date == date('d-m-Y', Carbon::now()->toDateTimeString() - (24 * 60 * 60))) {
            $date = 'Yesterday';
        }
        return $date;
    }
    public function send_push_notification($registatoin_id = null, $message) {
        // Set POST variables
        //$message = array("notifydata" => array('to' => 'dboy', 'to_id' => '', 'message' => "New Order Assigned - ", 'notify_from' => 'order', 'id' => ''));
        $url = 'https://fcm.googleapis.com/fcm/send';
        $message['notifydata']['click_action'] = 'OPEN_ACTIVITY_1';
        $notif = array
            (
            'title' => $message['notifydata']['message'],
            'body' => $message['notifydata']['message'],
            'notify_from' => $message['notifydata']['notify_from'],
            'to_id' => isset($message['notifydata']['to_id']) ? $message['notifydata']['to_id'] : "",
            'id' => isset($message['notifydata']['id']) ? $message['notifydata']['id'] : "",
            'sound' => 'mySound',
            'click_action' => 'FCM_PLUGIN_ACTIVITY',
            'icon' => 'fcm_push_icon'
        );
        $msg = array
            (
            'body' => '',
            'title' => $message['notifydata']['message'],
            'notify_from' => $message['notifydata']['notify_from'],
            'icon' => 'myicon',
            'sound' => 'mySound',
            "click_action" => "OPEN_ACTIVITY_1",
            'badge' => '1',
            'notification' => $message['notifydata'],
            'id' => isset($message['notifydata']['id']) ? $message['notifydata']['id'] : "",
            'to_id' => isset($message['notifydata']['to_id']) ? $message['notifydata']['to_id'] : ""
        );
        $registatoin_ids = array('ffPFOFMlELs:APA91bGzC3z8v-eTT25Mplat57RVs-g6FKPHlMQTDh3avXG1_4vepJ36iTEpOX-zGXg05Yqr0lXBv3Y1QRu94TuNRiJPktAAeNZrkRqhgkAeiM2Tv8ZQz-vElgEeKqhU50L7a-eyRQuN');
        foreach ($registatoin_ids as $registatoin_ids) {
            $fields = array('notification' => $notif, 'to' => $registatoin_ids, 'data' => $msg);
// $headers = array('Authorization: key=AIzaSyCk9ghsIossqMt9W8oHUUrrto4fDaWAiqA','Content-Type: application/json');

            $headers = array('Authorization: key=AAAAWlPC6Uk:APA91bH2ajVSrX42maQxPHM10bSRh5-fOjbZlsfYMXYsfpfw7PV2QPdb7VbxyS7Dw0MDN5A4_MIcedK7zPsxI9-zBdR2Bm7msRYI5pWPp-U37_WgQh_Qv9O9EY5ySkdEYgaqa7V0yMh5', 'Content-Type: application/json');

            $ch = curl_init();
//echo json_encode($fields);exit;
// Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

// Execute post
            $result = curl_exec($ch);
            
            if ($result === FALSE) {

                return ('Curl failed: ' . curl_error($ch));
            }

            curl_close($ch);
        }
        return $result;
    }
    function facebook_time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);           // value 60 is seconds  
        $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
        $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
        $weeks = round($seconds / 604800);          // 7*24*60*60;  
        $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
        $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 min ago";
            } else {
                return "$minutes min ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hr ago";
            } else {
                return "$hours hr ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            } else {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            }
        } else if ($weeks <= 4.3) { //4.3 == 52/12  
            if ($weeks == 1) {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            } else {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return date('F d', strtotime($timestamp));
            } else {
                return date('F d', strtotime($timestamp));
            }
        } else {
            if ($years == 1) {
                return date('F d, Y', strtotime($timestamp));
            } else {
                return date('F d, Y', strtotime($timestamp));
            }
        }
    }
    public function ago($time) {
        $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();
        $difference = $now - $time;
        $tense = "ago";
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $periods[$j] .= "s";
        }
        return "$difference $periods[$j] ago";
    }
    public function comments_ago($time) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();

        $difference = $now - $time;
        $tense = "ago";
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $periods[$j] .= "s";
        }
        $arr = explode(' ', trim($periods[$j]));
        $t = substr($arr[0], 0, 1);
        return $difference . $t;
    }
    function get_timeago($ptime) {
        $ptime = strtotime($ptime);
        $estimate_time = time() - $ptime;
        echo date('d-m-Y H:i:s', $ptime);
        exit;

        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;
            if ($d >= 1) {
                $r = round($d);
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
    function base64_toimage($data, $path)
    {
        if ($data[0] == '/') {
            $type = "jpeg";
        } else if ($data[0] == 'R') {
            $type = "gif";
        } else if ($data[0] == 'i') {
            $type = "png";
        } else if ($data[0] == '0') {
            $type = "docx";
        } else if ($data[0] == 'J') {
            $type = "pdf";
        } else if ($data[0] == 'U') {
            $type = "avi";
        } else if ($data[0] == 'A') {
            $type = "mp4";
        } else if ($data[0] == 'M') {
            $type = "wmv";
        } else if ($data[0] == 'G') {
            $type = "webm";
        } else {
            $type = "jpeg";
        }
        $image = base64_decode($data);
        $imgFile = rand(0, 10000) . time() . "." . $type;
        $ifp = fopen($path . $imgFile, "wb");
        fwrite($ifp, base64_decode($data));
        fclose($ifp);
        return $imgFile;
    }
    //  function base64_toimage($data, $path) {
    //     if ($data[0] == '/') {
    //         $type = "jpeg";
    //     } else if ($data[0] == 'R') {
    //         $type = "gif";
    //     } else if ($data[0] == 'i') {
    //         $type = "png";
    //     } else if ($data[0] == '0') {
    //         $type = "docx";
    //     } else if ($data[0] == 'J') {
    //         $type = "pdf";
    //     } else {
    //         $type = "jpeg";
    //     }
    //     $image = base64_decode($data);
    //     $imgFile = rand(0, 10000) . time() . "." . $type;
    //     $ifp = fopen($path . $imgFile, "wb");
    //     fwrite($ifp, base64_decode($data));
    //     fclose($ifp);
    //     return $imgFile;
    // }
}
