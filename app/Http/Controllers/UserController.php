<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserType;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::latest()->where('is_admin', UserType::USER)->paginate();

        return view('dashboard', compact('users'));
    }
}
