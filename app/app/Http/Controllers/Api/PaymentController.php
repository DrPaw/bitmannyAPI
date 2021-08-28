<?php

namespace App\Http\Controllers\Api;

use App\Cryptowallet;
use App\Currency;
use App\Deposit;
use App\GatewayCurrency;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function depositInsert(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'amount' => 'required|numeric|min:1'
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $method_code="107";
        $currency="NGN";

        $user = auth()->user();
        $now = \Carbon\Carbon::now();

        $gate = GatewayCurrency::where('method_code', $method_code)->where('currency', $currency)->first();

        if (!$gate) {
            return response()->json(['status' => 0, 'message' => 'Invalid Gateway Selected or Gateway Not Found']);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            return response()->json(['status' => 0, 'message' => 'Please Follow Deposit Limit']);
        }

        $charge = formatter_money($gate->fixed_charge + ($request->amount * $gate->percent_charge / 100));

        $payable = formatter_money($request->amount + $charge);

        $final_amo = formatter_money($payable /$gate->rate);

        $depo['user_id'] = $user->id;
        $depo['method_code'] = $gate->method_code;
        $depo['method_currency'] = strtoupper($gate->currency);
        $depo['amount'] = $request->amount;
        $depo['charge'] = $charge;
        $depo['rate'] = $gate->rate;
        $depo['final_amo'] = formatter_money($final_amo);
        $depo['btc_amo'] = 0;
        $depo['btc_wallet'] = "";
        $depo['trx'] = getTrx();
        $depo['try'] = 0;
        $depo['status'] = 0;

        $data = Deposit::create($depo);

        return response()->json(['status' => 1, 'message' => 'Deposit Logged successfully', 'data'=>$depo['trx']]);
    }

    public function paystackipn(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'reference' => 'required'
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $track = $request->reference;
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if(!$data){
            return response()->json(['status' => 0, 'message' => 'Reference not found']);
        }

        $paystackAcc = json_decode($data->gateway_currency()->parameter);
        $secret_key = $paystackAcc->secret_key;

        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/' . $track;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $secret_key]);
        $r = curl_exec($ch);
        curl_close($ch);

        if ($r) {
            $result = json_decode($r, true);

            if ($result) {
                if ($result['data']) {
                    if ($result['data']['status'] == 'success') {

                        $am = $result['data']['amount'];
                        $sam = round($data->amount, 2) * 100;

                        if ($am == $sam && $result['data']['currency'] == $data->method_currency  && $data->status == '0') {
                            PaymentController::userDataUpdate($data->trx);
                            return response()->json(['status' => 1, 'message' => 'Deposit Successful']);
                        } else {
                            return response()->json(['status' => 0, 'message' => 'Less Amount Paid. Please Contact With Admin']);
                        }
                    } else {
                        return response()->json(['status' => 0, 'message' => $result['data']['gateway_response']]);
                    }
                } else {
                    return response()->json(['status' => 0, 'message' => $result['message']]);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'Something went wrong while executing']);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong while executing']);
        }
    }

    public function depositcrypto()
    {
        $data['currency'] = Currency::where('status', 1)->get();
        $data['deposits'] = Deposit::with('gateway')->where('user_id', Auth::id())->where('status', '=', 1)->where('try', '=', 1)->latest()->get();

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data'=>$data]);
    }

    public function depositcryptopost(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'amount' => 'required|numeric',
            'currency' => 'required',
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = auth()->user();
        $now = \Carbon\Carbon::now();
        $currency = Currency::where('id', $request->currency)->where('status', 1)->first();
        $wallet = Cryptowallet::where('coin_id', $request->currency)->where('user_id', Auth::id())->where('status', 1)->first();

        if (!$currency) {
            return response()->json(['status' => 0, 'message' => 'Invalid Cryptocurrency Selected or Gateway Not Found']);
        }
        /* if (!$wallet) {

         $notify[] = ['error', 'Please Create A '.$currency->name.' Wallet First'];
         return back()->withNotify($notify);
         }*/

        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/create-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'amount' => $request->amount,'name' => getTrx(),'currency' => 'USD','expire_time' => 10, 'suceess_url' => url("/api/coinremittersuccesscallback")),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);
        //return $reply;
        if (!isset($reply['flag'])){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }

        if ($reply['flag'] != 1){
            return response()->json(['status' => 0, 'message' => $reply['msg']]);
        }

        $address = $reply['data']['address'];
        $invoiceid = $reply['data']['invoice_id'];
        $coinvalue = $reply['data']['total_amount'][$currency->symbol];

        $depo['user_id'] = $user->id;
        $depo['method_code'] = $request->currency;
        $depo['method_currency'] = strtoupper($currency->symbol);
        $depo['amount'] = $request->amount;
        $depo['charge'] = 0;
        $depo['rate'] = $currency->price;
        $depo['final_amo'] = formatter_money($request->amount);
        $depo['btc_amo'] = $coinvalue;
        $depo['btc_wallet'] = $address;
        $depo['trx'] = $invoiceid;
        $depo['try'] = 1;
        $depo['status'] = 0;

        $data = Deposit::create($depo);

        return response()->json(['status' => 1, 'message' => "Logged successfully", 'data'=>$depo]);
    }

    public function verifypay(Request $request, $id)
    {
        $general = GeneralSetting::first();
        $trade = Deposit::where('trx', $id)->whereStatus(0)->first();
        if(!$trade){
            $notify[] = ['error', 'Invalid Transaction'];
            return back()->withNotify($notify);
        }

        $currency = Currency::where('symbol', $trade->method_currency)->first();
        if(!$currency){
            $notify[] = ['error', 'Invalid Currency'];
            return back()->withNotify($notify);
        }

        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'invoice_id' => $trade->trx),
        ));

        $response = curl_exec($curl);
        //return $response;
        $reply = json_decode($response,true);
        curl_close($curl);

        //return $reply['data']['status_code'];

        if (!isset($reply['data']['status_code'])){
            $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
        }

        if($reply['data']['status'] == "Expired"){

            $trade->status= 2;
            $trade->save();
            $request->session()->forget('Track');
            $notify[] = ['error', 'This Transaction Has Expired. It appeared that you didnt send any bitcoin before transaction expired'];
            return redirect()->route('user.depositcrypto')->withNotify($notify);
        }
        if($reply['data']['status'] == "Pending"){
            $notify[] = ['error', 'We have not received your payment. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);

        }

        $status = $reply['data']['status_code'];

        if($status==0){
            $notify[] = ['error', 'We have not received your payment. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);
        }


        if($status==1 || $status==3){

            if($trade->status == 0){
                $authWallet = UserWallet::where('type', 'deposit_wallet')->where('user_id', Auth::id())->first();
                $authWallet->balance = $authWallet->balance + $trade->amount;
                $authWallet->save();

                $trade->status= 1;
                $trade->save();
                $request->session()->forget('Track');
                $notify[] = ['success', 'Deposit Successful'];
                return redirect()->route('user.deposit.crypto')->withNotify($notify);
            }
            else
            {
                $notify[] = ['success', 'Transaction Processed'];
                return back()->withNotify($notify);
            }

        }

    }


}
