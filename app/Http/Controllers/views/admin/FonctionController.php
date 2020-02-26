<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Fonction;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FonctionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $fonctions = Fonction::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.fonctions.index', compact('fonctions'));
  }

    public function create ()
    {
        return view('admin.fonctions.create');
    }

    public function edit ($id)
    {
        $fonction  = Fonction::find($id);
        if (!$fonction)
            return redirect()->route('fonctions.index');

        return view('admin.fonctions.edit', compact('fonction'));
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

        $existing = Fonction::whereName($request->name)->first();

        if (!$existing) {
            $fonction = Fonction::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Fonction ajoutée avec succès');
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

        $fonction = Fonction::find($id);
        if (!$fonction) {
            return redirect()->back()->withErrors(['category' => 'Fonction inconnue!']);
        }

        $fonction->name = $request->has('name') ? $request->name : $fonction->name;
        $fonction->update();

        return redirect()->back()->with('message', 'Fonction mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $fonction = Fonction::find($id);
        if (!$fonction)
            return redirect()->back()->withErrors(['message' => 'Fonction non existante']);

        $etudiant = Etudiant::whereFonctionId($fonction->id)->first();
        if ($etudiant)
           return redirect()->back()->withErrors(['category' => 'Nous ne pouvons pas supprimer cette Fonction, car elle est relié à un stagiaire !']);

        $fonction->delete();

        return redirect()->route('fonctions.index')->with('message', 'Fonction supprimé');
    }

}
