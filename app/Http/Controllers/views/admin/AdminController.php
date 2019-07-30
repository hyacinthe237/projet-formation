<?php

namespace App\Http\Controllers\Views\Backend;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard ()
    {
        $user  = User::whereIsActive(true)->whereId(Auth::id())->first();
        $users  = User::whereIsActive(true)->count();

        return view('admin.all.dashboard', compact('users', 'user'));
    }

}
