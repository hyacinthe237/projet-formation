<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets';
    protected $guarded = ['id'];

    public function items () {
        return $this->hasMany(BudgetItem::class, 'budget_id');
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formation () {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function getDateAttribute () {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }
}
