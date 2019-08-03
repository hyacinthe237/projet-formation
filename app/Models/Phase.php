<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $table = 'phases';
    protected $guarded = ['id'];

    public function thematiques () {
        return $this->hasMany(Thematique::class);
    }

    public function getDateAttribute () {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }

    public function formations () {
        return $this->belongsToMany(Formation::class, FormationPhase::class);
    }
}
