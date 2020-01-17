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

    public function etat () {
        return $this->belongsTo(Etat::class, 'etat_id');
    }

}
