<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $guarded = ['id'];

    public function etudiants () {
        return $this->hasMany(Etudiant::class);
    }

    public function getDateAttribute () {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }
}
