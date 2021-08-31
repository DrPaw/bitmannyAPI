<?php

namespace App\Http\Controllers\Api;

use App\Cryptowallet;
use App\Currency;
use App\GeneralSetting;
use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\UserLogin;
use App\UserWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticateController extends Controller
{
    public function signup(Request $request)
    {
        $input = $request->all();
        $data = $request->all();
        $rules = array(
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160',
            'mobile' => 'required|string|max:30',
            'password' => 'required|string|min:6',
            'username' => 'required|string|min:6',
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $cm = [
            'firstname.required' => 'First Name  must not be  empty!!',
            'lastname.required' => 'Last Name  must not be  empty!!',
            'phone.required' => 'Contact Number is required!!',
            'email.required' => 'Email Address must not be  empty!!',
            'username.required' => 'username must not be  empty!!',
        ];


        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Error creating account', 'error' => $validator->errors()]);
        }

        $email = User::where('email', $input['email'])->exists();
        if ($email) {
            return response()->json(['status' => 0, 'message' => 'Email has been taken']);
        }

        $phone = User::where('mobile', $input['mobile'])->exists();
        if ($phone) {
            return response()->json(['status' => 0, 'message' => 'Phone number has been taken']);
        }

        $username = User::where('username', $input['username'])->exists();
        if ($username) {
            return response()->json(['status' => 0, 'message' => 'Username has been taken']);
        }


        $gnl = GeneralSetting::first();

        if(isset($data['referBy'])){
            $referUser = User::where('username',$data['referBy'])->first();
        }


        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => trim(strtolower($data['email'])),
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'refer' =>  isset($data['referBy']) ?  $referUser->id : null,
            'mobile' => $data['mobile'],
            'address' => [
                'address' => null,
                'state' => null,
                'zip' => null,
                'country' => $data['country'],
                'city' => null,
            ],
            'status' => 1,
            'ev' =>  $gnl->ev ? 0 : 1,
            'sv' =>  $gnl->sv ? 0 : 1,
            'ts' => 0,
            'tv' => 1,
        ]);


        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'deposit_wallet',
        ]);

        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'interest_wallet',
        ]);

        return response()->json(['status' => 1, 'message' => "Account created successfully"]);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
                return response()->json(['status' => 0, 'message' => 'Unable to login with errors', 'error' => $validator->errors()]);
        }


            if (!Auth::attempt(['email' => request('username'), 'password' => request('password')]) && !Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                if (!Auth::attempt(['mobile' => request('username'), 'password' => request('password')]) && !Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                    return response()->json(['status' => 0, 'message' => "Invalid credentials. Try again with valid credentials"]);
                }
            }


            $user = Auth::user();
            $token = Str::random(60);

        $user = auth()->user();
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();

        $baseUrl = "http://www.geoplugin.net/";
        $endpoint = "json.gp?ip=" . request()->ip()."";
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $headers = array (
            "Content-Type: $contentType",

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec( $ch ),true);
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        curl_close($ch);


        $conti = $content['geoplugin_continentName'];
        $country = $content['geoplugin_countryName'];
        $city = $content['geoplugin_city'];
        $area = $content['geoplugin_areaCode'];
        $code = $content['geoplugin_countryCode'];
        $long = $content['geoplugin_longitude'];
        $lat = $content['geoplugin_latitude'];

        $info = json_decode(json_encode(getIpInfo()), true);
        $ul['user_id'] = $user->id;
        $ul['user_ip'] =  request()->ip();
        $ul['long'] =  $long;
        $ul['lat'] =  $lat;
        $ul['location'] =  $city . $area . $country . $code;
        $ul['country_code'] = $code;
        $ul['browser'] = $info['browser'];
        $ul['os'] = $info['os_platform'];
        $ul['country'] =  $country;
        UserLogin::create($ul);


            $request->user()->forceFill([
                'api_token' => $token,
            ])->save();

            $hour = date('H');
            $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
            $greet = "Good " . $dayTerm;

            $wallet = UserWallet::where([['type', 'deposit_wallet'], ['user_id', Auth::id()]])->first();

            return response()->json(['status' => 1, 'message' => "User authenticated successfully", 'token' => $token, 'balance' => $wallet->balance, 'first_name' => $user->firstname, 'last_name' => $user->lastname, 'user_name' => $user->username, 'image' => $user->image, 'phone' => $user->mobile, 'email' => $user->email, 'greet' => $greet]);

    }

    public function loginonetime(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'pin' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::find(Auth::id());

            if ($input['pin'] != "biometrics") {
                return response()->json(['status' => 0, 'message' => 'Unable to login']);
            }


            $user = Auth::user();
            $token = Str::random(60);

            $user = auth()->user();
            $user->tv = $user->ts == 1 ? 0 : 1;
            $user->save();

            $baseUrl = "http://www.geoplugin.net/";
            $endpoint = "json.gp?ip=" . request()->ip()."";
            $httpVerb = "GET";
            $contentType = "application/json"; //e.g charset=utf-8
            $headers = array (
                "Content-Type: $contentType",

            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $content = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
            curl_close($ch);


            $conti = $content['geoplugin_continentName'];
            $country = $content['geoplugin_countryName'];
            $city = $content['geoplugin_city'];
            $area = $content['geoplugin_areaCode'];
            $code = $content['geoplugin_countryCode'];
            $long = $content['geoplugin_longitude'];
            $lat = $content['geoplugin_latitude'];

            $info = json_decode(json_encode(getIpInfo()), true);
            $ul['user_id'] = $user->id;
            $ul['user_ip'] =  request()->ip();
            $ul['long'] =  $long;
            $ul['lat'] =  $lat;
            $ul['location'] =  $city . $area . $country . $code;
            $ul['country_code'] = $code;
            $ul['browser'] = "Biometric Login: " . $info['browser'];
            $ul['os'] = $info['os_platform'];
            $ul['country'] =  $country;
            UserLogin::create($ul);


            $request->user()->forceFill([
                'api_token' => $token,
            ])->save();

            $hour = date('H');
            $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
            $greet = "Good " . $dayTerm;

            $wallet = UserWallet::where([['type', 'deposit_wallet'], ['user_id', Auth::id()]])->first();

            return response()->json(['status' => 1, 'message' => "User authenticated successfully", 'token' => $token, 'balance' => $wallet->balance, 'first_name' => $user->firstname, 'last_name' => $user->lastname, 'user_name' => $user->username, 'image' => $user->image, 'phone' => $user->mobile, 'email' => $user->email, 'greet' => $greet]);

        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

    public function changepassword(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'cur_pass' => 'required',
            'new_pass' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

            $user =User::find(Auth::id());

            if (!Hash::check($request->cur_pass, $user->password)) {
                return response()->json(['status' => 0, 'message' => 'Current password did not match']);
            }

            $password = Hash::make($request->new_pass);
            $user->password = $password;
            $user->passupdate = Carbon::now();
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Password changed successfully']);
    }

    public function verifycode(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'code' => 'required',
            'type' => 'required',
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            if ($user->sms_code != $input['code']) {
                return response()->json(['status' => 0, 'message' => 'Verification code did not match']);
            }

            $user->phone_verify = 1;
            $user->email_verify = 1;
            $user->save();
            return response()->json(['status' => 1, 'message' => 'Verified successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Unable to verify', 'error' => $validator->errors()]);
        }
    }

    public function resendcode(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $code = substr(rand(), 0, 6);

            $user->sms_code=$code;
            $user->save();

            $text = "Your Verification Code is $code";
            send_email_sendgrid($user, "Email verification", $text);

            $txt = "Your%20phone%20verification%20code%20is:%20$code";
//            send_bulksmsnigeria($user->phone, $txt);
            send_smsTermi($user->phone,$code);

            return response()->json(['status' => 1, 'message' => 'Code resent successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }
    }

    public function forgotpassword(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->orWhere('phone', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $code = substr(rand(), 0, 6);

            $user->sms_code=$code;
            $user->save();

            $text = "Your Verification Code is $code";
            send_email_sendgrid($user, "Email verification", $text);

            $txt = "Your%20phone%20verification%20code%20is:%20$code";
//            send_bulksmsnigeria($user->phone, $txt);
            send_smsTermi($user->phone,$code);

            return response()->json(['status' => 1, 'message' => 'Verification sent successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

    public function forgotpassword_newpassword(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required',
            'code' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->orWhere('phone', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }


            if ($user->sms_code != $input['code']) {
                return response()->json(['status' => 0, 'message' => 'Verification code did not match']);
            }

            $user->password = Hash::make($input['password']);
            $user->save();
            return response()->json(['status' => 1, 'message' => 'Password set successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

    public function getUser()
    {

        if (auth()->user()->status != 1) {
            $users = User::where('id', '=', auth()->user()->id)->first();
            return response()->json(['status' => 1, 'message' => 'User details generated successfully', 'data' => $users]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Your account has been blocked! Kindly contact support']);
        }
    }

}
