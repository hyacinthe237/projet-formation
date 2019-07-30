<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $appends = ['name'];
    protected $hidden = ['password'];

    public function getNameAttribute () {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function role () {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin () {
        return in_array($this->role_id, [1, 2]);
    }

    public function isSuper () {
        return $this->role_id === 1;
    }
}
