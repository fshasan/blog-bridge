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
}
