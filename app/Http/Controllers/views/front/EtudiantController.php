<?php

namespace App\Http\Controllers\views\front;

use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\Phase;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Models\Commune;
use App\Models\CommuneFormation;
use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{

    public function create ()
    {
        $formations = CommuneFormation::with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->get();
        $phase = Phase::whereTitle('Formation')->first();

        return view('front.etudiants.create', compact('formations', 'communes', 'phase'));
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
            'firstname'            => 'required',
            'phone'                => 'required',
            'commune_formation_id' => 'required',
            'residence_id'         => 'required'
        ]);

        if ($validator->fails()) {
          return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs prénom, formation, résidence et téléphone sont obligatoires']);
        }

        $existing = Etudiant::whereResidenceId($request->residence_id)
                    ->whereFirstname($request->firstname)
                    ->wherePhone($request->phone)->first();

        if (!$existing) {
            $etudiant = Etudiant::create([
              'residence_id'    => $request->residence_id,
              'number'          => EtudiantHelper::makeEtudiantNumber(),
              'firstname'       => $request->firstname,
              'lastname'        => $request->lastname,
              'phone'           => $request->phone,
              'email'           => $request->email,
              'sex'             => $request->sex,
              'dob'             => $request->dob,
              'structure'       => $request->structure,
              'fonction'        => $request->fonction,
              'desc_fonction'   => $request->desc_fonction,
              'form_souhaitee'  => $request->form_souhaitee,
              'diplome_elev'    => $request->diplome_elev,
              'form_compl'      => $request->form_compl,
              'an_exp'          => $request->an_exp,
              'is_active'       => $request->is_active,
              'signature_url'   => $request->signature_url,
              'photo'           => $request->photo,
            ]);

            if ($etudiant) {
                $form_etud = FormationEtudiant::whereEtudiantId($etudiant->id)
                             ->whereCommuneFormationId($request->commune_formation_id)
                             ->whereEtat('inscris')
                             ->first();

                $commune_formation = CommuneFormation::with('formation')->findOrFail($request->commune_formation_id);
                $count = FormationEtudiant::whereCommuneFormationId($request->commune_formation_id)->whereEtat('inscris')->count();

                if (!$form_etud && ($count <= $commune_formation->formation->qte_requis)) {
                    $form = FormationEtudiant::create([
                        'etudiant_id'   => $etudiant->id,
                        'commune_formation_id'    => $request->commune_formation_id,
                        'etat'          => 'inscris',
                        'created_at'    => Carbon::now()
                    ]);

                    $form->phases()->sync($request->phase_id);

                    return redirect()->back()->withSuccess("stagiaire enregistré et ajouté avec succès à la formation");
                } else {
                  return redirect()->back()
                         ->withErrors(['existing' => 'stagiaire enregistré, mais pas lié à la formation car le quota requis est atteint']);
                }

            }
        } else {
          return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['existing' => 'Ce stagiaire a déjà été enregistré']);
        }

    }


}
