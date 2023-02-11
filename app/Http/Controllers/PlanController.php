<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\PlanType;

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

        $userFreePlan = DB::table('subscriptions')
                        ->where('user_id', Auth::id())
                        ->where('stripe_price', PlanType::FREE)
                        ->first();

        if($request->plan === PlanType::FREE_PLAN && !empty($userFreePlan))
        {
            return redirect()->route('posts.index')->with('warning', 'Free plan already purchased!');
        }
        elseif($request->plan === PlanType::PREMIUM_PLAN && !empty($userFreePlan))
        {
            DB::table('subscriptions')->where('user_id', Auth::id())->update(array('stripe_price' => PlanType::PREMIUM));

            return redirect()->route('posts.index')->with('success', 'Upgraded to premium plan!');
        }

        $userPremiumPlan = DB::table('subscriptions')
                            ->where('user_id', Auth::id())
                            ->where('stripe_price', PlanType::PREMIUM)
                            ->first();

        if($request->plan === PlanType::PREMIUM_PLAN && !empty($userPremiumPlan))
        {
            return redirect()->route('posts.index')->with('warning', 'Premium plan already purchased!');
        }
        elseif($request->plan === PlanType::FREE_PLAN && !empty($userPremiumPlan))
        {
            DB::table('subscriptions')->where('user_id', Auth::id())->update(array('stripe_price' => PlanType::FREE));

            return redirect()->route('posts.index')->with('success', 'Downgraded to free plan!');
        }
   
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
                        ->create($request->token);
   
        return view("membership.subscription_success");
    }
}
