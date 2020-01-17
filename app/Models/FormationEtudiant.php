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

    public function site () {
        return $this->belongsTo(CommuneFormation::class, 'commune_formation_id');
    }

    public function etudiant () {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    public function phases () {
        return $this->belongsToMany(Phase::class, 'formation_etudiant_phases', 'formation_etudiant_id', 'phase_id');
    }

    public function etats () {
        return $this->belongsToMany(Etat::class, 'formation_etudiant_etats', 'formation_etudiant_id', 'etat_id');
    }

}
