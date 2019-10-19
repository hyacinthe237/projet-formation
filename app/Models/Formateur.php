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
    protected $appends = ['name'];

    public function getNameAttribute () {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function formations () {
        return $this->belongsToMany(Formation::class, 'formateur_formations', 'formation_id', 'formateur_id');
    }

    public function thematiques () {
        return $this->hasMany(FormateurThematique::class);
    }
}
