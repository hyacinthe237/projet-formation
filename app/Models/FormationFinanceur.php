<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationFinanceur extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formation_financeurs';

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function financeur () {
        return $this->belongsTo(Financeur::class, 'financeur_id');
    }
}
