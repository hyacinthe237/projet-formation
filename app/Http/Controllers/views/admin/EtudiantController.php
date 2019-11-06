<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Models\Commune;
use App\Models\CommuneFormation;
use App\Helpers\EtudiantHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $etudiants = Etudiant::with('residence', 'formations', 'formations.site', 'formations.site.commune', 'formations.site.formation')
      ->when($keywords, function($query) use ($keywords) {
          return $query->where('firstname', 'like', '%'.$keywords.'%')
                      ->orWhere('lastname', 'like', '%'.$keywords.'%')
                      ->orWhere('fonction', 'like', '%'.$keywords.'%')
                      ->orWhere('structure', 'like', '%'.$keywords.'%');
      })
      ->when($request->residence_id, function($query) use ($request) {
          return $query->where('residence_id', $request->residence_id);
      })

      ->orderBy('id', 'desc')
      ->paginate(50);

      $formations = CommuneFormation::with('commune', 'formation')->orderBy('id', 'desc')->get();
      $communes = Commune::orderBy('name', 'asc')->get();

      return view('admin.etudiants.index', compact('etudiants', 'formations', 'communes'));
  }

    public function create ()
    {
        $formations = CommuneFormation::with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->get();
        return view('admin.etudiants.create', compact('formations', 'communes'));
    }

    public function edit ($number)
    {
        $etudiant  = Etudiant::with('formations', 'formations.site', 'formations.site.commune', 'formations.site.formation')
                      ->whereNumber($number)->first();

        if (!$etudiant)
            return redirect()->route('etudiants.index');

        $formations = CommuneFormation::with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->get();

        return view('admin.etudiants.edit', compact('formations', 'communes', 'etudiant'));
    }

    public function inscrireEtudiant (Request $request, $number) {
       $etudiant  = Etudiant::whereNumber($number)->whereIsActive(true)->first();

       if (!$etudiant)
         return redirect()->back()->withErrors(['existing' => 'Etudiant non actif']);

         $form_etud = FormationEtudiant::whereEtudiantId($etudiant->id)
                      ->whereCommuneFormationId($request->commune_formation_id)
                      ->whereEtat('inscris')
                      ->first();

         $commune_formation = CommuneFormation::with('formation')->findOrFail($request->commune_formation_id);
         $count = FormationEtudiant::whereCommuneFormationId($request->commune_formation_id)->whereEtat('inscris')->count();

         if (!$form_etud && ($count <= $commune_formation->formation->qte_requis)) {
             FormationEtudiant::create([
                 'etudiant_id'          => $etudiant->id,
                 'commune_formation_id' => $request->commune_formation_id,
                 'etat'                 => 'inscris',
                 'created_at'           => Carbon::now()
             ]);

             return redirect()->back()->with('message', 'Etudiant enregistré et ajouté avec succès à la formation');
         } else {
            return redirect()->back()->withErrors(['existing' => "Nombre requis de la formation est atteind ou Vous voulez inscrire l'étudiant à formation qui suit déjà"]);
         }
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
            'firstname' => 'required',
            'email' => 'required',
            'formation_id' => 'required',
            'residence_id' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInputwithErrors(['validator' => 'Les champs Prénom, residence & Email sont obligatoires']);

        $existing = Etudiant::whereFirstname($request->firstname)->whereLastname($request->lastname)->first();
        if (!$existing) {
            $etudiant = Etudiant::create([
              'residence_id'     => $request->residence_id,
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
                    FormationEtudiant::create([
                        'etudiant_id'   => $etudiant->id,
                        'commune_formation_id'    => $request->commune_formation_id,
                        'etat'          => 'inscris',
                        'created_at'    => Carbon::now()
                    ]);

                    return redirect()->route('etudiants.index')
                                    ->withSuccess("Etudiant enregistré et ajouté avec succès à la formation");
                } else {
                  return redirect()->back()
                         ->withErrors(['existing' => 'Etudiant enregistré, mais pas lié à la formation car le quota requis est atteint']);
                }
            }
        }

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
            'residence_id' => 'required',
            'firstname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Prénom, residence & Email sont obligatoires']);

        $etudiant = Etudiant::whereNumber($number)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['user' => 'Etudiant inconnu!']);

        $etudiant->residence_id      = $request->has('residence_id') ? $request->residence_id : $etudiant->residence_id;
        $etudiant->firstname         = $request->has('firstname') ? $request->firstname : $etudiant->firstname;
        $etudiant->lastname          = $request->has('lastname') ? $request->lastname : $etudiant->lastname;
        $etudiant->phone             = $request->has('phone') ? $request->phone : $etudiant->phone;
        $etudiant->email             = $request->has('email') ? $request->email : $etudiant->email;
        $etudiant->sex               = $request->has('sex') ? $request->sex : $etudiant->sex;
        $etudiant->dob               = $request->has('dob') ? $request->dob : $etudiant->dob;
        $etudiant->structure         = $request->has('structure') ? $request->structure : $etudiant->structure;
        $etudiant->desc_fonction     = $request->has('desc_fonction') ? $request->desc_fonction : $etudiant->desc_fonction;
        $etudiant->form_souhaitee    = $request->has('form_souhaitee') ? $request->form_souhaitee : $etudiant->form_souhaitee;
        $etudiant->form_initiale     = $request->has('form_initiale') ? $request->form_initiale : $etudiant->form_initiale;
        $etudiant->diplome_elev      = $request->has('diplome_elev') ? $request->diplome_elev : $etudiant->diplome_elev;
        $etudiant->form_compl        = $request->has('form_compl') ? $request->form_compl : $etudiant->form_compl;
        $etudiant->an_exp            = $request->has('an_exp') ? $request->an_exp : $etudiant->an_exp;
        $etudiant->is_active         = $request->has('is_active') ? $request->is_active : $etudiant->is_active;
        $etudiant->signature_url     = $request->has('signature_url') ? $request->signature_url : $etudiant->signature_url;
        $etudiant->photo             = $request->has('photo') ? $request->photo : $etudiant->photo;
        $etudiant->update();

        return redirect()->back()->with('message', 'Etudiant mis à jour avec succès');
    }

    public function desactivateOrActivate (Request $request, $number)
    {
        $etudiant = Etudiant::whereNumber($numer)->first();

        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Etudiant non existant']);

        if ($etudiant->is_active === 1) {
            $etudiant->is_active = false;
            $etudiant->save();

            return redirect()->back()->with('message', 'Etudiant désactivé');
        }

        if ($etudiant->is_active === 0) {
            $etudiant->is_active = true;
            $etudiant->save();

            return redirect()->back()->with('message', 'Etudiant activé');
        }
    }

    public function destroy ($id)
    {
        $etudiant = Etudiant::whereIsActive(true)->whereId($id)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Etudiant non existant']);

        $etudiant->delete();
        return redirect()->back()->with('message', 'Etudiant supprimé');
    }

    /**
     * Download PDF Etudiant
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    public function downloadEtudiant ()
    {
        $data = self::takeEtudiantInfos();

        $pdf = PDF::loadView('pdfs.etudiant', $data);
        return $pdf->stream();
    }

    /**
     * Recup Etudiant Information
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    private static function takeEtudiantInfos ()
    {
        $etudiants = Etudiant::with('residence', 'formations')->whereIsActive(true)->get();

        $data = [
            'etudiants' => $etudiants
        ];

        return $data;
    }

}
