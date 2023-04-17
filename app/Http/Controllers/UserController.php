<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Enums\UserType;
use App\Enums\CacheTime;

class UserController extends Controller
{
    public function getUsers()
    {
        Cache::forget('user-info');
        $users = Cache::remember('user-info', CacheTime::CACHE_FOR_A_MINUTE, function() {
            return User::where('is_admin', UserType::USER)->latest()->paginate(10);
        });
        
        return view('dashboard', compact('users'));
    }
}
