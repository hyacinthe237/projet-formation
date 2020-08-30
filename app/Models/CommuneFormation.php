<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CommuneFormation extends Model
{
    protected $table = 'commune_formations';
    protected $guarded = ['id'];

    protected $appends = ['datesdebut', 'heuresdebut', 'minutesdebut', 'datesfin',
     'heuresfin', 'minutesfin', 'du', 'au'];

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

    public function commune () {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function etudiants () {
        return $this->belongsToMany(Etudiant::class, 'formation_etudiants', 'commune_formation_id', 'etudiant_id');
    }

}
