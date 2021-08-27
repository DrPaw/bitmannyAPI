<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Deposit;
use App\Http\Controllers\Controller;
use App\Invest;
use App\Kyc;
use App\SupportTicket;
use App\Trade;
use App\Trx;
use App\User;
use App\UserWallet;
use App\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard(){
        $data['totalInvest'] = Invest::where('user_id', auth()->id())->sum('amount');
        $data['authWallets'] = UserWallet::where('user_id', auth()->id())->get();
        $data['balance'] = UserWallet::where('user_id', auth()->id())->sum('balance');
        $data['currency'] = Currency::where('status', 1)->get();
        $data['totalWithdraw'] = Withdrawal::where('user_id', Auth::id())->whereIn('status', [0, 1])->sum('amount');
        $data['ptotalWithdraw'] = Withdrawal::where('user_id', Auth::id())->where('status', 1)->sum('amount');
        $data['totalDeposit'] = Deposit::where('user_id', Auth::id())->where('status', 1)->sum('amount');
        $data['ptotalDeposit'] = Deposit::where('user_id', Auth::id())->where('status', 2)->sum('amount');
        $data['sell'] = Trade::whereType(2)->where('user_id', auth()->id())->sum('amount');
        $data['buy'] = Trade::whereType(1)->where('user_id', auth()->id())->sum('amount');
        $data['trade'] = Trade::where('user_id', auth()->id())->sum('amount');

        $data['totalTicket'] = SupportTicket::where('user_id', Auth::id())->count();

        $collection['day'] = collect([]);
        $collection['trx'] = collect([]);
        Trx::where('user_id', Auth::id())
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->selectRaw('SUM((CASE WHEN type = "+" THEN amount  END)) as totalTransaction ')
            ->selectRaw("DATE_FORMAT(created_at, '%W') day")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()->map(function ($v, $key) use ($collection){
                if ($v->totalTransaction == null) {
                    $collection['trx']->push(round($v->totalTransaction, 2));
                }else{
                    $collection['trx']->push(round($v->totalTransaction, 2));
                }
                $collection['day']->push($v->day);
                return $collection;
            });
        GetCoinPrice();

        return response()->json(['status' => 1, 'message' => "Fetched successfully", 'data' => $data]);
    }

    public function kyc()
    {
        $data['kyc'] = Kyc::where('user_id', Auth::id())->latest()->first();
        return response()->json(['status' => 1, 'message' => 'Fetched successfully', 'data' => $data]);
    }

    public function postkyc(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $exist = Kyc::whereUser_id(Auth::id())->whereStatus(0)->count();
        if($exist > 0)
        {
            return response()->json(['status' => 0, 'message' => 'You have already uploaded a document and its under review, Please hold on for verification.']);
        }

        $exist = Kyc::whereUser_id(Auth::id())->whereStatus(1)->count();
        if($exist > 0)
        {
            return response()->json(['status' => 0, 'message' => 'You have already completed the verification process.']);
        }

        $input = $request->all();
        $rules = array(
            'type' => 'required|string|max:50',
            'expiry' => 'required|string|max:50',
            'image' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request']);
        }

        if($input['image']) {
            $filename = time() . '_' . Auth::user()->username . '.jpg';
            $location = 'assets/images/kyc/' . $filename;
            $path = './assets/images/kyc/';
            $in['image'] = $location;

            $file_data = $input['image'];
            //generating unique file name;
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                File::put(storage_path('../../') . $location, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }

        $w['type'] = $request->type; // ID Type
        $w['user_id'] = Auth::id();
        $w['expiry'] = $request->expiry; // ID Expiry Date
        $w['number'] = $request->number;
        $w['front'] = $filename;
        $w['address'] = $request->address;
        $w['city'] = $request->city;
        $w['state'] = $request->state;
        $w['country'] = $request->country;
        $w['zip'] = $request->zip;
        $w['status'] = 0;
        Kyc::create($w);

        return response()->json(['status' => 1, 'message' => 'KYC Submited successfully.']);

    }


}
