<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thematique extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thematiques';

    public function formations () {
        return $this->hasMany(Formation::class);
    }

    public function phase () {
        return $this->belongsTo(Phase::class);
    }
}
