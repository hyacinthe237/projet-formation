<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['datesdebut', 'heuresdebut', 'minutesdebut', 'datesfin',
     'heuresfin', 'minutesfin', 'du', 'au'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formations';

    public function getDuAttribute () {
        return Carbon::parse($this->start_date)->format('d M Y H:i');
    }

    public function getAuAttribute () {
        return Carbon::parse($this->end_date)->format('d M Y H:i');
    }

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
        return $this->belongsToMany(Etudiant::class, 'formation_etudiants', 'formation_id', 'etudiant_id');
    }

    public function formateurs () {
        return $this->belongsToMany(Formateur::class, 'formateur_formations', 'formateur_id', 'formation_id');
    }

    public function phases () {
        return $this->belongsToMany(Phase::class, 'formation_phases', 'formation_id', 'phase_id');
    }
}
