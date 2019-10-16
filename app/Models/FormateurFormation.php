<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormateurFormation extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formateur_formations';

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function formateur () {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }
}
