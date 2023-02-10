<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::get();
        return view('membership.plans', compact('plans')); 
    }

    public function show(Plan $plan, Request $request)
    {
        $intent = Auth::user()->createSetupIntent();

        return view('membership.subscription',  compact('plan', 'intent'));
    }

    public function subscription(Request $request)
    {
        $plan = Plan::find($request->plan);
   
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
                        ->create($request->token);
   
        return view("membership.subscription_success");
    }
}
