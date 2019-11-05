<?php

namespace App\Http\Controllers\views\front;

use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Helpers\EtudiantHelper;
use App\Traits\Uploads;
use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{
    use Uploads;

    public function create ()
    {
        $formations = Formation::orderBy('id', 'desc')->get();
        // $locations = Location::orderBy('id', 'desc')->get();
        return view('front.etudiants.create', compact('formations'));
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
            'firstname'    => 'required',
            'email'        => 'required',
            'structure'    => 'required',
            'formation_id' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Prénom & Email sont obligatoires']);

        $existing = Etudiant::whereFirstname($request->firstname)->whereLastname($request->lastname)->first();

        if (!$existing) {
            $etudiant = Etudiant::create([
              'location_id'     => $request->location_id,
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
              'an_exp'          => $request->an_exp
            ]);

            if ($etudiant) {
                $form_etud = FormationEtudiant::whereFormationId($request->formation_id)->whereEtat('inscris')->first();
                $formation = Formation::findOrFail($request->formation_id);
                $count = FormationEtudiant::whereFormationId($request->formation_id)->whereEtat('inscris')->count();

                // Student's signature pad
                if ($request->signature_url !== null)
                    EtudiantHelper::signaturePAD($etudiant, $request->signature_url);

                // Upload photo
                if ($request->photo !== null) {
                    $file = $this->upload($request->photo, self::USER_IMAGE_FOLDER);

                    $etudiant->photo = $file->link;
                    $etudiant->save;
                }

                if (!$form_etud && ($count <= $formation->qte_requis)) {
                    FormationEtudiant::create([
                        'etudiant_id'  => $etudiant->id,
                        'formation_id'  => $formation->id,
                        'etat'          => 'inscris',
                        'created_at'    => Carbon::now()
                    ]);

                    return redirect()->back()->with('message', 'Etudiant enregistré et ajouté avec succès à la formation');
                } else {
                  return redirect()->back()
                         ->withErrors(['existing' => 'Etudiant enregistré, mais pas lié à la formation car le quota requis est atteint. Contacter le PNFMV la suite...']);
                }


            }

            return redirect()->back()->with('message', 'Votre inscription a bien été prise en compte.');
        }

        return redirect()->back()->withErrors(['existing' => 'Vous avez déjà été enregistré. Contactez le propriétaire du site']);
    }

}
