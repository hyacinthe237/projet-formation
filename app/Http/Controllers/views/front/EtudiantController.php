<?php

namespace App\Http\Controllers\views\front;

use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\Phase;
use App\Models\Etat;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Models\Commune;
use App\Models\CommuneFormation;
use App\Models\Session;
use App\Models\StudentCategory;
use App\Models\Fonction;
use App\Helpers\EtudiantHelper;
use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{

    public function create ()
    {
        $session = Session::whereStatus('pending')->first();
        $formations = CommuneFormation::whereSessionId($session->id)->with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->get();
        $phase = Phase::whereTitle('Formation')->first();
        $etat = Etat::whereName('inscris')->first();
        $categories = StudentCategory::orderBy('name', 'desc')->get();
        $fonctions = Fonction::orderBy('name', 'desc')->get();

        return view('front.etudiants.create', compact('formations', 'communes', 'phase', 'etat', 'fonctions', 'categories'));
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
            'structure_id'         => 'required'
        ]);

        if ($validator->fails()) {
          return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs prénom, email, formation, résidence et téléphone sont obligatoires']);
        }

        $session = Session::whereStatus('pending')->first();
        $existing = Etudiant::whereEmail($request->email)
                    ->wherePhone($request->phone)->first();

        if (!$existing) {
            $etudiant = Etudiant::create([
              'structure_id'    => $request->structure_id,
              'number'          => EtudiantHelper::makeEtudiantNumber(),
              'firstname'       => $request->firstname,
              'lastname'        => $request->lastname,
              'phone'           => $request->phone,
              'email'           => $request->email,
              'sex'             => $request->sex,
              'dob'             => $request->dob,
              'student_category_id'    => $request->student_category_id,
              'fonction_id'     => $request->fonction_id,
              'desc_fonction'   => $request->desc_fonction,
              'form_souhaitee'  => $request->form_souhaitee,
              'diplome_elev'    => $request->diplome_elev,
              'form_compl'      => $request->form_compl,
              'an_exp'          => $request->an_exp,
            ]);

            if ($etudiant) {
                // Driver's signature pad
                if ($request->signature_url !== null) {

                    $encoded_image = explode(",", $request->signature_url)[1];
                    $decoded_image = base64_decode($encoded_image);
                    $fileLocation = public_path('docs/signatures/stagiaire-'.$etudiant->number.'.png');
                    file_put_contents($fileLocation, $decoded_image);

                    $etudiant->signature_url = '/docs/signatures/stagiaire-'.$etudiant->number.'.png';
                    $etudiant->save();
                }

                // if ($request->photo !== null) {
                //     $base64String = file_get_contents(base64_encode($request->photo));
                //     $fileName  = '/uploads/profile/' . $etudiant->number . '_' . time() . '.jpg';
                //     $thumbName = '/uploads/profile/' . $etudiant->number . '_thumbnail_' . time() . '.jpg';
                //
                //     /**
                //      * Resize image to a maximum of 500px width
                //      * Prevent upsizing
                //      * Create a thumbnail of 200 x 200
                //      */
                //     Image::make($base64String)->resize(150, null, function ($img) {
                //         $img->aspectRatio();
                //         // $img->upsize();
                //     })
                //     ->save(public_path() . $fileName)
                //     ->fit(200)
                //     ->save(public_path() . $thumbName);
                //
                //     $etudiant->photo = $fileName;
                //     $etudiant->thumbnail = $thumbName;
                //     $etudiant->save();
                // }

                $form_etud = FormationEtudiant::whereSessionId($session->id)->whereEtudiantId($etudiant->id)
                             ->whereCommuneFormationId($request->commune_formation_id)
                             ->first();

                $commune_formation = CommuneFormation::whereSessionId($session->id)->with('formation')->findOrFail($request->commune_formation_id);
                $count = FormationEtudiant::whereSessionId($session->id)->whereCommuneFormationId($request->commune_formation_id)->count();

                if (!$form_etud && ($count <= $commune_formation->formation->qte_requis)) {
                    $form = FormationEtudiant::create([
                        'session_id'   => $session->id,
                        'etudiant_id'   => $etudiant->id,
                        'commune_formation_id'    => $request->commune_formation_id,
                        'created_at'    => Carbon::now()
                    ]);

                    $form->phases()->sync($request->phase_id);
                    $form->etats()->sync($request->etat_id);

                    return redirect()->back()->with('message', "stagiaire enregistré et ajouté avec succès à la formation");
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
