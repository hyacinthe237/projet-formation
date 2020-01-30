<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationEtudiantEtat extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_etudiant_etats';

    public function etats () {
        return $this->hasMany(Etat::class, 'etat_id');
    }

    public function formation_etudiant () {
        return $this->belongsTo(FormationEtudiant::class, 'formation_etudiant_id');
    }

}
