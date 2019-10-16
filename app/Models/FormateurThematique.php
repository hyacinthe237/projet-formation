<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormateurThematique extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formateur_thematiques';

    public function thematique () {
        return $this->belongsTo(Thematique::class, 'thematique_id');
    }

    public function formateur () {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }
}
