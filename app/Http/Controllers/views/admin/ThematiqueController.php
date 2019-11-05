<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Phase;
use App\Models\Thematique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ThematiqueController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $thematiques = Thematique::with('phase')
      ->when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->when($request->phase_id, function($query) use ($request) {
          return $query->where('phase_id', $request->phase_id);
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      $phases = Phase::all();
      return view('admin.thematiques.index', compact('thematiques', 'phases'));
  }

    public function create ()
    {
        $phases = Phase::all();
        return view('admin.thematiques.create', compact('phases'));
    }

    public function edit ($id)
    {
        $thematique  = Thematique::find($id);
        if (!$thematique)
            return redirect()->route('thematiques.index');

        $phases = Phase::all();
        return view('admin.thematiques.edit', compact('thematique', 'phases'));
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
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Thematique::whereName($request->title)->first();

        if (!$existing) {
            Thematique::create([
              'phase_id' => $request->phase_id,
              'name'     => $request->name,
              'duree'    => $request->duree
            ]);

            return redirect()->back()->with('message', 'Thematique ajoutée avec succès');
        }

        return redirect()->back()->withInput($request->all())->withErrors(['existing' => 'Thematique existante']);
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

        $thematique = Thematique::find($id);
        if (!$thematique) {
            return redirect()->back()->withErrors(['phase' => 'Thématique inconnue!']);
        }

        $thematique->phase_id = $request->has('phase_id') ? $request->phase_id : $thematique->phase_id;
        $thematique->name = $request->has('name') ? $request->name : $thematique->name;
        $thematique->duree = $request->has('duree') ? $request->duree : $thematique->duree;
        $thematique->update();

        return redirect()->back()->with('message', 'Thématique mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $thematique = Thematique::find($id);
        if (!$thematique)
            return redirect()->back()->withErrors(['message' => 'Thématique non existante']);

        $thematique->delete();
        return redirect()->back()->with('message', 'Thématique supprimée');
    }

}
