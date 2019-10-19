<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departements';
    protected $guarded = ['id'];

    public function communes () {
        return $this->hasMany(Commune::class, 'depatement_id');
    }

    public function region () {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
