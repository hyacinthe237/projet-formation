<?php

namespace App\Http\Controllers\views\admin;

use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\TypeItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetItemController extends Controller
{
    /**
     * [edit description]
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function create ($id)
    {
        $budget = Budget::findOrFail($id);
        $types = TypeItem::get();

        return view('admin.budgets.items.create', compact('types', 'budget'));
    }

    /**
     * [edit description]
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $item = BudgetItem::with('budget')->findOrFail($id);
        $types = TypeItem::get();

        return view('admin.budgets.items.edit', compact('item', 'types'));
    }

    /**
     * [update description]
     *
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update (Request $request, $id)
    {
        $item = BudgetItem::with('budget')->findOrFail($id);
        $item->update($request->except('_token'));

        return redirect()->back()->with('message', 'mise à jour éffective');
    }
}
