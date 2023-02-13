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
        $users = Cache::remember('user-info', CacheTime::CACHE_FOR_A_MINUTE, function() {
            return User::where('is_admin', UserType::USER)->latest()->paginate();
        });
        
        return view('dashboard', compact('users'));
    }
}
