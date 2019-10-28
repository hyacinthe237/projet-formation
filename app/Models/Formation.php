<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formations';

    public function formateurs () {
        return $this->belongsToMany(Formateur::class, 'formateur_formations', 'formateur_id', 'formation_id');
    }

    public function sites () {
        return $this->hasMany(CommuneFormation::class);
    }

    public function phases () {
        return $this->belongsToMany(Phase::class, 'formation_phases', 'formation_id', 'phase_id');
    }
}
