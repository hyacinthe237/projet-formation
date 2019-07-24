<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationEtudiant extends Model
{

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_etudiants';

    public function formations () {
        return $this->hasMany(Formation::class, 'formation_id');
    }

    public function etudiants () {
        return $this->hasMany(Etudiant::class, 'etudiant_id');
    }

}
