<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Formation;
use App\Helpers\FormationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FormationController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $formations = Formation::with(['etudiants', 'phases'])
      ->when($keywords, function($query) use ($keywords) {
          return $query->where('title', 'like', '%'.$keywords.'%')
          ->orWhere('site', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.formations.index', compact('formations'));
  }

    public function create ()
    {
        return view('admin.formations.create');
    }

    public function edit ($number)
    {
        $formation  = Formation::whereNumber($number)->first();
        if (!$formation)
            return redirect()->route('formations.index');

        return view('admin.formations.edit', compact('formation'));
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
            'title'      => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Titre, Date début & Date fin sont obligatoires']);

        $existing = Formation::whereTitle($request->title)->first();
        if (!$existing) {
            $formation = Formation::create([
              'number'      => FormationHelper::makeFormationNumber(),
              'title'       => $request->title,
              'site'        => $request->site,
              'start_date'  => $request->start_date,
              'end_date'    => $request->end_date,
              'description' => $request->description,
              'qte_requis'  => $request->qte_requis,
              'duree'       => $request->duree,
              'is_active'   => $request->is_active,
              'type'        => $request->type
            ]);

            return redirect()->back()->with('message', 'Formation ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Cette Formation existe déjà']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $number)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Titre, Date début & Date fin sont obligatoires']);

        $formation = Formation::whereNumber($number)->first();
        if (!$formation)
            return redirect()->back()->withErrors(['user' => 'Formation inconnue!']);

        $formation->title        = $request->has('title') ? $request->title : $formation->title;
        $formation->site         = $request->has('site') ? $request->site : $formation->site;
        $formation->start_date   = $request->has('start_date') ? $request->start_date : $formation->start_date;
        $formation->end_date     = $request->has('end_date') ? $request->end_date : $formation->end_date;
        $formation->description  = $request->has('description') ? $request->description : $formation->description;
        $formation->qte_requis   = $request->has('qte_requis') ? $request->qte_requis : $formation->qte_requis;
        $formation->duree        = $request->has('duree') ? $request->duree : $formation->duree;
        $formation->is_active    = $request->has('is_active') ? $request->is_active : $formation->is_active;
        $formation->type         = $request->has('type') ? $request->type : $formation->type;
        $formation->update();

        return redirect()->back()->with('message', 'Formation mise à jour avec succès');
    }

    public function desactivateOrActivate (Request $request, $number)
    {
        $formation = Formation::whereNumber($numer)->first();

        if (!$formation)
            return redirect()->back()->withErrors(['message' => 'Formation non existante']);

        if ($formation->is_active === 1) {
            $formation->is_active = false;
            $formation->save();

            return redirect()->back()->with('message', 'Formation désactivée');
        }

        if ($formation->is_active === 0) {
            $formation->is_active = true;
            $formation->save();

            return redirect()->back()->with('message', 'Formation activée');
        }
    }

    public function destroy ($id)
    {
        $formation = Formation::whereIsActive(true)->whereId($id)->first();
        if (!$formation)
            return redirect()->back()->withErrors(['message' => 'Formation non existante']);

        $formation->delete();
        return redirect()->back()->with('message', 'Formation supprimée');
    }

}
