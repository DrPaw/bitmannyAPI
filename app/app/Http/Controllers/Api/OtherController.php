<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Deposit;
use App\GatewayCurrency;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Invest;
use App\Plan;
use App\TimeSetting;
use App\Trx;
use App\User;
use App\UserWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtherController extends Controller
{
    public function vaultplans()
    {
        $data['plans'] = Plan::where('status', 1)->latest()->get();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->get();
        return response()->json(['status' => 1, 'message' => "Fetched successfully", 'data' => $data]);
    }

    public function buyplan(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'amount' => 'required|min:0',
            'plan_id' => 'required',
            'wallet_type' => 'required',
        );

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = User::find(Auth::id());
        $gnl = GeneralSetting::first();

        $userWallet = UserWallet::where('user_id', Auth::id())->where('id', $request->wallet_type)->first();
        if (!$userWallet) {
            return response()->json(['status' => 0, 'message' => 'Invalid Wallet!']);
        }
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->first();
        if (!$plan) {
            return response()->json(['status' => 0, 'message' => 'Invalid Plan!']);
        }

        if ($plan->fixed_amount == '0') {
            if ($request->amount < $plan->minimum) {
                return response()->json(['status' => 0, 'message' => 'Minimum Invest ' . formatter_money($plan->minimum) . ' ' . $gnl->cur_text]);
            }

            if ($request->amount > $plan->maximum) {
                return response()->json(['status' => 0, 'message' => 'Maximum Invest ' . formatter_money($plan->maximum) . ' ' . $gnl->cur_text]);
            }
        } else {

            if ($request->amount != $plan->fixed_amount) {
                return response()->json(['status' => 0, 'message' => 'Please amount must be ' . formatter_money($plan->fixed_amount) . ' ' . $gnl->cur_text]);
            }
        }

        if ($request->amount > $userWallet->balance) {
            return response()->json(['status' => 0, 'message' => 'Insufficient Balance']);
        }

        $time_name = TimeSetting::where('time', $plan->times)->first();
        $now = Carbon::now();

        $new_balance = formatter_money($userWallet->balance - $request->amount);
        $userWallet->balance = $new_balance;
        $userWallet->save();

        Trx::create([
            'user_id' => $user->id,
            'amount' => formatter_money($request->amount),
            'main_amo' => formatter_money($userWallet->balance, config('constants.currency.base')),
            'charge' => 0,
            'type' => '-',
            'remark' => 'invest',
            'title' => 'Invested On ' . $plan->name,
            'trx' => getTrx(),
        ]);

        //start
        if ($plan->interest_status == 1) {
            $interest_amount = ($request->amount * $plan->interest) / 100;
        } else {
            $interest_amount = $plan->interest;
        }
        $period = ($plan->lifetime_status == 1) ? '-1' : $plan->repeat_time;
        //end

        if ($plan->fixed_amount == 0) {

            if ($plan->minimum <= $request->amount && $plan->maximum >= $request->amount) {
                $invest['user_id'] = $user->id;
                $invest['plan_id'] = $plan->id;
                $invest['amount'] = $request->amount;
                $invest['interest'] = $interest_amount;
                $invest['period'] = $period;
                $invest['time_name'] = $time_name->name;
                $invest['hours'] = $plan->times;
                $invest['next_time'] = Carbon::parse($now)->addHours($plan->times);
                $invest['status'] = 1;
                $invest['capital_status'] = $plan->capital_back_status;
                $invest['trx'] = getTrx();
                $a = Invest::create($invest);

                if ($gnl->invest_commission == 1) {
                    $commissionType = formatter_money($request->amount) . ' ' . $gnl->cur_text . ' Invest for ' . $plan->name;
                    levelCommision($user->id, $request->amount, $commissionType);
                }

                notify($user, $type = 'INVESTMENT_PURCHASE', [
                    'trx' => $a->trx,
                    'amount' => formatter_money($request->amount),
                    'currency' => $gnl->cur_text,
                    'interest_amount' => $interest_amount,
                ]);


                return response()->json(['status' => 0, 'message' => 'Invested Successfully']);

            }
            return response()->json(['status' => 0, 'message' => 'Invalid Amount']);

        } else {
            if ($plan->fixed_amount == $request->amount) {

                $data['user_id'] = $user->id;
                $data['plan_id'] = $plan->id;
                $data['amount'] = $request->amount;
                $data['interest'] = $interest_amount;
                $data['period'] = $period;
                $data['time_name'] = $time_name->name;
                $data['hours'] = $plan->times;
                $data['next_time'] = Carbon::parse($now)->addHours($plan->times);
                $data['status'] = 1;
                $data['capital_status'] = $plan->capital_back_status;
                $data['trx'] = getTrx();
                $a = Invest::create($data);

                if ($gnl->invest_commission == 1) {
                    $commissionType = formatter_money($request->amount) . ' ' . $gnl->cur_text . ' Invest for ' . $plan->name;
                    levelCommision($user->id, $request->amount, $commissionType);
                }


                notify($user, $type = 'INVESTMENT_PURCHASE', [
                    'trx' => $a->trx,
                    'amount' => formatter_money($request->amount),
                    'currency' => $gnl->cur_text,
                    'interest_amount' => $interest_amount,
                ]);

                $user->save();
                return response()->json(['status' => 0, 'message' => 'Package Purchased Successfully Complete']);

            }

            return response()->json(['status' => 0, 'message' => 'Something Went Wrong']);
        }


    }

}
