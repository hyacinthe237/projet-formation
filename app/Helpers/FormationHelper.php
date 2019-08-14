<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Formation;

class FormationHelper
{

    public static function makeFormationNumber()
    {
        $last_form = Formation::orderBy('id', 'desc')->first();
        return $last_form ? $last_form->number + rand(1, 3) : 1010103;
    }

}
