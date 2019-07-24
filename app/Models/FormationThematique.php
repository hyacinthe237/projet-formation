<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationThematique extends Model
{

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_thematiques';

    public function formations () {
        return $this->hasMany(Formation::class, 'formation_id');
    }

    public function thematiques () {
        return $this->hasMany(Thematique::class, 'thematique_id');
    }

}
