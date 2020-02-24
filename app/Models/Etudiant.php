<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etudiant extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etudiants';
    protected $appends = ['name', 'img'];

    public function getNameAttribute () {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getImgAttribute () {
        return $this->photo ? $this->photo : "/assets/images/placeholder.png";
    }

    public function formations () {
        return $this->hasMany(FormationEtudiant::class);
    }

    public function residence () {
        return $this->belongsTo(Commune::class, 'residence_id');
    }

    public function structure () {
        return $this->belongsTo(Structure::class, 'structure_id');
    }

    public function fonction () {
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }

    public function files () {
        return $this->hasMany(File::class, 'fileable');
    }

}
