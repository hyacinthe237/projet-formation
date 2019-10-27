<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommuneFormation extends Model
{
    protected $table = 'commune_formations';
    protected $guarded = ['id'];

    public function commune () {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

}
