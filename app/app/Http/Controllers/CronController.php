<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\UserWallet;
use App\Currency;
use App\Cryptowallet;
use Carbon\Carbon;
use App\Invest;
use App\Hodl;
use App\Hodltrx;
use App\Trx;
use App\User;
use Illuminate\Support\Facades\Request;

class CronController extends Controller
{

    public function hodl()
    {
        $now = Carbon::now();


            $invest = Hodltrx::whereStatus(1)->where('next_time','<=',$now)->get();


        $gnl = GeneralSetting::first();

        foreach ($invest as $data)
        {
            $user = User::find($data->user_id);
            $userInterestWallet = UserWallet::where('user_id',$data->user_id)->where('type','hodl_wallet')->first();
            $next_time = Carbon::parse($now)->addHours($data->hours);

            $in = Hodltrx::find($data->id);
            $in->return_rec_time = $data->return_rec_time + 1;
            $in->next_time = $next_time;
            $in->last_time = $now;

            if ($data->period == '-1')
            {
                $in->status = 1;
                $in->save();

                $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                $userInterestWallet->balance = $new_balance;

                Trx::create([
                    'user_id' => $user->id,
                    'amount' => $data->interest,
                    'main_amo' => $new_balance,
                    'charge' => 0,
                    'type' => '+',
                    'remark' => 'HODL',
                    'title' => 'HODL Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                    'trx' => getTrx(),
                ]);
                $userInterestWallet->save();

                if($gnl->invest_return_commission == 1){
                    $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                    levelCommision($user->id, $data->interest, $commissionType);
                }


            }else{

                if ($data->capital_status == 1)
                {

                    if ($in->return_rec_time >= $data->period){
                        $bonus = $data->interest + $data->amount;
                        $new_balance = formatter_money($userInterestWallet->balance + $bonus);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 0;
                    }else{
                        $bonus = 0;
                        $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 1;
                    }

                    $in->save();



                    if ($bonus != 0){

                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'HODL',
                            'title' => 'HODL Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }else{
                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest & Capital Return '.$bonus.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }


                    $userInterestWallet->save();



                }else{

                    if ($in->return_rec_time >= $data->period){
                        $in->status = 0;
                    }else{
                        $in->status = 1;
                    }

                    $in->save();

                    $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                    $userInterestWallet->balance = $new_balance;
                    $userInterestWallet->save();
                    Trx::create([
                        'user_id' => $user->id,
                        'amount' => $data->interest,
                        'main_amo' => $new_balance,
                        'charge' => 0,
                        'type' => '+',
                        'remark' => 'HODL',
                        'title' => 'HODL Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                        'trx' => getTrx(),
                    ]);


                    if($gnl->invest_return_commission == 1){
                        $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                        levelCommision($user->id, $data->interest, $commissionType);
                    }

                }

            }

        }


    return 'HODL Cron Job Successful';
    }


public function vault()
    {
        $now = Carbon::now();


            $invest = Invest::whereStatus(1)->where('next_time','<=',$now)->get();


        $gnl = GeneralSetting::first();

        foreach ($invest as $data)
        {
            $user = User::find($data->user_id);
            $userInterestWallet = UserWallet::where('user_id',$data->user_id)->where('type','interest_wallet')->first();
            $next_time = Carbon::parse($now)->addHours($data->hours);

            $in = Invest::find($data->id);
            $in->return_rec_time = $data->return_rec_time + 1;
            $in->next_time = $next_time;
            $in->last_time = $now;

            if ($data->period == '-1')
            {
                $in->status = 1;
                $in->save();

                $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                $userInterestWallet->balance = $new_balance;

                Trx::create([
                    'user_id' => $user->id,
                    'amount' => $data->interest,
                    'main_amo' => $new_balance,
                    'charge' => 0,
                    'type' => '+',
                    'remark' => 'interest',
                    'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                    'trx' => getTrx(),
                ]);
                $userInterestWallet->save();

                if($gnl->invest_return_commission == 1){
                    $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                    levelCommision($user->id, $data->interest, $commissionType);
                }


            }else{

                if ($data->capital_status == 1)
                {

                    if ($in->return_rec_time >= $data->period){
                        $bonus = $data->interest + $data->amount;
                        $new_balance = formatter_money($userInterestWallet->balance + $bonus);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 0;
                    }else{
                        $bonus = 0;
                        $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 1;
                    }

                    $in->save();



                    if ($bonus != 0){

                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }else{
                        Trx::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest & Capital Return '.$bonus.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                            'trx' => getTrx(),
                        ]);

                        if($gnl->invest_return_commission == 1){
                            $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                            levelCommision($user->id, $data->interest, $commissionType);
                        }

                    }


                    $userInterestWallet->save();



                }else{

                    if ($in->return_rec_time >= $data->period){
                        $in->status = 0;
                    }else{
                        $in->status = 1;
                    }

                    $in->save();

                    $new_balance = formatter_money($userInterestWallet->balance + $data->interest);
                    $userInterestWallet->balance = $new_balance;
                    $userInterestWallet->save();
                    Trx::create([
                        'user_id' => $user->id,
                        'amount' => $data->interest,
                        'main_amo' => $new_balance,
                        'charge' => 0,
                        'type' => '+',
                        'remark' => 'interest',
                        'title' => 'Interest Return '.$data->interest.' '.$gnl->cur_text.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                        'trx' => getTrx(),
                    ]);


                    if($gnl->invest_return_commission == 1){
                        $commissionType = formatter_money($data->interest) . ' '.$gnl->cur_text. ' Interest Commission';
                        levelCommision($user->id, $data->interest, $commissionType);
                    }

                }

            }

        }


    return 'VAULT Cron Job Successful';
    }



      public function coinrate()
    {
    $baseUrl = "https://api.alternative.me";
			$endpoint = "/v2/ticker/";
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

            $rate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);

        	$btc  = $rate['data']['1']['quotes']['USD']['price'];
        	$eth  = $rate['data']['1027']['quotes']['USD']['price'];
        	$bch  = $rate['data']['1831']['quotes']['USD']['price'];
        	$ltc  = $rate['data']['2']['quotes']['USD']['price'];
        	$dash  = $rate['data']['131']['quotes']['USD']['price'];
        	$usdt  = $rate['data']['825']['quotes']['USD']['price'];
        	$doge  = $rate['data']['74']['quotes']['USD']['price'];
        	$bnb  = $rate['data']['1839']['quotes']['USD']['price'];


        	 //return $usdt;

        	$btcp = Currency::whereSymbol('BTC')->first();
        	$btcp->price = $btc;
        	//$btcp->buy = $btc;
        	//$btcp->sell = $btc;
        	$btcp->save();

        	$btcwallet = Cryptowallet::whereCoin_id(2)->get();
        	foreach($btcwallet as $data)
        	{
        	$data->usd = $data->balance * $btc;
        	$data->save();

        	}
        	#############################################
        	$ethp = Currency::whereSymbol('ETH')->first();
        	$ethp->price = $eth;
        	//$ethp->buy = $eth;
        	//$ethp->sell = $eth;
        	$ethp->save();
        	#############################################
        	$bchp = Currency::whereSymbol('BCH')->first();
        	$bchp->price = $bch;
        	//$bchp->buy = $bch;
        	//$bchp->sell = $bch;
        	$bchp->save();
        	#############################################
        	$ltcp = Currency::whereSymbol('LTC')->first();
        	$ltcp->price = $ltc;
        	//$ltcp->buy = $ltc;
        	//$ltcp->sell = $ltc;
        	$ltcp->save();
        	#############################################
        	$usdtp = Currency::whereSymbol('USDT')->first();
        	$usdtp->price = $usdt;
        	//$usdtp->buy = $usdt;
        	//$usdtp->sell = $usdt;
        	$usdtp->save();
        	#############################################
        	$dogep = Currency::whereSymbol('DOGE')->first();
        	$dogep->price = $doge;
        	//$dogep->buy = $doge;
        	//$dogep->sell = $doge;
        	$dogep->save();
        	#############################################
        	$dashp = Currency::whereSymbol('DASH')->first();
        	$dashp->price = $dash;
        	//$dashp->buy = $dash;
        	//$dashp->sell = $dash;
        	$dashp->save();
        	#############################################
        	//$dashp = Currency::whereSymbol('BNB')->first();
        	//$dashp->price = $bnb;
        	//$dashp->buy = $bnb;
        	//$dashp->sell = $bnb;
        	//$dashp->save();
        	#############################################
        /*	$digo = Currency::whereId(12)->first();
        	$wbnb = $bnb * 0.29144 ;
        	//$wbnb = $bnb * $digo->pair / 100 ;
        	$digo->price = $wbnb;
        	$digo->save();

        	$digowallet = Cryptowallet::whereCoin_id(12)->get();
        	foreach($digowallet as $data)
        	{
        	$data->usd = $data->balance * $wbnb;
        	$data->save();

        	}
        	$bnbwallet = Cryptowallet::whereCoin_id(13)->get();
        	foreach($bnbwallet as $data)
        	{
        	$data->usd = $data->balance * $bnb;
        	$data->save();

        	}

        	return "Current BNB Price Is: $".$bnb."<br>
        	Current DGO Price Is: $".number_format($wbnb,4);*/

        	 return "Coin Price Updated!!!";

    }



      public function coinratehome()
    {
    $baseUrl = "https://api.alternative.me";
			$endpoint = "/v2/ticker/";
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

            $rate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);

        	$btc  = $rate['data']['1']['quotes']['USD']['price'];
        	$eth  = $rate['data']['1027']['quotes']['USD']['price'];
        	$bch  = $rate['data']['1831']['quotes']['USD']['price'];
        	$ltc  = $rate['data']['2']['quotes']['USD']['price'];
        	$dash  = $rate['data']['131']['quotes']['USD']['price'];
        	$usdt  = $rate['data']['825']['quotes']['USD']['price'];
        	$doge  = $rate['data']['74']['quotes']['USD']['price'];
        	$bnb  = $rate['data']['1839']['quotes']['USD']['price'];


        	 //return $usdt;

        	$btcp = Currency::whereSymbol('BTC')->first();
        	$btcp->lastprice = $btcp->price;
        	$btcp->price = $btc;
        	$btcp->save();

        
        	#############################################
        	$ethp = Currency::whereSymbol('ETH')->first();
        	$ethp->lastprice = $ethp->price;
        	
        	$ethp->price = $eth;
        	//$ethp->buy = $eth;
        	//$ethp->sell = $eth;
        	$ethp->save();
        	#############################################
        	$bchp = Currency::whereSymbol('BCH')->first();
        	$bchp->lastprice = $bchp->price;
        	
        	$bchp->price = $bch;
        	//$bchp->buy = $bch;
        	//$bchp->sell = $bch;
        	$bchp->save();
        	#############################################
        	$ltcp = Currency::whereSymbol('LTC')->first();
        	$ltcp->lastprice = $ltcp->price;
        	
        	$ltcp->price = $ltc;
        	//$ltcp->buy = $ltc;
        	//$ltcp->sell = $ltc;
        	$ltcp->save();
        	#############################################
        	$usdtp = Currency::whereSymbol('USDT')->first();
        	$usdtp->lastprice = $usdtp->price;
        	
        	$usdtp->price = $usdt;
        	//$usdtp->buy = $usdt;
        	//$usdtp->sell = $usdt;
        	$usdtp->save();
        	#############################################
        	$dogep = Currency::whereSymbol('DOGE')->first();
        	$dogep->lastprice = $dogep->price;
        	
        	$dogep->price = $doge;
        	//$dogep->buy = $doge;
        	//$dogep->sell = $doge;
        	$dogep->save();
        	#############################################
        	$dashp = Currency::whereSymbol('DASH')->first();
        	$dashp->lastprice = $dashp->price;
        	
        	$dashp->price = $dash;
        	//$dashp->buy = $dash;
        	//$dashp->sell = $dash;
        	$dashp->save();
        	#############################################
        	$dashp = Currency::whereSymbol('BNB')->first();
        	$dashp->lastprice = $dashp->price;
        	$dashp->price = $bnb;
        	//$dashp->buy = $bnb;
        	//$dashp->sell = $bnb;
        	$dashp->save();
        	#############################################
        /*	$digo = Currency::whereId(12)->first();
        	$wbnb = $bnb * 0.29144 ;
        	//$wbnb = $bnb * $digo->pair / 100 ;
        	$digo->price = $wbnb;
        	$digo->save();

        	$digowallet = Cryptowallet::whereCoin_id(12)->get();
        	foreach($digowallet as $data)
        	{
        	$data->usd = $data->balance * $wbnb;
        	$data->save();

        	}
        	$bnbwallet = Cryptowallet::whereCoin_id(13)->get();
        	foreach($bnbwallet as $data)
        	{
        	$data->usd = $data->balance * $bnb;
        	$data->save();

        	}

        	return "Current BNB Price Is: $".$bnb."<br>
        	Current DGO Price Is: $".number_format($wbnb,4);*/

        	 return "Coin Price Updated!!!";

    }




}
