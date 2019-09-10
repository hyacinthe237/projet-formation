<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function fileable () {
        return $this->morphTo();
    }
}
