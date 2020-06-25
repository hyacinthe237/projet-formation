<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Evaluation;

class EvaluationHelper
{
    public static function makeEvaluationNumber()
    {
        $last_eval = Evaluation::orderBy('id', 'desc')->first();
        return $last_eval ? $last_eval->number + rand(1, 3) : 1010103;
    }

}
