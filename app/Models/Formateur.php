<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formateur extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formateurs';

    public function thematiques () {
        return $this->belongsTo(Thematique::class, FormateurThematique::class);
    }

    public function formations () {
        return $this->belongsToMany(Etudiant::class, FormateurFormation00 ::class)->withPivot('etat');
    }
}
