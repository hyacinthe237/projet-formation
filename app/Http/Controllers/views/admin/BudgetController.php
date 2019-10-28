<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\CommuneFormation;
use App\Models\TypeItem;
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
      ->with('site')
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.budgets.index', compact('budgets'));
  }

    public function create ()
    {
        $formations = CommuneFormation::with('formation', 'formation.sites')->get();
        return view('admin.budgets.create', compact('formations'));
    }

    public function edit ($id)
    {
        $budget  = Budget::with('items', 'items.type')->find($id);
        $formations = CommuneFormation::with('formation', 'commune')->orderBy('id', 'desc')->get();
        $types = TypeItem::get();
        if (!$budget)
            return redirect()->route('budgets.index');

        $total = 0;
        foreach ($budget->items as $item) {
          $item->total = $item->nb_unite * $item->cout_unite;
          $total += $item->total;
        }

        return view('admin.budgets.edit', compact('budget', 'total', 'formations', 'types'));
    }

    /**
     * [addBudgetItem description]
     * @param [type]  $budget_id [description]
     * @param Request $request  [description]
     */
    public function addBudgetItem (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_item_id'  => 'required',
            'designation'   => 'required',
            'unite'         => 'required',
            'nb_unite'      => 'required',
            'cout_unite'    => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->all())
                   ->withErrors(['validator' => 'Saisissez tous les champs']);

        $budget = Budget::find($request->budget_id);

        $existing_record = $budget->items()->where('type_item_id', $request->type_item_id)
            ->where('designation', $request->designation)->first();

        if( !$existing_record ) {
            $budget->items()->create([
                'type_item_id'  => $request->type_item_id,
                'designation'   => $request->designation,
                'unite'         => $request->unite,
                'nb_unite'      => $request->nb_unite,
                'cout_unite'    => $request->cout_unite
            ]);
            return redirect()->back()->with('message', 'Elément du budget ajouté avec succès !');
        } else {
            $existing_record->type_item_id = $request->type_item_id;
            $existing_record->designation = $request->designation;
            $existing_record->unite = $request->unite;
            $existing_record->nb_unite = $request->nb_unite;
            $existing_record->cout_unite = $request->cout_unite;
            $existing_record->update();
            return redirect()->back()->with('message', 'Mise a jour effective');
        }
    }

    /**
     * [removeBudgetItem description]
     * @param  [type] $price_id [description]
     * @return [type]           [description]
     */
    public function removeBugetItem ($id)
    {
        $item = BudgetItem::find($id);
        $budget = Budget::find($item->budget_id);

        if (!$item)
            return redirect()->route('budgets.edit', $budget->id)->with('message', 'Elément non existant');

        $item->delete();
        return redirect()->route('budgets.edit', $budget->id)->with('message', 'Suppression éffective');
    }

    /**
     * Download PDF Budget
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    public function downloadBudget ($id)
    {
        $data = self::takeBudgetInfos($id);

        $pdf = PDF::loadView('pdfs.budget', $data);
        return $pdf->stream();
    }

    /**
     * Recup Budget Information
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    private static function takeBudgetInfos ($id)
    {
        $budget = Budget::whereId($id)
                    ->with('items', 'items.type', 'site', 'site.etudiants', 'site.formation',  'site.formation.formateurs', 'site.commune')
                    ->firstOrFail();

        $types = TypeItem::get();
        $items = $budget->items;
        $itemPedagogiques = $budget->items->where('type_item_id', 1);
        $itemLogistiques = $budget->items->where('type_item_id', 2);
        $itemCommunications = $budget->items->where('type_item_id', 3);
        $itemPersonnels = $budget->items->where('type_item_id', 4);
        $formation = $budget->site->formation;
        $site = $budget->site;
        $formateurs = $budget->site->formation->formateurs;

        $totalBudgets = 0;
        $totalPedagogiques = 0;
        foreach ($itemPedagogiques as $item) {
          $item->total = $item->nb_unite * $item->cout_unite;
          $totalPedagogiques += $item->total;
        }

        $totalLogistiques = 0;
        foreach ($itemLogistiques as $item) {
          $item->total = $item->nb_unite * $item->cout_unite;
          $totalLogistiques += $item->total;
        }

        $totalCommunications = 0;
        foreach ($itemCommunications as $item) {
          $item->total = $item->nb_unite * $item->cout_unite;
          $totalCommunications += $item->total;
        }

        $totalPersonnels = 0;
        foreach ($itemPersonnels as $item) {
          $item->total = $item->nb_unite * $item->cout_unite;
          $totalPersonnels += $item->total;
        }

        $totalBudgets = $totalPedagogiques + $totalLogistiques + $totalCommunications + $totalPersonnels;

        $data = [
            'itemPedagogiques' => $itemPedagogiques,
            'itemLogistiques' => $itemLogistiques,
            'itemCommunications' => $itemCommunications,
            'itemPersonnels' => $itemPersonnels,
            'types' => $types,
            'formation' => $formation,
            'formateurs' => $formateurs,
            'totalBudgets' => $totalBudgets,
            'totalPedagogiques' => $totalPedagogiques,
            'totalLogistiques' => $totalLogistiques,
            'totalCommunications' => $totalCommunications,
            'totalPersonnels' => $totalPersonnels,
            'site' => $site,
            'etudiants' => $site->etudiants,
            'budget' => $budget
        ];

        return $data;

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
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Budget::whereBudgetInitial($request->budget_initial)->whereFormationId($request->formation_id)->first();

        if (!$existing) {
            $budget = Budget::create([
              'formation_id'    => $request->formation_id,
              'user_id'         => Auth::user()->id,
              'budget_initial'  => $request->budget_initial,
              'budget_reel'     => $request->budget_reel,
              'description'     => $request->description
            ]);

            return redirect()->route('budgets.edit', $budget->id)
                            ->withSuccess("Budget Enregistré avec succès");
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
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $budget = Budget::with('items', 'items.type')->find($id);
        if (!$budget)
            return redirect()->back()->withErrors(['formateur' => 'Budget inconnu!']);

        $budget->formation_id    = $request->has('formation_id') ? $request->formation_id : $budget->formation_id;
        $budget->budget_initial  = $request->has('budget_initial') ? $request->budget_initial : $budget->budget_initial;
        $budget->budget_reel     = $request->has('budget_reel') ? $request->budget_reel : $budget->budget_reel;
        $budget->description     = $request->has('description') ? $request->description : $budget->description;
        $budget->update();

        return redirect()->back()->withSuccess("Budget mis à jour avec succès");
    }

    public function destroy (Request $request, $id)
    {
        $budget = Budget::find($id);
        if (!$budget)
            return redirect()->back()->withErrors(['message' => 'Budget non existant']);

        $budget->delete();
        return redirect()->back()->with('message', 'Budget supprimé');
    }

}
