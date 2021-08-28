<?php

namespace App\Http\Controllers\Api;

use App\Cryptoffer;
use App\Cryptowallet;
use App\Curr;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Paymentmethod;
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
            $data['offer'] = Cryptoffer::whereCoin_id($coin)->where('status', 1)->orderBy('id','desc')->paginate(10);
            $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        else{
            $data['offer'] = Cryptoffer::whereCoin_id($coin)->where('status', 1)->whereCountry($country)->orderBy('id','desc')->get();
            $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }


}
