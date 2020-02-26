<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Financeur;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FinanceurController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $financeurs = Financeur::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.financeurs.index', compact('financeurs'));
  }

    public function create ()
    {
        return view('admin.financeurs.create');
    }

    public function edit ($id)
    {
        $financeur  = Financeur::find($id);
        if (!$financeur)
            return redirect()->route('financeurs.index');

        return view('admin.financeurs.edit', compact('financeur'));
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
            'name'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Financeur::whereName($request->name)->first();

        if (!$existing) {
            $financeur = Financeur::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Financeur ajouté avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Financeur existant']);
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
            'name'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $financeur = Financeur::find($id);
        if (!$financeur) {
            return redirect()->back()->withErrors(['financeur' => 'Financeur inconnu!']);
        }

        $financeur->name = $request->has('name') ? $request->name : $financeur->name;
        $financeur->update();

        return redirect()->back()->with('message', 'Financeur mis à jour avec succès');
    }

    public function destroy ($id)
    {
        $financeur = Financeur::find($id);
        if (!$financeur)
            return redirect()->back()->withErrors(['message' => 'Financeur non existant']);

        $financeurs = Formationfinanceur::whereFinanceurId($financeur->id)->get();
        if ($financeurs) {
          foreach ($financeurs as $item) {
            $item->delete();
          }
        }

        $financeur->delete();

        return redirect()->route('financeurs.index')->with('message', 'Financeur supprimé');
    }

}
