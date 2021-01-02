<?php

namespace App\Http\Controllers\api;

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
        if (!$user)
            return response()->json("Ce compte n'existe pas", self::HTTP_ERROR);

        if ( !$user->is_active ) {
            return response()->json("Ce compte n'est pas actif", self::HTTP_ERROR);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true])) {
            $user = Auth::user();
            return response()->json($user);
        }

        return response()->json("Vérifiez vos identifiants", self::HTTP_ERROR);
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'password_confirm' 	=> 'required|same:password'
        ]);

        if($validator->fails()) {
            return response()->json("Le mot de passe ne correspond pas à la confirmation", self::HTTP_ERROR);
        }

        $user = $request->user();
        if (!$user) {
            return response()->json("User not found", self::HTTP_ERROR);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        response()->json("Mot de passe changé avec succès", self::HTTP_SUCCESS);
    }



}
