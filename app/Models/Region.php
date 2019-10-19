<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $guarded = ['id'];

    public function departements () {
        return $this->hasMany(Departement::class, 'region_id');
    }
}
