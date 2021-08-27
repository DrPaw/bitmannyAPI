<?php

namespace App\Http\Controllers\Api;

use App\Cryptotrx;
use App\Cryptowallet;
use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function swappable()
    {
        $data['currency'] = Currency::where('status', '!=', 0)->whereCanswap(1)->orderBy('name','asc')->get();
        $data['wallets'] = Cryptowallet::where('user_id', auth()->id())->get();
        $data['trade'] = Cryptotrx::whereType('swap')->where('user_id', auth()->id())->get();
        return response()->json(['status' => 1, 'message' => "Fetched successfully", 'data' => $data]);
    }

    public function swapcoin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $from = Currency::where('id', $request->from)->where('status', 1)->whereCanswap(1)->first();
        $to = Currency::where('id', $request->to)->where('status', 1)->whereCanswap(1)->first();

        if($request->from == $request->to){
            return response()->json(['status' => 0, 'message' => 'You cant swap same currency']);
        }

        if(!$from){
            return response()->json(['status' => 0, 'message' => 'You cant swap from this currency']);
        }
        if(!$to){
            return response()->json(['status' => 0, 'message' => 'You cant swap to this currency']);
        }
        $fromwallet = Cryptowallet::where('coin_id', $request->from)->where('user_id', Auth::id())->first();
        $towallet = Cryptowallet::where('coin_id', $request->to)->where('user_id', Auth::id())->first();



        if(!$fromwallet){
            return response()->json(['status' => 0, 'message' => 'You dont have '.$from->name.' wallet yet. Please create one first']);
        }

        if(!$towallet){
            return response()->json(['status' => 0, 'message' => 'You dont have '.$to->name.' wallet yet. Please create one first']);
        }

        //$charge = $request->amount/100*$from->swap;
        $total = $request->amount;
        $totalunit = $request->amount/$from->price;
        $fromunit = $total/$from->price;
        $tounit = $total/$to->price;
        $tounit =  number_format($tounit,8);

        $get = $tounit + $towallet->balance;
        $getunit = number_format($get,8);

        if ($totalunit > $fromwallet->balance) {

            return response()->json(['status' => 0, 'message' => 'Insufficient '.$from->name.' Balance']);
        }
        else {

            $fromwallet->balance -= number_format($totalunit,8);
            $fromwallet->save();

            $towallet->balance = $getunit;
            $towallet->save();

            $w['user_id'] = Auth::id();
            $w['coin_id'] = $request->from;
            $w['amount'] = $total;
            $w['to_address'] = $towallet->address;
            $w['usd'] = $request->amount;
            $w['address'] = $fromwallet->address;
            $w['type'] = 'swap';
            $w['hash'] = $from->swap;
            $w['trxid'] = getTrx();
            $w['explorer_url'] = $from->name;
            $w['wallet_id'] = $to->name;
            $w['status'] = 1;
            $result = Cryptotrx::create($w);

            return response()->json(['status' => 1, 'message' => "Swapped successfully"]);
        }
    }
}
