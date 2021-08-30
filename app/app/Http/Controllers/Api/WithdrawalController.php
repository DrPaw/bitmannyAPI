<?php

namespace App\Http\Controllers\Api;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Trx;
use App\UserWallet;
use App\Withdrawal;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function withdraw()
    {
        $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data'=>$data]);
    }


    public function withdrawMoney(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric',
            'details' => 'required'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->first();

        if(!$method){
            return response()->json(['status' => 0, 'message' => 'Invalid Method code.']);
        }
        $authWallet = UserWallet::where('type', 'deposit_wallet')->where('user_id', Auth::id())->first();

        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);

        $finalAmo = $request->amount - $charge;

        $youGet = $finalAmo * $method->rate;


        if ($request->amount < $method->min_limit) {
            return response()->json(['status' => 0, 'message' => 'Your Request Amount is Smaller Then Withdraw Minimum Amount.']);
        }
        if ($request->amount > $method->max_limit) {
            return response()->json(['status' => 0, 'message' => 'Your Request Amount is Larger Then Withdraw Maximum Amount.']);
        }

        if (formatter_money($request->amount + $charge) > $authWallet->balance) {
            return response()->json(['status' => 0, 'message' => 'Your have Insufficient Balance For Withdraw.']);
        } else {

            $w['method_id'] = $method->id; // wallet method ID
            $w['user_id'] = Auth::id();
            $w['wallet_id'] = $authWallet->id; // User Wallet ID
            $w['amount'] = formatter_money($request->amount);
            $w['currency'] = $method->currency;
            $w['rate'] = $method->rate;
            $w['charge'] = $charge;
            $w['final_amount'] = $youGet;
            $w['delay'] = $method->delay;

            $multiInput = [];
            if ($method->user_data != null) {
                foreach ($method->user_data as $k => $val) {
                    $multiInput[str_replace(' ', '_', $val)] = null;
                }
            }
            $w['detail'] = json_encode($multiInput);
            $w['trx'] = getTrx();
            $w['status'] = 0;
            $w['detail'] = $request->details;
            $withdraw = Withdrawal::create($w);

            $authWallet->balance = formatter_money($authWallet->balance - ($w['amount'] + $w['charge']));
            $authWallet->update();

            Trx::create([
                'user_id' => $authWallet->user_id,
                'amount' => $w['amount'],
                'main_amo' => $authWallet->balance,
                'charge' => $w['charge'],
                'type' => '-',
                'remark' => 'withdraw',
                'title' => formatter_money($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name,
                'trx' => $withdraw->trx
            ]);

            $general = GeneralSetting::first();


            notify($authWallet->user, $type = 'WITHDRAW_REQUEST', [
                'amount' => formatter_money($withdraw->amount),
                'currency' => $general->cur_text,
                'withdraw_method' => $withdraw->method->name,
                'method_amount' => formatter_money($withdraw->final_amount),
                'method_currency' => $withdraw->currency,
                'duration' => $withdraw->delay,
                'trx' => $withdraw->trx,
            ]);

            return response()->json(['status' => 1, 'message' => 'Withdraw Request Successfully Send']);
        }
    }


    public function withdrawLog()
    {

        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', -1)->latest()->get();
        return view('user.withdraw.log', $data);
    }
}
