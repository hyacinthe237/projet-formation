<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\BesoinFormation;

class BesoinFormationHelper
{
    public static function makeBesoinFormationNumber()
    {
        $last = BesoinFormation::orderBy('id', 'desc')->first();
        return $last ? $last->number + rand(1, 3) : 1010103;
    }

}
