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

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
    
    public function etudiant () {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }
}
