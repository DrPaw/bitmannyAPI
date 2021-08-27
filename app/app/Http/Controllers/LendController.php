<?php

namespace App\Http\Controllers;

use App\CommissionLog;
use App\Cryptoescrow;
use App\Paymentmethod;
use App\GeneralSetting;
use App\Currency;
use App\Lib\GoogleAuthenticator;
use App\Cryptowallet;
use App\SupportAttachment;
use App\SupportMessage;
use App\SupportTicket;
use App\Curr;
use App\Trx;
use App\User;
use App\UserWallet;
use App\Lendoffer;
use App\Cryptorating;
use App\Lendtrade;
use App\Cryptotradechat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;
use File;
use Validator;
use Session;


class LendController extends Controller
{

   public function newlend()
    {

        $data['crypto'] = Currency::where('status', 1)->whereCanoffer(1)->orderBy('name','asc')->get();
        $data['page_title'] = "Select Currency";
        return view('user.lend.create', $data);
    }

   public function createofferlend($id)
    {

        $data['crypto'] = Currency::where('status', 1)->whereSymbol($id)->whereCanoffer(1)->orderBy('name','asc')->first();
        $data['country'] = Curr::where('status', 1)->orderBy('name','asc')->get();
        $data['pmethod'] = Paymentmethod::where('status', 1)->orderBy('name','asc')->get();
        if(!$data['crypto']){
        $notify[] = ['error', 'Invalid cryptocurrency'];
        return back()->withNotify($notify)->withInput();
        }
        $data['wallet'] = Cryptowallet::where('status', 1)->whereUser_id(Auth::id())->whereCoin_id($data['crypto']->id)->orderBy('id','asc')->get();

        $data['page_title'] = "Create New Lending Offer";

        return view('user.lend.create-step2', $data);
    }


   public function createlendpost(Request $request, $id)
    {
         $this->validate($request, [
            'wallet' => 'required',
            'mintime' => 'required',
            'maxtime' => 'required',
            'note' => 'required',
            'min' => 'required',
            'currency' => 'required',
            'max' => 'required',
            'percent' => 'required',
            'rate' => 'required'
        ]);


         if($request->min >= $request->max){
        $notify[] = ['error', 'Invalid range. Your maximum amount must be greater than minimum'];
        return back()->withNotify($notify)->withInput();
        }

        $crypto = Currency::where('status', 1)->whereSymbol($id)->orderBy('name','asc')->first();
        if(!$crypto){
        $notify[] = ['error', 'Invalid cryptocurrency or cryptocurrency  not found'];
        return back()->withNotify($notify)->withInput();
        }


            $w['coin_id'] = $crypto->id; // wallet method ID
            $w['user_id'] = Auth::id();
            $w['code'] = getTrx();
            $w['min'] = $request->min;
            $w['max'] = $request->max;
            $w['rate'] = $request->rate;
            $w['percent'] = $request->percent;
            $w['country'] = $request->currency;
            $w['mintime'] = $request->mintime;
            $w['maxtime'] = $request->maxtime;
            $w['wallet'] = $request->wallet;
            $w['note'] = $request->note;

            $result = Lendoffer::create($w);
            if($result){
            $notify[] = ['success', 'Your new crypto offer has been created'];
            return redirect()->route('user.mylendoffers')->withNotify($notify);
            }
            else{
             $notify[] = ['error', 'Sorry we cant create your offer at the moment , please contact admin'];
             return back()->withNotify($notify)->withInput();
            }
    }

      public function mylendoffers()
    {
        $data['offers'] = Lendoffer::whereUser_id(Auth::id())->orderBy('id','desc')->paginate(10);
        $data['page_title'] = "My Lending Offers";
        return view('user.lend.myoffers', $data);
     }

    public function deleteofferlend($id)
    {

        $offer = Lendoffer::whereUser_id(Auth::id())->whereCode($id)->first();
         if(!$offer){
        $notify[] = ['error', 'We cant find your market offer'];
        return back()->withNotify($notify)->withInput();
            }
         $offer->delete();
         $notify[] = ['success', 'Lending Offer Deleted Successfully'];
        return back()->withNotify($notify)->withInput();
    }

    public function disableofferlend($id)
    {

        $offer = Lendoffer::whereUser_id(Auth::id())->whereCode($id)->first();
         if(!$offer){
        $notify[] = ['error', 'We cant find your market offer'];
        return back()->withNotify($notify)->withInput();
            }
        $offer->status = 0;
        $offer->save();
         $notify[] = ['success', 'Lending Offer Deactivated Successfully'];
        return back()->withNotify($notify)->withInput();
    }

    public function activateofferlend($id)
    {

        $offer = Lendoffer::whereUser_id(Auth::id())->whereCode($id)->first();
         if(!$offer){
        $notify[] = ['error', 'We cant find your market offer'];
        return back()->withNotify($notify)->withInput();
            }
        $offer->status = 1;
        $offer->save();
         $notify[] = ['success', 'Lending Offer Activated Successfully'];
        return back()->withNotify($notify)->withInput();
    }
     public function manageofferlend($id)
    {
        $data['offer'] = Lendoffer::whereUser_id(Auth::id())->whereCode($id)->first();
        if(!$data['offer'])
        {
        $notify[] = ['error', 'We cant find your market offer'];
        return back()->withNotify($notify)->withInput();
        }

        $data['currency'] = Currency::where('status', 1)->whereId($data['offer']->coin_id)->orderBy('name','asc')->first();
        $data['ptrade'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->where('status', 0)->get();
        $data['utrade'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->where('status', 2)->get();
        $data['strade'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->whereStatus(1)->whereDispute(0)->wherePaid(1)->get();
        $data['successful'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->whereStatus(1)->whereDispute(0)->wherePaid(1)->sum('units');
        $data['suc'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->whereStatus(1)->whereDispute(0)->wherePaid(1)->count();
        $data['pending'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->orderby('id','desc')->where('status', 0)->sum('units');
        $data['pend'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->orderby('id','desc')->where('status', 0)->count();
        $data['unpaid'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->orderby('id','desc')->where('status', 2)->sum('units');
        $data['unp'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->orderby('id','desc')->where('status', 2)->count();
        $data['count'] = Lendtrade::whereUser_id(Auth::id())->whereMarketcode($id)->count();
        $data['page_title'] = "Manage Lending Offer";
        return view('user.lend.trades', $data);
    }

   public function borrowcrypto()
    {

        $data['crypto'] = Currency::where('status', 1)->whereCanoffer(1)->orderBy('name','asc')->get();
        $data['country'] = Curr::where('status', 1)->orderBy('name','asc')->get();
        $data['page_title'] = "Search Lending Offer";

        return view('user.lend.search', $data);
    }

 public function searchp2plend(Request $request)
    {
         $this->validate($request, [
            'country' => 'required',
            'currency' => 'required',
        ]);

        //return $request->currency;


        $count = Lendoffer::whereCoin_id($request->currency)->where('status', 1)->orderBy('id','desc')->count();
       if($count < 1){
        $notify[] = ['error', 'We cant find any lending offer for the selected cryptocurrency'];
        return back()->withNotify($notify)->withInput();
       }
        $data['offer'] = Lendoffer::whereCoin_id($request->currency)->where('status', 1)->orderBy('id','desc')->get();
        $crypto = Currency::whereId($request->currency)->where('status', 1)->orderBy('id','desc')->first();
        if(!$crypto){
        $notify[] = ['error', 'cryptocurrency not found'];
        return back()->withNotify($notify)->withInput();
       }

        $data['page_title'] = "Search Lending Offer";
        $country = Curr::whereId($request->country)->first();

        if($request->country == 'allcount'){

        Session::put('country', $request->country);
        Session::put('coin', $request->currency);
        $notify[] = ['success', 'Available Lending Offers'];
        return redirect()->route('user.lendmarket')->withNotify($notify);
        }



        if(!$country){
        $notify[] = ['error', 'Country not found'];
        return back()->withNotify($notify)->withInput();
       }
        else
        {


        Session::put('country', $country);
        Session::put('coin', $request->currency);
        $data['offer'] = Lendoffer::whereCoin_id($request->currency)->where('status', 1)->whereCountry($request->country)->orderBy('id','desc')->get();
        $count = Lendoffer::whereCoin_id($request->currency)->where('status', 1)->whereCountry($request->country)->orderBy('id','desc')->count();

        if($count < 1)
        {
        $notify[] = ['error', 'We cant find any '.$crypto->name.' lending offer in '.$country->country.' at the moment'];
        return back()->withNotify($notify)->withInput();
        }

        $notify[] = ['success', 'Available Lending Offers'];
        return redirect()->route('user.lendmarket')->withNotify($notify);

        }

    }

       public function lendmarket()
    {
        $country = Session::get('country');
        $coin = Session::get('coin');
        if($country == 'allcount'){
        $data['offer'] = Lendoffer::whereCoin_id($coin)->where('status', 1)->orderBy('id','desc')->paginate(10);
        $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        else{
        $data['offer'] = Lendoffer::whereCoin_id($coin)->where('status', 1)->whereCountry($country)->orderBy('id','desc')->paginate(10);
        $data['coin'] = Currency::where('status', 1)->whereId($coin)->orderBy('name','asc')->first();
        }
        $data['page_title'] = "Lending Offers";

        return view('user.lend.market', $data);
    }


     public function viewlenderoffer($id)
    {

        $data['offer'] = Lendoffer::whereCode($id)->where('status', 1)->orderBy('id','desc')->first();
        if(! $data['offer']){
        $notify[] = ['error', 'Invalid Lending offer'];
        return back()->withNotify($notify)->withInput();
        }

        $data['coin'] = Currency::where('status', 1)->whereId($data['offer']->coin_id)->orderBy('name','asc')->first();

        if(! $data['coin']){
        $notify[] = ['error', 'Invalid Coin'];
        return back()->withNotify($notify)->withInput();
        }

       $data['curr'] = Curr::where('status', 1)->whereId($data['offer']->country)->orderBy('name','asc')->first();

        if(! $data['coin']){
        $notify[] = ['error', 'Invalid Currency'];
        return back()->withNotify($notify)->withInput();
        }


        $data['page_title'] = "View Lending Offer";
        $data['comment'] = Cryptorating::whereMarketcode($id)->where('seller', $data['offer']->user_id)->orderBy('id','desc')->get();
        $data['reply'] = Cryptorating::whereMarketcode($id)->where('seller', $data['offer']->user_id)->whereReply(1)->orderBy('id','desc')->get();
        $data['bought'] = Lendtrade::whereBuyer(Auth::id())->where('marketcode', $id)->wherePaid(1)->orderBy('id','desc')->count();

        $data['rating'] = Cryptorating::where('seller', $data['offer']->user_id)->orderBy('id','desc')->sum('rate');
        $data['comments'] = Cryptorating::where('seller', $data['offer']->user_id)->orderBy('id','desc')->count();

        return view('user.lend.view-offer', $data);
    }


       public function rateseller(Request $request, $id)
    {
         $this->validate($request, [
            'comment' => 'required|string',
            'rate' => 'required|int|max:5'
        ]);

        $offer = Lendoffer::where('code', $id)->orderBy('id','desc')->first();
        if(!$offer){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $now = Carbon::now();

        $trade = Lendtrade::where('marketcode', $id)->orderBy('id','desc')->first();

        if(!$trade){
        $notify[] = ['error', 'You cant comment on this trade. Please make a purchase first'];
        return back()->withNotify($notify)->withInput();
        }

        $rate = Cryptorating::where('marketcode', $id)->where('buyer', Auth::id())->orderBy('id','desc')->first();

        if(!$rate)
        {
            $t['seller'] = $offer->user_id;
            $t['comment'] = $request->comment;
            $t['marketcode'] = $id;
            $t['rate'] = $request->rate;
            $t['reply'] = 0;
            $t['buyer'] = Auth::id();
            $cht = Cryptorating::create($t);
            $notify[] = ['success', 'Seller Rated Successfuly'];
            return back()->withNotify($notify)->withInput();
        }

            $rate->comment = $request->comment;
            $rate->rate = $request->rate;
            $rate->save();


            $notify[] = ['success', 'Seller Rated Successfuly'];
            return back()->withNotify($notify)->withInput();


    }


       public function contactlender(Request $request, $id)
    {
          $this->validate($request, [
            'amount' => 'required|integer',
            'wallet' => 'required',
            'duration' => 'required',
            'collateral' => 'required'
        ]);

        $data['offer'] = Lendoffer::whereCode($id)->where('status', 1)->orderBy('id','desc')->first();

         if(! $data['offer']){
        $notify[] = ['error', 'Invalid lending offer'];
        return back()->withNotify($notify)->withInput();
        }
         $coin = Currency::where('status', 1)->whereId($data['offer']->coin_id)->orderBy('name','asc')->first();

           if(!$coin){
           $notify[] = ['error', 'Currency is currently disabled'];
           return back()->withNotify($notify)->withInput();
            }
        $seller = User::whereId($data['offer']->user_id)->first();
        $unit = $request->amount/$data['offer']->rate;


           if($request->duration > $data['offer']->maxtime){
             $notify[] = ['error', 'The maximum lending duration is '.$data['offer'] ->maxtime.' months'];
             return back()->withNotify($notify)->withInput();
            }

           if($request->duration < $data['offer']->mintime){
             $notify[] = ['error', 'The minimum lending duration is '.$data['offer'] ->mintime.' months'];
             return back()->withNotify($notify)->withInput();
            }
           if($unit > $data['offer']->max){
             $notify[] = ['error', 'You cant borrow more than '.$data['offer'] ->max.$coin->symbol];
             return back()->withNotify($notify)->withInput();
            }

            if($unit < $data['offer']->min){
             $notify[] = ['error', 'You cant borrow below the set '.$data['offer'] ->min.$coin->symbol];
             return back()->withNotify($notify)->withInput();
            }



             $now = Carbon::now();
            $code = getTrx();


         $fee =  $unit/100*$coin->fee;
         $interest =  $unit/100*$data['offer']->percent;
         $total = $fee + $unit;
         $return = $interest + $unit;

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
		  CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'amount' => $total,'name' => $code,'currency' => 'USD','expire_time' => 120, 'suceess_url' => url("#")),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);


		//return $response;
		if (!isset($reply['flag'])){
		$notify[] = ['error', 'An error occur'];
        return back()->withNotify($notify);
        }

		if ($reply['flag'] != 1){
		$notify[] = ['error', $reply['msg'] ];
        return back()->withNotify($notify);
        }

		if (!isset($reply['data']['status_code'])){
		$notify[] = ['error', 'An error occur. We cant create an escrow wallet for this trade now'];
        return back()->withNotify($notify);
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
            $w['duration'] = $request->duration;
            $w['interest'] = $data['offer']->perecnt;
            $w['loanreturn'] = $return;
            $w['units'] = $coinvalue;
            $w['escrowwallet'] = $address;
            $w['escrowid'] = $invoiceid;
            $w['escrowvalue'] = $coinvalue;
            $w['escrowusd'] = $coinusd;
            $w['escrowfee'] = $escrowfee;
            $w['escrowpay'] = $escrowpay;
            $w['buyer'] = Auth::id();
            $w['paid'] = 0;
            $w['expire'] = $now->addMinutes(120);
            $result = Lendtrade::create($w);

            $t['receiver'] = $data['offer']->user_id;
            $t['message'] = "Hi, i want to borrow ".$unit.$coin->name;
            $t['marketcode'] = $data['offer']->code;
            $t['tradecode'] = $code;
            $t['type'] = 1;
            $t['sender'] = Auth::id();
            $cht = Cryptotradechat::create($t);

            $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $seller->username;
            $subject = 'Pending Loan Request';
            $message = 'You have a pending '.$unit.$coin->name.' loan request. Please login to your account to attend to request.';
            try {
            send_general_email($seller->email, $subject, $message, $receiver_name);
             } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
                 }



            Session::put('trx',  $w['trx']);
            if($result){
            $data['page_title'] = "Contact Seller";
            $notify[] = ['success', 'Your new crypto offer has been created and please wait while your coin is collected into the escrow wallet for you.'];
            return redirect()->route('user.chatbuyerlend')->withNotify($notify);
            }
            else{
             $notify[] = ['error', 'Sorry we cant patch you with the seller at the moment , please contact admin'];
             return back()->withNotify($notify)->withInput();
            }

    }

      public function chatbuyerlend()
    {
        $trx = Session::get('trx');
        $data['trade'] = Lendtrade::whereBuyer(Auth::id())->where('trx', $trx)->orderBy('id','desc')->first();
        $data['offer'] = Lendoffer::whereCode($data['trade']->marketcode)->orderBy('id','desc')->first();
        $data['coin'] = Currency::whereId($data['offer']->coin_id)->orderBy('id','desc')->first();
        $data['chat'] = Cryptotradechat::whereTradecode($data['trade']->trx)->orderBy('id','desc')->get();
        if(! $data['offer']){
        $notify[] = ['error', 'Invalid market offer'];
        return back()->withNotify($notify)->withInput();
        }
        $data['now'] = Carbon::now();
        $data['page_title'] = "Chet Seller";
        $data['escrow'] = Cryptoescrow::whereTrade_code($data['trade']->trx)->first();


        return view('user.lend.chatbuyer', $data);
    }

      public function replychatbuyerlend(Request $request)
    {
         $this->validate($request, [
            'message' => 'required|string'
        ]);

        $data['trade'] = Lendtrade::whereBuyer(Auth::id())->where('id', $request->id)->orderBy('id','desc')->first();
        if(! $data['trade']){
        $notify[] = ['error', 'Invalid market trade'];
        return back()->withNotify($notify)->withInput();
        }
        $now = Carbon::now();
        /*
        if( $data['trade']->expire < $now){
         $notify[] = ['error', 'Payment timer has elapsed. Trade has been closed by psystem. You can no longer continue this trade'];
        return back()->withNotify($notify)->withInput();
        } */

            $t['receiver'] = $data['trade']->user_id;
            $t['message'] = $request->message;
            $t['marketcode'] = $data['trade']->marketcode;
            $t['tradecode'] = $data['trade']->trx;
            $t['type'] = 1;
            $t['sender'] = Auth::id();
            $cht = Cryptotradechat::create($t);
            return back();


    }


       public function chatlender($id)
    {
        $data['trade'] = Lendtrade::whereUser_id(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();

        //return $id.$data['trade'];
        $data['offer'] = Lendoffer::whereCode($data['trade']->marketcode)->orderBy('id','desc')->first();
        $data['coin'] = Currency::whereId($data['offer']->coin_id)->orderBy('id','desc')->first();
        $data['chat'] = Cryptotradechat::whereTradecode($id)->orderBy('id','desc')->get();
        if(! $data['offer']){
        $notify[] = ['error', 'Invalid lend offer'];
        return back()->withNotify($notify)->withInput();
        }
        $data['escrow'] = Cryptoescrow::whereTrade_code($id)->first();

        $data['page_title'] = "Chat Seller";
        $data['now'] = Carbon::now();

        return view('user.lend.chatseller', $data);
    }

        public function escrowpaidlend($id)
    {

        $general = GeneralSetting::first();
        $trade = Lendtrade::whereUser_id(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();
         if(!$trade){
          $notify[] = ['error', 'Invalid Transaction'];
            return back()->withNotify($notify);
        }


        $currency = Currency::where('id', $trade->coin)->first();


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
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'invoice_id' => $trade->escrowid),
		));

        $response = curl_exec($curl);
        //return $response;
        $reply = json_decode($response,true);
        curl_close($curl);

        //return $reply;

        if (!isset($reply['data']['status_code'])){
          $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
        }

        if($reply['data']['status'] == "Expired"){
         $notify[] = ['error', 'This Transaction Has Expired. It appeared that you didnt send any bitcoin before transaction expired'];
            return back()->withNotify($notify);
        }
        if($reply['data']['status'] == "Pending"){
          $notify[] = ['error', 'We have not received your payment into the escrow wallet. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);

        }

        $status = $reply['data']['status_code'];

        if($status==0){
         $notify[] = ['error', 'We have not received your payment yet. Kindly Scan The QR code or copy Wallet Address to make payment'];
            return back()->withNotify($notify);
        }

        $buyer = User::whereId($trade->buyer)->first();
        if($buyer)
        {
          $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $buyer->username;
            $subject = 'Fund Held On Escrow';
            $message = 'Fund has been safely held on escrow for your pending trade with transaction number'.$trade->trx.' Please proceed with trade';
            try {
            send_general_email($buyer->email, $subject, $message, $receiver_name);
             } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
                 }

        }

           if($status==1 || $status==3)
           {

            $esc['user_id'] = $trade->user_id;
            $esc['coin_id'] = $trade->coin;;
            $esc['trade_code'] = $trade->trx;
            $esc['amount'] = $reply['data']['total_amount'][$currency->symbol];
            $esc['usd'] = $reply['data']['total_amount']['USD'];;
            $esc['paidamount'] = $reply['data']['conversion_rate']['USD_'.$currency->symbol];
            $esc['paidusd'] = $reply['data']['usd_amount'];
            $esc['wallet_id'] = $reply['data']['address'];
            $esc['status'] = 0;
            $scrow = Cryptoescrow::create($esc);
            $notify[] = ['success', 'Payment Into Escrow Was Successful'];
            return back()->withNotify($notify);
           }

    }


       public function replychatsellerlend(Request $request)
    {
         $this->validate($request, [
            'message' => 'required|string'
        ]);

        $data['trade'] = Lendtrade::whereUser_id(Auth::id())->where('id', $request->id)->orderBy('id','desc')->first();

        if(! $data['trade']){
        $notify[] = ['error', 'Invalid lending offer'];
        return back()->withNotify($notify)->withInput();
        }
        $now = Carbon::now();
       /* if( $data['trade']->expire < $now){
         $notify[] = ['error', 'Trade closed by payment window timer. You can no longer continue this trade'];
        return back()->withNotify($notify)->withInput();
        } */

            $t['receiver'] = Auth::id();
            $t['message'] = $request->message;
            $t['marketcode'] = $data['trade']->marketcode;
            $t['tradecode'] = $data['trade']->trx;
            $t['type'] = 2;
            $t['sender'] = $data['trade']->user_id;
            $cht = Cryptotradechat::create($t);
            return back();


    }

        public function colateralpaid($id)
    {


        $trade = Lendtrade::whereBuyer(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid lending offer'];
        return back()->withNotify($notify)->withInput();
        }

         $now = Carbon::now();
      /*  if( $trade->expire < $now){
         $notify[] = ['error', 'Trade closed by payment window timer. You can no longer continue this trade'];
        return back()->withNotify($notify)->withInput();
        } */

         $buyer = User::whereId($trade->buyer)->first();
        if($buyer)
        {
          $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $buyer->username;
            $subject = 'You Submitted Collateral';
            $message = 'You have Submitted Collateral on your pending borrowing request with transaction number'.$trade->trx.' Please wait while lender approves from his side. You can initiate a dispute for this trade if lender fails to approve as due';
            try {
            send_general_email($buyer->email, $subject, $message, $receiver_name);
             } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
                 }

        }

        $trade->paid = 1;
        $trade->save();
        $notify[] = ['success', 'You have declared payment for this trade.Please wait whhile lender confirms your payment. You can click on dispute button from your trade log to log a dispute on this trade if you see a foul play'];
        return back()->withNotify($notify)->withInput();

    }

         public function loanapprove($id)
    {


        $trade = Lendtrade::whereUser_id(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();
        $escrow = Cryptoescrow::whereUser_id($trade->user_id)->whereTrade_code($trade->trx)->where('status', 1)->orderBy('id','desc')->first();
        $wallet = Cryptowallet::whereUser_id($trade->buyer)->whereId($trade->wallet)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid lending offer'];
        return back()->withNotify($notify)->withInput();
        }
        if(!$escrow){
        $notify[] = ['error', 'No fund in escrow or escrow account not found'];
        return back()->withNotify($notify)->withInput();
        }

        $now = Carbon::now();
        /*
        if( $trade->expire < $now){
         $notify[] = ['error', 'Trade closed by payment window timer. You can no longer continue this trade'];
        return back()->withNotify($notify)->withInput();
        } */

        /*
        if(!$wallet){
        $notify[] = ['error', 'Invalid buyer wallet or wallet address not found'];
        return back()->withNotify($notify)->withInput();
        } */



         if($trade->status == 2){
         $notify[] = ['error', 'You have already approved this loan'];
            return back()->withNotify($notify);
        }
        $trade->status = 2;
        //$trade->disbursed = 1;
        $trade->save();

          $buyer = User::whereId($trade->buyer)->first();
        if($buyer)
        {
            $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $buyer->username;
            $subject = 'Lender Approved Loan';
            $message = 'The lender of your pending loan with transaction number'.$trade->trx.' has approved the loan. Coin will be disbursed to you soon. Thank you for choosing'.$general->sitename;
            try {
            send_general_email($buyer->email, $subject, $message, $receiver_name);
             } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
                 }

        }

        //$wallet->balance += $escrow->amount;
        $notify[] = ['success', 'You have approved this loan, Coin will be disbursed to user once approved'];
        return back()->withNotify($notify)->withInput();

    }


      public function borrowinglog()
    {

        $data['trade'] = Lendtrade::whereBuyer(Auth::id())->orderBy('id','desc')->get();
         $data['page_title'] = "Lend History";

        return view('user.lend.p2p-log', $data);

    }

       public function lendchathistory($id)
    {
        $trx = $id;
        $data['trade'] = Lendtrade::whereBuyer(Auth::id())->where('trx', $trx)->orderBy('id','desc')->first();
        $data['offer'] = Lendoffer::whereCode($data['trade']->marketcode)->orderBy('id','desc')->first();
        $data['coin'] = Currency::whereId($data['offer']->coin_id)->orderBy('id','desc')->first();
        $data['chat'] = Cryptotradechat::whereTradecode($data['trade']->trx)->orderBy('id','desc')->get();
        if(! $data['offer']){
        $notify[] = ['error', 'Invalid Loan offer'];
        return back()->withNotify($notify)->withInput();
        }
        $data['now'] = Carbon::now();
        $data['page_title'] = "Chat Seller";

        $data['escrow'] = Cryptoescrow::whereTrade_code($data['trade']->trx)->first();
        //return $data['escrow'];

        return view('user.lend.chatbuyer', $data);
    }


         public function loandispute($id)
    {
        $trade = Lendtrade::whereBuyer(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid Loan Offer'];
        return back()->withNotify($notify)->withInput();
        }
        $trade->dispute = 1;
        $trade->save();
        $notify[] = ['success', 'You have initiated a dispute for this loan'];
        return back()->withNotify($notify)->withInput();

    }

         public function closeloandispute($id)
    {
        $trade = Lendtrade::whereBuyer(Auth::id())->where('trx', $id)->orderBy('id','desc')->first();

        if(! $trade){
        $notify[] = ['error', 'Invalid Lending Offer'];
        return back()->withNotify($notify)->withInput();
        }
        $trade->dispute = 0;
        $trade->save();
        $notify[] = ['success', 'You have closed the dispute for this loan offer'];
        return back()->withNotify($notify)->withInput();

    }














}
