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
        $formateur  = Formateur::with('formations', 'formations.formation', 'formations.formation.sites', 'thematiques', 'thematiques.thematique', 'thematiques.thematique')->find($id);
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

            return redirect()->route('formateurs.index')
                            ->withSuccess("Formateur ajouté avec succès");
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

        FormateurFormation::whereFormateurId($formateur->id)->delete();
        FormateurThematique::whereFormateurId($formateur->id)->delete();
        $formateur->delete();
        
        return redirect()->back()->with('message', 'Formateur supprimé');
    }

    /**
     * Store a newly created site formation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function storeThematique(Request $request, $id) {
         $validator = Validator::make($request->all(), [
             'thematique_id' => 'required',
             'start_date' => 'required',
             'end_date'   => 'required'
         ]);

         if ($validator->fails())
             return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs Thematique, Date début & Date fin sont obligatoires']);

         $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
         $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
         $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
         $end_date = Carbon::parse($fin)->format('Y-m-d H:i');

         $formateur = Formateur::find($id);
         if (!$formateur)
             return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Formateur inconnu']);

         $ft = FormateurThematique::whereFormateurId($formateur->id)->whereThematiqueId($request->thematique_id)->first();
         if (!$ft) {
           FormateurThematique::create([
               'formateur_id'   => $formateur->id,
               'thematique_id'  => $request->thematique_id,
               'start_date'     => $start_date,
               'end_date'       => $end_date
           ]);

           return redirect()->back()->with('message', 'Thématique du formateur ajoutée avec succès');
         } else {

           $ft->formateur_id  = $formateur->id;
           $ft->thematique_id = $request->thematique_id;
           $ft->start_date    = $start_date;
           $ft->end_date      = $end_date;
           $ft->update();

           return redirect()->back()->with('message', 'Thématique du formateur modifiée avec succès');
         }
     }

    /**
     * Editer la Thématique d'un formateur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function editThematique ($id) {
         $formateur_thematique = FormateurThematique::with('formateur', 'thematique')->find($id);
         if (!$formateur_thematique)
             return redirect()->back()->withErrors(['status' => 'Thematique inconnue']);

         $thematiques = Thematique::get();

         return view('admin.formateurs.edit-thematique', compact('formateur_thematique', 'thematiques'));
     }

     /**
      * Store a newly created site formation in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function storeFormation(Request $request, $id) {
          $validator = Validator::make($request->all(), [
              'formation_id' => 'required',
          ]);

          if ($validator->fails())
              return redirect()->back()
                 ->withInput($request->all())
                 ->withErrors(['validator' => 'Le champ formation est obligatoire']);

          $formateur = Formateur::find($id);
          if (!$formateur)
              return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Formateur inconnu']);

          $ft = FormateurFormation::whereFormateurId($formateur->id)->whereFormationId($request->formation_id)->first();
          if (!$ft) {
            FormateurFormation::create([
                'formateur_id' => $formateur->id,
                'formation_id' => $request->formation_id
            ]);

            return redirect()->back()->with('message', 'Formation du formateur ajoutée avec succès');
          } else {

            $ft->formateur_id  = $formateur->id;
            $ft->formation_id = $request->formation_id;
            $ft->update();

            return redirect()->back()->with('message', 'Formation du formateur modifiée avec succès');
          }
      }

     /**
      * Editer formation d'un formateur
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function editFormation ($id) {
          $formateur_formation = FormateurFormation::with('formateur', 'formation')->find($id);
          if (!$formateur_formation)
              return redirect()->back()->withErrors(['status' => 'Formation inconnue']);

          $formations = Formation::whereIsActive(true)->get();

          return view('admin.formateurs.edit-formation', compact('formateur_formation', 'formations'));
      }

}
