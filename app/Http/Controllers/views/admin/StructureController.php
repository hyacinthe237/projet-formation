<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Commune;
use App\Models\Departement;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class StructureController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $structures = Commune::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('name', 'asc')
      ->paginate(self::BACKEND_PAGINATE);
      $departements = Departement::get();

      return view('admin.etudiants.structures.index-create', compact('structures', 'departements'));
  }

    public function edit ($id)
    {
        $structure  = Commune::find($id);
        if (!$structure)
            return redirect()->route('structures.index');

        return view('admin.etudiants.structures.edit', compact('structure'));
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

        $existing = Commune::whereName($request->name)->first();

        if (!$existing) {
            $structure = Commune::create([
              'name'      => $request->name,
              'departement_id'      => 57
            ]);

            return redirect()->back()->with('message', 'Structure ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Fonction existante']);
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

        $structure = Commune::find($id);
        if (!$structure) {
            return redirect()->back()->withErrors(['category' => 'Structure inconnue!']);
        }

        $structure->name = $request->has('name') ? $request->name : $structure->name;
        $structure->update();

        return redirect()->back()->with('message', 'Fonction mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $structure = Commune::find($id);
        if (!$structure)
            return redirect()->back()->withErrors(['message' => 'Structure non existante']);

        $etudiant = Etudiant::whereStructureId($structure->id)->first();
        if ($etudiant)
           return redirect()->back()->withErrors(['category' => 'Nous ne pouvons pas supprimer cette structure, car elle est relié à un stagiaire !']);

        $structure->delete();

        return redirect()->route('structures.index')->with('message', 'Structure supprimée');
    }
}
