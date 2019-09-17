<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $budgets = Budget::when($keywords, function($query) use ($keywords) {
          return $query->where('budget_initial', 'like', '%'.$keywords.'%')
          ->orWhere('budget_reel', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.budgets.index', compact('budgets'));
  }

    public function create ()
    {
        return view('admin.budgets.create');
    }

    public function edit ($id)
    {
        $budget  = Budget::find($id);
        if (!$budget)
            return redirect()->route('budgets.index');

        return view('admin.budgets.edit', compact('budget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'budget_initial' => 'required',
            'formation_id'   => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Budget::whereBudgetInitial($request->budget_initial)->whereFormationId($request->formation_id)->first();

        if (!$existing) {
            Budget::create([
              'formation_id'    => $request->formation_id,
              'user_id'         => Auth::user()->id,
              'budget_initial'  => $request->budget_initial,
              'budget_reel'     => $request->budget_reel
            ]);

            return redirect()->back()->with('message', 'Budget Enregistré avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Ce budget a déjà été enregistré pour cette formation']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'budget_initial'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $budget = Budget::find($id);
        if (!$formateur)
            return redirect()->back()->withErrors(['formateur' => 'Budget inconnu!']);

        $budget->formation_id    = $request->has('formation_id') ? $request->formation_id : $budget->formation_id;
        $budget->budget_initial  = $request->has('budget_initial') ? $request->budget_initial : $budget->budget_initial;
        $budget->budget_reel     = $request->has('budget_reel') ? $request->budget_reel : $budget->budget_reel;
        $budget->update();

        return redirect()->back()->with('message', 'Budget mis à jour avec succès');
    }

    public function destroy ($id)
    {
        $budget = Budget::find($id);
        if (!$budget)
            return redirect()->back()->withErrors(['message' => 'Budget non existant']);

        $budget->delete();
        return redirect()->back()->with('message', 'Budget supprimé');
    }

}
