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

    public function thematiques () {
        return $this->belongsTo(Thematique::class, FormationThematique::class);
    }

    public function etudiants () {
        return $this->belongsToMany(Etudiant::class, FormationEtudiant::class)->withPivot('etat');
    }
}
