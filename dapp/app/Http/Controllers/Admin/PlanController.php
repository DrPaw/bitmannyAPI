<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Plan;
use App\Invest;
use App\TimeSetting;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Manage Plan";
        $plan = Plan::latest()->paginate(config('constants.table.default'));
        return view('admin.plan.index', compact('page_title', 'plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New Plan";
        $time = TimeSetting::all();

        return view('admin.plan.create', compact('page_title','time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'times' => 'numeric|min:0',
            'interest' => 'numeric|min:0',
        ]);

        if ($request->amount_type == 'on'){
            $fixed_amount = $request->amount;
            $minimum = $request->amount;
            $maximum= $request->amount;
        }else{
            $fixed_amount = 0;
            $minimum = $request->minimum;
            $maximum= $request->maximum;
        }

        $interrest_status =  ($request->interest_status == '%') ? 1 : 0;

        if ($request->lifetime_status == 'on'){
            $lifetime_status = 0;
            $repeat_time = $request->repeat_time;
        }else{
            $lifetime_status = 1;
            $repeat_time = 0;
        }

        if ($request->capital_back_status == 'on'){
            $capital_back_status = ($lifetime_status == 1) ? 0 : 1;
        }else{
            $capital_back_status = 0;
        }

        if ($minimum < 0 or $maximum < 0 or $fixed_amount < 0){
            $notify[] = ['error', 'Invest Amount cannot lower than 0'];
            return back()->withNotify($notify);
        }

        if ($request->interest < 0){
            $notify[] = ['error', 'Interest cannot lower than 0'];
            return back()->withNotify($notify);
        }

        if ($repeat_time < 0){
            $notify[] = ['error', 'Return Time cannot lower than 0'];
            return back()->withNotify($notify);
        }

        Plan::create([
            'name' => $request->name,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'fixed_amount' => $fixed_amount,
            'interest' => $request->interest,
            'interest_status' => $interrest_status,
            'times' => $request->times,
            'status' => 1,
            'capital_back_status' => $capital_back_status,
            'lifetime_status' => $lifetime_status,
            'repeat_time' => $repeat_time,
            'status' => ($request->status == 'on') ? 1 : 0,
            'featured' => ($request->featured == 'on') ? 1 : 0
        ]);

        $notify[] = ['success', 'Create Successfully'];
        return back()->withNotify($notify);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Update Plan";
        $time = TimeSetting::all();
        $plan = Plan::whereId($id)->first();
        return view('admin.plan.edit', compact('page_title', 'plan','time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'times' => 'numeric|min:0',
            'interest' => 'numeric|min:0',
        ]);

        if ($request->amount_type == 'on') {
            $fixed_amount = $request->amount;
            $minimum = $request->amount;
            $maximum= $request->amount;
        }else{
            $fixed_amount = 0;
            $minimum = $request->minimum;
            $maximum= $request->maximum;
        }

        $interrest_status = ($request->interest_status == '%') ? 1 : 0;

        if ($request->lifetime_status == 'on'){
            $lifetime_status = 0;
            $repeat_time = $request->repeat_time;
        }else{
            $lifetime_status = 1;
            $repeat_time = 0;
        }

        if ($request->capital_back_status == 'on'){
            $capital_back_status =  ($lifetime_status == 1) ? 0 : 1;
        }else{
            $capital_back_status = 0;
        }


        if ($minimum < 0 or $maximum < 0 or $fixed_amount < 0){
            $notify[] = ['error', 'Invest Amount cannot lower than 0'];
            return back()->withNotify($notify);
        }

        if ($request->interest < 0){
            $notify[] = ['error', 'Interest cannot lower than 0'];
            return back()->withNotify($notify);
        }

        if ($repeat_time < 0){
            $notify[] = ['error', 'Return Time cannot lower than 0'];
            return back()->withNotify($notify);
        }


        Plan::whereId($id)->update([
            'name' => $request->name,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'fixed_amount' => $fixed_amount,
            'interest' => $request->interest,
            'interest_status' => $interrest_status,
            'times' => $request->times,
            'status' => 1,
            'capital_back_status' => $capital_back_status,
            'lifetime_status' => $lifetime_status,
            'repeat_time' => $repeat_time,
            'status' => ($request->status == 'on') ? 1 : 0,
            'featured' => ($request->featured == 'on') ? 1 : 0
        ]);

        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);

    }

      public function running()
    {
        $page_title = 'Active / Running Vault ROI Log';
        $trans = Invest::whereStatus(1)->latest()->get();
        return view('admin.plan.interest_log', compact('page_title', 'trans'));
    }

      public function closed()
    {
        $page_title = 'Closed/Successful Vault ROI Log';
        $trans = Invest::whereStatus(0)->latest()->get();
        return view('admin.plan.interest_log', compact('page_title', 'trans'));
    }

}
