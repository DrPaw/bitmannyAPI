<?php

namespace App\Http\Controllers\Api;

use App\Cryptotrx;
use App\Cryptowallet;
use App\Currency;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{

    public function createwalletget()
    {
        $data['wallets'] = Currency::where('status', 1)->get();

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data' =>$data]);
    }

    public function createwallet(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'symbol' => 'required',
            'label' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'incomplete request', 'error' => $validator->errors()]);
        }

        $currency = Currency::where('status', '!=', 0)->whereCanwallet(1)->whereSymbol($input['symbol'])->first();
        $walletcount = Cryptowallet::where('user_id', auth()->id())->whereCoin_id($currency->id)->whereLabel($request->label)->where('status', 1)->count();

        if($walletcount > 0){
            return response()->json(['status' => 0, 'message' => 'You already have a '.$currency->name.' wallet with this label. Please try another label']);
        }
        $general = GeneralSetting::first();
        $label = $request->label;;
        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-new-address";
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
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'label' => $label),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);
        //return $response;

        if (!isset($reply['flag'])){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        if ($reply['flag'] != '1'){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        $address = $reply['data']['address'];
        $qrcode = $reply['data']['qr_code'];

        $w['user_id'] = Auth::id();
        $w['address'] = $address;
        $w['qrcode'] = $qrcode;
        $w['coin_id'] = $currency->id;
        $w['label'] = $label;
        $w['balance'] = 0;
        $w['status'] = 1;
        $result = Cryptowallet::create($w);

        if($result){
            return response()->json(['status' => 1, 'message' => 'Your new '.$currency->name.' wallet has been created successfully.']);
        }
    }

    public function wallets()
    {
        $data['wallets'] = Cryptowallet::join("currencies", "cryptowallets.coin_id", "=", "currencies.id")->where([['cryptowallets.user_id', auth()->id()], ['cryptowallets.status', 1],])->select("cryptowallets.*", "currencies.name", "currencies.symbol" )->get();

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data' =>$data]);
    }

    public function wallet($id)
    {
        $currency = Currency::where('status', '!=', 0)->whereCanwallet(1)->whereSymbol($id)->first();
        $data['wallets'] = Cryptowallet::where('user_id', auth()->id())->whereStatus(1)->whereCoin_id($currency->id)->get();
        $data['unit'] = Cryptowallet::where('user_id', auth()->id())->whereStatus(1)->whereCoin_id($currency->id)->sum('balance');

        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/get-coin-rate";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'fiat_amount' => 1,'fiat_symbol' => 'USD'),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);
        //return $response;
        $data['trx'] = Cryptotrx::where('user_id', auth()->id())->whereCoin_id($currency->id)->take(5)->latest()->get();


        if (!isset($reply['msg'])){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        if ($reply['msg'] != 'success'){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        $data['rate'] = $reply['data'][$currency->symbol]['price'];
        $data['usd'] = $data['rate'] * $data['unit'];
        foreach ($data['wallets'] as $dataw)
        {
            $usdrate = $data['rate'] * $dataw->balance;
            $dataw->usd = $usdrate;
            $dataw->save();
        }

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data' =>$data]);

    }

    public function viewaddress($id)
    {
        $wallet = Cryptowallet::where('user_id', auth()->id())->where('address', $id)->where('status', 1)->first();
        if(!$wallet){
            return response()->json(['status' => 0, 'message' => 'Invalid Wallet or Wallet Not Found']);
        }
        $currency = Currency::where('id', $wallet->coin_id)->where('status', 1)->whereCanwallet(1)->first();
        if(!$currency){
            return response()->json(['status' => 0, 'message' => 'Invalid Currency or Currency Not Found']);
        }

//        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-transaction-by-address";
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => $baseurl,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'address' => $wallet->address),
//        ));
//
//        $response = curl_exec($curl);
//        $reply = json_decode($response,true);
//        curl_close($curl);
        //return $response;

        $data['trx'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->take(5)->latest()->get();
        $data['sent_trx'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->get();
        $data['received_trx'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->get();
        //$trx = $reply['data'];
        $data['tsent_usd_sum'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->sum('usd');
        $data['tsent_amount_sum'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->where('type', 'send')->sum('amount');
        $data['trec_usd_sum'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->sum('usd');
        $data['trec_amount_sum'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->whereType('receive')->sum('amount');
        $data['balance_usd'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->sum('usd');
        $data['balance_amount'] = Cryptotrx::where('user_id', auth()->id())->where('address', $id)->orderby('id','desc')->sum('amount');

        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data'=>$data]);

    }

    public function sendfromwallet(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'address' => 'required',
            'currency' => 'required',
            'amount' => 'required',
            'id' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'incomplete request', 'error' => $validator->errors()]);
        }

        $id = $request->id;
        $currency = Currency::where('id', $request->currency)->where('status', 1)->whereCanwallet(1)->first();
        if(!$currency){
            return response()->json(['status' => 0, 'message' => 'Invalid Currency or Currency Not Found']);
        }

        $wallet = Cryptowallet::where('user_id', auth()->id())->where('id', $id)->whereCoin_id($currency->id)->where('status', 1)->first();

        if(!$wallet){
            return response()->json(['status' => 0, 'message' => 'Invalid Wallet']);
        }

        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-fiat-to-crypto-rate";
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
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'fiat_amount' => $request->amount,'fiat_symbol' => 'USD'),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);

        //return $response;

        if (!isset($reply['msg'])){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        if ($reply['flag'] != '1'){
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        $unit = $reply['data']['crypto_amount'];

        if ($wallet->balance < $unit) {
            return response()->json(['status' => 0, 'message' => 'You do not have enough fund in your wallet to send.']);
        }

        else {
            $trx = getTrx();
            $general = GeneralSetting::first();
            $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/validate-address";
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
                CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'address' => $request->address),
            ));

            $response = curl_exec($curl);
            $reply = json_decode($response,true);
            curl_close($curl);
            //return $response;

            if (!isset($reply['msg'])){
                return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
            }
            if ($reply['flag'] != '1'){
                return response()->json(['status' => 0, 'message' => 'Invalid '.$currency->name.' Wallet Address']);
            }

            if ($reply['flag'] = '1'){
                $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/withdraw";
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
                    CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'to_address' => $request->wallet,'amount' => $unit),
                ));

                $response = curl_exec($curl);
                $reply = json_decode($response,true);
                curl_close($curl);

                //return $reply;

                if (!isset($reply['msg'])){
                    return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
                }
                if ($reply['flag'] != '1'){
                    return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
                }
                if ($reply['flag'] == '1'){

                    $w['user_id'] = Auth::id();
                    $w['coin_id'] = $currency->id;
                    $w['amount'] = $unit;
                    $w['to_address'] = $reply['data']['to_address'];
                    $w['usd'] = $request->amount;
                    $w['address'] = $wallet->address;
                    $w['type'] = 'send';
                    $w['hash'] = $reply['data']['txid'];
                    $w['trxid'] = $reply['data']['id'];
                    $w['explorer_url'] = $reply['data']['explorer_url'];
                    $w['wallet_id'] = $reply['data']['wallet_id'];
                    $w['status'] = 1;
                    $result = Cryptotrx::create($w);


                    $fee = $currency->fee/100;
                    $charge = $fee*$unit;
                    $total = $charge + $reply['data']['total_amount'];
                    $wallet->balance -= $total;
                    $wallet->save();

                    if($result){
                        return response()->json(['status' => 1, 'message' => 'You have successfully sent '.$currency->name.' to the wallet address.']);
                    }
                }

            }

        }
    }


}
