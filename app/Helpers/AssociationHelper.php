<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Association;

class AssociationHelper
{

    public static function makeAssociationNumber()
    {
        $last = Association::orderBy('id', 'desc')->first();
        return $last ? $last->number + rand(1, 3) : 1010103;
    }

}
