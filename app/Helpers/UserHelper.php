<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\User;

class UserHelper
{

    public static function makeUserNumber()
    {
        $last_user = User::orderBy('id', 'desc')->first();
        return $last_user ? $last_user->number + rand(1, 3) : 1010103;
    }

    public static function makeApiToken()
    {
        $token = self::randomPassword(100);
        if(User::where('api_token', $token)->first()){
            self::makeApiToken();
        }
        return $token;
    }

    private static function randomPassword($length = 8) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789@";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
