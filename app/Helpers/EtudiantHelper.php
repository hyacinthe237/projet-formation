<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Etudiant;

class EtudiantHelper
{

    public static function makeEtudiantNumber()
    {
        $last_etud = Etudiant::orderBy('id', 'desc')->first();
        return $last_etud ? $last_etud->number + rand(1, 3) : 1010103;
    }

}
