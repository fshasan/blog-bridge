<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::get();
        return view('membership.plans', compact('plans')); 
    }
}
