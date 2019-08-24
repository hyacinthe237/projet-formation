<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['datesdebut', 'heuresdebut', 'minutesdebut', 'datesfin', 'heuresfin', 'minutesfin'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formations';

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

    public function etudiants () {
        return $this->hasMany(FormationEtudiant::class);
    }

    public function phases () {
        return $this->belongsToMany(Phase::class, FormationPhase::class);
    }
}
