<?php

namespace App\Http\Controllers\Api;

use App\Cryptoffer;
use App\Cryptotrade;
use App\Cryptotradechat;
use App\Cryptowallet;
use App\Curr;
use App\Currency;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Paymentmethod;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TradeController extends Controller
{

    public function create()
    {

        $data['crypto'] = Currency::where('status', 1)->whereCanoffer(1)->orderBy('name','asc')->get();
        $data['curr'] = Curr::where('status', 1)->orderBy('name','asc')->get();
        $data['pmethod'] = Paymentmethod::where('status', 1)->orderBy('name','asc')->get();
        if(!$data['crypto']){
            return response()->json(['status' => 0, 'message' => 'Invalid cryptocurrency']);
        }

        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }

    public function postoffer(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'crypto_id' => 'required',
            'pmethod_id' => 'required',
            'account' => 'required',
            'note' => 'required',
            'min' => 'required',
            'curr_id' => 'required',
            'max' => 'required',
            'expire' => 'required',
            'rate' => 'required'
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $country = Curr::where('status', 1)->whereId($request->curr_id)->first();
        if(!$country){
            return response()->json(['status' => 0, 'message' => 'Invalid Country/Currency or address not found']);
        }
        if($request->min >= $request->max){
            return response()->json(['status' => 0, 'message' => 'Invalid range. Your maximum amount must be greater than minimum']);
        }

        $crypto = Currency::where('status', 1)->whereId($request->crypto_id)->orderBy('name','asc')->first();
        if(!$crypto){
            return response()->json(['status' => 0, 'message' => 'Invalid cryptocurrency or cryptocurrency  not found']);
        }


        $w['coin_id'] = $crypto->id; // wallet method ID
        $w['user_id'] = Auth::id();
        $w['wallet_id'] = 0; // User Wallet ID
        $w['code'] = getTrx();
        $w['min'] = $request->min;
        $w['expire'] = $request->expire;
        $w['max'] = $request->max;
        $w['rate'] = $request->rate;
        $w['country'] = $country->country;
        $w['currency'] = $country->name;
        $w['payment_method'] = $request->pmethod_id;
        $w['account'] = $request->account;
        $w['note'] = $request->note;
        $w['type'] = 1;

        $result = Cryptoffer::create($w);
        if($result){
            return response()->json(['status' => 1, 'message' => 'Your new crypto offer has been created']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry we cant create your offer at the moment , please contact admin']);
        }
    }

    public function myoffers()
    {
        $data['offers'] = Cryptoffer::whereUser_id(Auth::id())->whereType(1)->orderBy('id','desc')->get();

        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }

    public function offersparams()
    {
        $data['crypto'] = Currency::where('status', 1)->whereCanoffer(1)->orderBy('name','asc')->get();
        $data['country'] = Curr::where('status', 1)->orderBy('name','asc')->get();

        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }

    public function fetchmarket(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'country' => 'required',
            'crypto' => 'required',
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $country=$request->country;
        $coin=$request->crypto;

        if($country == 'allcount'){
            $data['offer'] = Cryptoffer::whereCoin_id($coin)->where('status', 1)->orderBy('id','desc')->get();
            $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        else{
            $data['offer'] = Cryptoffer::whereCoin_id($coin)->where('status', 1)->whereCountry($country)->orderBy('id','desc')->get();
            $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }

    public function deleteoffer($code)
    {
        $offer = Cryptoffer::whereUser_id(Auth::id())->whereCode($code)->first();
        if(!$offer){
            return response()->json(['status' => 0, 'message' => 'We cant find your market offer']);
        }
        $offer->delete();
        return response()->json(['status' => 1, 'message' => 'Market Offer Deleted Successfully']);
    }
    public function disableoffer($code)
    {
        $offer = Cryptoffer::whereUser_id(Auth::id())->whereCode($code)->first();
        if(!$offer){
            return response()->json(['status' => 0, 'message' => 'We cant find your market offer']);
        }
        $offer->status = 0;
        $offer->save();
        return response()->json(['status' => 1, 'message' => 'Market Offer Deactivated Successfully']);
    }

    public function activateoffer($code)
    {

        $offer = Cryptoffer::whereUser_id(Auth::id())->whereCode($code)->first();
        if(!$offer){
            return response()->json(['status' => 0, 'message' => 'We cant find your market offer']);
        }
        $offer->status = 1;
        $offer->save();
        return response()->json(['status' => 1, 'message' => 'Market Offer Activated Successfully']);
    }

    public function contactseller(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'amount' => 'required|integer',
            'wallet' => 'required',
            'code' => 'required'
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $data['offer'] = Cryptoffer::whereCode($request->code)->where('type', 1)->where('status', 1)->orderBy('id','desc')->first();

        if(! $data['offer']){
            return response()->json(['status' => 0, 'message' => 'Invalid market offer']);
        }
        $seller = User::whereId($data['offer']->user_id)->first();



//           if($request->amount > $data['offer']->max){
//             $notify[] = ['error', 'You cant buy more than the market cap of $'.$data['offer'] ->max];
//             return back()->withNotify($notify)->withInput();
//            }
//
//            if($request->amount < $data['offer']->min){
//             $notify[] = ['error', 'You cant buy below the set market cap of $'.$data['offer'] ->min];
//             return back()->withNotify($notify)->withInput();
//            }



        $now = Carbon::now();
        $code = getTrx();


        $coin = Currency::where('status', 1)->whereId($data['offer']->coin_id)->orderBy('name','asc')->first();

        if(!$coin){
            return response()->json(['status' => 0, 'message' => 'Currency is currently disabled']);
        }

        /* $baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/get-fiat-to-crypto-rate";
         $baseurl = "https://min-api.cryptocompare.com/data/price?fsym=".$coin->symbol."&tsyms=USD";
         $curl = curl_init();
         curl_setopt_array($curl, array(
         CURLOPT_URL => $baseurl,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         //CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_CUSTOMREQUEST => 'GET',
         CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'fiat_amount' => 1,'fiat_symbol' => 'USD'),
       ));

       $response = curl_exec($curl);
       $reply = json_decode($response,true);
       curl_close($curl);
       //return $response;

        if (!isset($reply['USD'])){
        $rate = 1;
        }
        else
        {
        $rate = $reply['USD'];
        }
        $unit = $request->amount/$rate;
        */



        /*
         if($total > $wallet->balance){
              $notify[] = ['error', 'Seller does not have sufficient '.$coin->name.' in reserve wallet'];
              return back()->withNotify($notify)->withInput();
            }
        */

        $fee =  $request->amount/100*$coin->fee;
        $total = $fee + $request->amount;

        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/create-invoice";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'amount' => $total,'name' => $code,'currency' => 'USD','expire_time' => $data['offer']->expire, 'suceess_url' => url("#")),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);


        //return $response;
        if (!isset($reply['flag'])){
            return response()->json(['status' => 0, 'message' => 'An error occur']);
        }

        if ($reply['flag'] != 1){
            return response()->json(['status' => 0, 'message' => $reply['msg']]);
        }

        if (!isset($reply['data']['status_code'])){
            return response()->json(['status' => 0, 'message' => 'An error occur. We cant create an escrow wallet for this trade now']);
        }


        $address = $reply['data']['address'];
        $invoiceid = $reply['data']['invoice_id'];
        $coinvalue = $reply['data']['total_amount'][$coin->symbol];
        $coinusd = $reply['data']['total_amount']['USD'];
        $now = Carbon::now();


        $escrowfee =  $coinvalue/100*$coin->fee;
        $escrowpay =  $coinvalue-$escrowfee;

        //return $coinvalue;


        $w['user_id'] = $data['offer']->user_id;
        $w['coin'] = $coin->id;
        $w['amount'] = $request->amount;
        $w['marketcode'] = $data['offer']->code;
        $w['trx'] = $code;
        $w['status'] = 0;
        $w['wallet'] = $request->wallet;
        $w['units'] = $coinvalue;
        $w['escrowwallet'] = $address;
        $w['escrowid'] = $invoiceid;
        $w['escrowvalue'] = $coinvalue;
        $w['escrowusd'] = $coinusd;
        $w['escrowfee'] = $escrowfee;
        $w['escrowpay'] = $escrowpay;
        $w['buyer'] = Auth::id();
        $w['paid'] = 0;
        $w['expire'] = $now->addMinutes($data['offer']->expire);
        $result = Cryptotrade::create($w);

        $t['receiver'] = $data['offer']->user_id;
        $t['message'] = "Hi, i want to buy ".$coin->name." worth of ".$request->amount." USD";
        $t['marketcode'] = $data['offer']->code;
        $t['tradecode'] = $code;
        $t['type'] = 1;
        $t['sender'] = Auth::id();
        $cht = Cryptotradechat::create($t);

        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = $seller->username;
        $subject = 'Trade Initiated';
        $message = 'You have a pending trade invitation. Please login to your account to attend to trade.';
        try {
            send_general_email($seller->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }

        if($result){
            return response()->json(['status' => 1, 'message' => 'Your new crypto offer has been created and please wait while your coin is collected into the escrow wallet for you.']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry we cant patch you with the seller at the moment , please contact admin']);
        }

    }

    public function manageofferbuy($code)
    {

        $data['offer'] = Cryptoffer::whereUser_id(Auth::id())->whereCode($code)->first();
        if(!$data['offer']){
            return response()->json(['status' => 0, 'message' => 'We cant find your market offer']);
        }
        $data['ptrade'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->where('status', 0)->get();
        $data['dtrade'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->where('dispute', 1)->get();
        $data['strade'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereStatus(1)->whereDispute(0)->wherePaid(1)->get();
        $data['successful'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereStatus(1)->whereDispute(0)->wherePaid(1)->sum('amount');
        $data['pending'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->orderby('id','desc')->where('status', 0 || 'dispute', 1)->sum('amount');
        $data['declined'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereDispute(1)->sum('amount');
        $data['suc'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereStatus(1)->whereDispute(0)->wherePaid(1)->count();
        $data['pend'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereStatus(0)->count();
        $data['dec'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->whereDispute(1)->count();
        $data['count'] = Cryptotrade::whereUser_id(Auth::id())->whereMarketcode($code)->count();

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data'=>$data]);

    }


}
