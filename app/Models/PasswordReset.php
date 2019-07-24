<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    protected $guarded = ['created_at'];

    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now();
        });
    }

    public function isOld ()
    {
        return Carbon::parse($this->created_at)->diffInHours() > 2;
    }
}
