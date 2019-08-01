<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Etudiant;

class EtudiantHelper
{

    public static function makeEtudiantNumber()
    {
        $last_user = User::orderBy('id', 'desc')->first();
        return $last_user ? $last_user->number + rand(1, 3) : 1010103;
    }

}
