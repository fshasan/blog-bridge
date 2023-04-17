<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = DB::table('subscriptions')
                            ->join('plans', 'subscriptions.stripe_price', '=', 'plans.stripe_plan')
                            ->where('user_id', Auth::id())
                            ->get();
        
        // dd($memberships->toArray());

        return view('membership.my-plans', compact('memberships'));
    }
}
