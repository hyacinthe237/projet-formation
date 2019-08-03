<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard ()
    {
        $user  = User::whereIsActive(true)->whereId(Auth::id())->first();
        $users  = User::whereIsActive(true)->count();
        $etudiants  = Etudiant::count();

        return view('admin.all.dashboard', compact('users', 'etudiants', 'user'));
    }

}
