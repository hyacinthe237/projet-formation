<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeItem extends Model
{
    protected $table = 'type_items';
    protected $guarded = ['id'];

    public function budget_items () {
        return $this->hasMany(BudgetItem::class, 'type_item_id');
    }

}
