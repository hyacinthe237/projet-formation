<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FormateurThematique extends Model
{
    protected $guarded = ['id'];
    protected $table = 'formateur_thematiques';

    protected $appends = ['datesdebut', 'heuresdebut', 'minutesdebut', 'datesfin', 'heuresfin', 'minutesfin'];

    public function getDatesdebutAttribute () {
        return Carbon::parse($this->start_date)->format('Y-m-d');
    }

    public function getHeuresdebutAttribute () {
        return Carbon::parse($this->start_date)->format('H');
    }

    public function getMinutesdebutAttribute () {
        return Carbon::parse($this->start_date)->format('i');
    }

    public function getDatesfinAttribute () {
        return Carbon::parse($this->end_date)->format('Y-m-d');
    }

    public function getHeuresfinAttribute () {
        return Carbon::parse($this->end_date)->format('H');
    }

    public function getMinutesfinAttribute () {
        return Carbon::parse($this->end_date)->format('i');
    }

    public function thematique () {
        return $this->belongsTo(Thematique::class, 'thematique_id');
    }

    public function formateur () {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }
}
