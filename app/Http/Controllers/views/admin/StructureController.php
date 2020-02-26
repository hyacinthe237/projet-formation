<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Structure;
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
      $structures = Structure::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.structures.index', compact('structures'));
  }

    public function create ()
    {
        return view('admin.structures.create');
    }

    public function edit ($id)
    {
        $structure  = Structure::find($id);
        if (!$structure)
            return redirect()->route('structures.index');

        return view('admin.structures.edit', compact('structure'));
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

        $existing = Structure::whereName($request->name)->first();

        if (!$existing) {
            $structure = Structure::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Structure ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Structure existante']);
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

        $structure = Structure::find($id);
        if (!$structure) {
            return redirect()->back()->withErrors(['category' => 'Structure inconnue!']);
        }

        $structure->name = $request->has('name') ? $request->name : $structure->name;
        $structure->update();

        return redirect()->back()->with('message', 'Structure mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $structure = Structure::find($id);
        if (!$structure)
            return redirect()->back()->withErrors(['message' => 'Structure non existante']);

        $etudiant = Etudiant::whereStructureId($structure->id)->first();
        if ($etudiant)
           return redirect()->back()->withErrors(['category' => 'Nous ne pouvons pas supprimer cette Structure, car elle est relié à un stagiaire !']);

        $structure->delete();

        return redirect()->route('structures.index')->with('message', 'Structure supprimé');
    }

}
