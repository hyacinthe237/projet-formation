<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';
    protected $guarded = ['id'];

    public function departement () {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

}
