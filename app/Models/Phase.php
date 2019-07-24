<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $table = 'phases';
    protected $guarded = ['id'];

    public function thematique () {
        return $this->belongsTo(Thematique::class, 'thematique_id');
    }

    public function getDateAttribute () {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }
}
