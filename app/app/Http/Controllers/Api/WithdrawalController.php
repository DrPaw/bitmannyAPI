<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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


    public function withdrawMoneyRequest(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $authWallet = UserWallet::where('type', 'deposit_wallet')->where('user_id', Auth::id())->first();

        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);

        $finalAmo = $request->amount - $charge;

        $youGet = $finalAmo * $method->rate;


        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your Request Amount is Smaller Then Withdraw Minimum Amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Withdraw Maximum Amount.'];
            return back()->withNotify($notify);
        }

        if (formatter_money($request->amount + $charge) > $authWallet->balance) {
            $notify[] = ['error', 'Your have Insufficient Balance For Withdraw.'];
            return back()->withNotify($notify);
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
            $w['status'] = -1;
            $result = Withdrawal::create($w);

            Session::put('wtrx', $result->trx);
            return redirect()->route('user.withdraw.preview');
        }
    }

    public function withdrawReqPreview()
    {

        $withdraw = Withdrawal::with('method', 'wallet')->where('trx', Session::get('wtrx'))->where('status', -1)->latest()->firstOrFail();
        $data['page_title'] = "Withdraw Preview";
        $data['withdraw'] = $withdraw;
        return view('user.withdraw.preview', $data);
    }


    public function withdrawReqSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method', 'wallet')->where('trx', Session::get('wtrx'))->where('status', -1)->latest()->firstOrFail();

        $customField = [];
        foreach (json_decode($withdraw->detail) as $k => $val) {
            $customField[$k] = ['required'];
        }

        $validator = Validator::make($request->all(), $customField);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $in = $request->except('_token', 'verify_image');
        $multiInput = [];
        foreach ($in as $k => $val) {
            $multiInput[$k] = $val;
        }

        $authWallet = UserWallet::find($withdraw->wallet_id);

        if (formatter_money($withdraw->amount + $withdraw->charge) > $authWallet->balance) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Your Current Balance.'];
            return back()->withNotify($notify);
        } else {


            if ($request->hasFile('verify_image')) {
                try {
                    $filename = upload_image($request->verify_image, config('constants.deposit.verify.path'));
                    $withdraw->verify_image = $filename;
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your File'];
                    return back()->withNotify($notify)->withInput();
                }
            }

            $withdraw->detail = $request->detail;
            $withdraw->status = 0;
            $withdraw->save();

            $authWallet->balance = formatter_money($authWallet->balance - ($withdraw->amount + $withdraw->charge));
            $authWallet->update();

            Trx::create([
                'user_id' => $authWallet->user_id,
                'amount' => $withdraw->amount,
                'main_amo' => $authWallet->balance,
                'charge' => $withdraw->charge,
                'type' => '-',
                'remark' => 'withdraw',
                'title' => formatter_money($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name,
                'trx' => $withdraw->trx
            ]);


            notify($authWallet->user, $type = 'WITHDRAW_REQUEST', [
                'amount' => formatter_money($withdraw->amount),
                'currency' => $general->cur_text,
                'withdraw_method' => $withdraw->method->name,
                'method_amount' => formatter_money($withdraw->final_amount),
                'method_currency' => $withdraw->currency,
                'duration' => $withdraw->delay,
                'trx' => $withdraw->trx,
            ]);

            $notify[] = ['success', 'Withdraw Request Successfully Send'];
            return redirect()->route('user.withdraw.money')->withNotify($notify);

        }
    }

    public function withdrawLog()
    {

        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', -1)->latest()->get();
        return view('user.withdraw.log', $data);
    }
}
