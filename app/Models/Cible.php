<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cible extends Model
{
    protected $guarded = ['id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cibles';

}
