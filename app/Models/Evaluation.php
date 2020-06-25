<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluations';

    public function site () {
        return $this->belongsTo(CommuneFormation::class, 'commune_formation_id');
    }

    public function stagiaire () {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

}
