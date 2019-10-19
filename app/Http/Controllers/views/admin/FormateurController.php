<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Thematique;
use App\Models\FormateurFormation;
use App\Models\FormateurThematique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FormateurController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $formateurs = Formateur::when($keywords, function($query) use ($keywords) {
          return $query->where('firstname', 'like', '%'.$keywords.'%')
          ->orWhere('lastname', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.formateurs.index', compact('formateurs'));
  }

    public function create ()
    {
        $formations  = Formation::whereIsActive(1)->orderBy('id', 'desc')->get();
        $thematiques  = Thematique::orderBy('id', 'desc')->get();
        return view('admin.formateurs.create', compact('formations', 'thematiques'));
    }

    public function edit ($id)
    {
        $formateur  = Formateur::with('formations', 'thematiques', 'thematiques.thematique', 'thematiques.thematique')->find($id);
        $formations  = Formation::whereIsActive(1)->orderBy('id', 'desc')->get();
        $thematiques  = Thematique::orderBy('id', 'desc')->get();
        
        if (!$formateur)
            return redirect()->route('formateurs.index');

        return view('admin.formateurs.edit', compact('formateur', 'formations', 'thematiques'));
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
            'formation_id'  => 'required',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'qualification' => 'required',
            'type'          => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existingFormateur = Formateur::whereFirstname($request->firstname)->whereLastname($request->lastname)->first();
        $formation = Formation::find($request->formation_id);
        $thematique = Thematique::find($request->thematique_id);

        $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
        $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
        $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
        $end_date = Carbon::parse($fin)->format('Y-m-d H:i');

        if (!$existingFormateur) {
            $formateur = Formateur::create([
              'firstname'      => $request->firstname,
              'lastname'       => $request->lastname,
              'qualification'  => $request->qualification,
              'type'           => $request->type
            ]);

            if ($formateur) {
              FormateurFormation::create([
                'formateur_id' => $formateur->id,
                'formation_id' => $formation->id
              ]);

              FormateurThematique::create([
                'formateur_id'  => $formateur->id,
                'thematique_id' => $thematique->id,
                'start_date'    => $start_date,
                'end_date'      => $end_date
              ]);

            }

            return redirect()->back()->with('message', 'Formateur ajouté avec succès');
        }

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['existing' => 'Ce formateur existe déjà']);
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
            'firstname'     => 'required',
            'lastname'      => 'required',
            'qualification' => 'required',
            'type'          => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $formateur = Formateur::find($id);
        if (!$formateur)
            return redirect()->back()->withErrors(['formateur' => 'Formateur inconnu!']);

        $formateur->firstname      = $request->has('firstname') ? $request->firstname : $formateur->firstname;
        $formateur->lastname       = $request->has('lastname') ? $request->lastname : $formateur->lastname;
        $formateur->qualification  = $request->has('qualification') ? $request->qualification : $formateur->qualification;
        $formateur->type           = $request->has('type') ? $request->type : $formateur->type;
        $formateur->update();

        return redirect()->back()->with('message', 'Formateur mis à jour avec succès');
    }

    public function destroy ($id)
    {
        $formateur = Formateur::find($id);
        if (!$formateur)
            return redirect()->back()->withErrors(['message' => 'formateur non existant']);

        $formateur->delete();
        return redirect()->back()->with('message', 'Formateur supprimé');
    }

}
