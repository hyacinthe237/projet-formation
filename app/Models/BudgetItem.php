<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    protected $table = 'budget_items';
    protected $guarded = ['id'];

    public function budget () {
        return $this->belongsTo(Budget::class);
    }

    public function type () {
        return $this->belongsTo(TypeItem::class);
    }

}
