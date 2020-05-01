<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use Hash;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function login() {
        return view('admin.auth.login');
    }

    /**
     * User sign out
     * @return [type] [description]
     */
    public function logout() {
        if(Auth::check())
            Auth::logout();
        return redirect()->back();
    }


    /**
     * User sign in
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'email' 	=> 'required'
        ]);

        if($validator->fails())
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Email & Mot de passe sont obligatoires']);

        $user = User::where('email', $request->email)->first();

        if ( !$user )
        return redirect()->back()->withErrors([
            "user"   => "Ce compte n'existe pas"
        ])->withInput($request->except('password'));

        if ( !$user->is_active ) {
            return redirect()->back()->withErrors([
                "user"   => "Ce compte n'est pas actif"
            ])->withInput($request->except('password'));
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true])) {
            return redirect()->to('/admin');
        }

        return redirect()->back()->withErrors([
            "message"   => "Vérifiez vos identifiants"
        ])->withInput($request->except('password'));
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'password_confirm' 	=> 'required|same:password'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors(['validator' => 'Le mot de passe ne correspond pas à la confirmation']);
        }

        $user = User::find($request->user_id);
        if (!$user) {
            abort(404);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect()->back()->with('message', 'Mot de passe changé avec succès');
    }



}
