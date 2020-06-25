<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BesoinFormation extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'besoin_formations';

    public function commune () {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    public function cible () {
        return $this->belongsTo(Cible::class, 'cible_id');
    }

}
