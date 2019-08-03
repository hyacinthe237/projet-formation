<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationPhase extends Model
{

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_phases';

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function phase () {
        return $this->belongsTo(Phase::class, 'phase_id');
    }

}
