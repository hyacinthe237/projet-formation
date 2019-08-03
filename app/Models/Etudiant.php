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
        return $this->belongsToMany(Formation::class, 'formation_etudiants')->withPivot('etat');
    }

    public function location () {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
