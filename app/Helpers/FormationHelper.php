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

    public static function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval  = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }

}
