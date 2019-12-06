<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationEtudiantPhase extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_etudiant_phases';

    public function phhase () {
        return $this->belongsTo(Phase::class, 'phase_id');
    }

}
