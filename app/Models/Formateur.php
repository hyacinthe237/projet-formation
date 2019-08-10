<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formateur extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formateurs';
    protected $appends = ['name'];

    public function getNameAttribute () {
        return $this->firstname . ' ' . $this->lastname;
    }
}
