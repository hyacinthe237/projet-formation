<?php

namespace App\Http\Controllers\views\front;

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

    public function create ()
    {
        $formations  = Formation::whereIsActive(1)->orderBy('id', 'desc')->get();
        $thematiques  = Thematique::orderBy('id', 'desc')->get();

        return view('front.formateurs.create', compact('formations', 'thematiques'));
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

            return redirect()->back()->with('message', "Votre inscription a été enregistré avec succès");
        }

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['existing' => 'Ce formateur existe déjà']);
    }


}
