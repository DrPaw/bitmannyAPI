<?php

namespace App\Http\Controllers\Api;

use App\Cryptowallet;
use App\Curr;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Paymentmethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{

    public function create()
    {

        $data['crypto'] = Currency::where('status', 1)->whereCanoffer(1)->orderBy('name','asc')->get();

        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }

    public function createoffer2($id)
    {

        $data['crypto'] = Currency::where('status', 1)->whereSymbol($id)->whereCanoffer(1)->orderBy('name','asc')->first();
        $data['curr'] = Curr::where('status', 1)->orderBy('name','asc')->get();
        $data['pmethod'] = Paymentmethod::where('status', 1)->orderBy('name','asc')->get();
        if(!$data['crypto']){
            return response()->json(['status' => 0, 'message' => 'Invalid cryptocurrency']);
        }
        $data['wallet'] = Cryptowallet::where('status', 1)->whereUser_id(Auth::id())->whereCoin_id($data['crypto']->id)->orderBy('id','asc')->get();

        return response()->json(['status' => 1, 'message' => 'Fetched Successfully', 'data'=>$data]);
    }


    public function postoffer(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'pmethod' => 'required',
            'account' => 'required',
            'note' => 'required',
            'min' => 'required',
            'currency' => 'required',
            'max' => 'required',
            'expire' => 'required',
            'rate' => 'required'
        ]);


        //$wallet = Cryptowallet::where('status', 1)->whereUser_id(Auth::id())->whereId($request->wallet)->orderBy('id','asc')->first();
        //$countwallet = Cryptowallet::where('status', 1)->whereUser_id(Auth::id())->whereId($request->wallet)->orderBy('id','asc')->count();
        $country = Curr::where('status', 1)->whereId($request->currency)->first();
        if(!$country){
            $notify[] = ['error', 'Invalid Country/Currency or address not found'];
            return back()->withNotify($notify)->withInput();
        }
        if($request->min >= $request->max){
            $notify[] = ['error', 'Invakid range. Your maximum amount must be greater than minimum'];
            return back()->withNotify($notify)->withInput();
        }

        $crypto = Currency::where('status', 1)->whereId($id)->orderBy('name','asc')->first();
        if(!$crypto){
            $notify[] = ['error', 'Invalid cryptocurrency or cryptocurrency  not found'];
            return back()->withNotify($notify)->withInput();
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
        $w['payment_method'] = $request->pmethod;
        $w['account'] = $request->account;
        $w['note'] = $request->note;
        $w['type'] = 1;

        $result = Cryptoffer::create($w);
        if($result){
            $notify[] = ['success', 'Your new crypto offer has been created'];
            return redirect()->route('user.myoffers')->withNotify($notify);
        }
        else{
            $notify[] = ['error', 'Sorry we cant create your offer at the moment , please contact admin'];
            return back()->withNotify($notify)->withInput();
        }
    }

    public function myoffers()
    {

        $data['offers'] = Cryptoffer::whereUser_id(Auth::id())->whereType(1)->orderBy('id','desc')->paginate(10);
        $data['page_title'] = "My Offers";

        return view('user.offers.myoffers', $data);
    }

}
