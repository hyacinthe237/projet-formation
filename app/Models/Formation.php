<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formations';

    public function etudiants () {
        return $this->belongsToMany(Etudiant::class, FormationEtudiant::class)->withPivot('etat');
    }

    public function phases () {
        return $this->belongsToMany(Phase::class, FormationPhase::class);
    }
}
