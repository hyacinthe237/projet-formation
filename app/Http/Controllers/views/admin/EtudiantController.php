<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Phase;
use App\Models\Etat;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Models\FormationEtudiantEtat;
use App\Models\FormationEtudiantPhase;
use App\Models\Commune;
use App\Models\CommuneFormation;
use App\Models\Session;
use App\Models\StudentCategory;
use App\Models\Fonction;
use App\Helpers\EtudiantHelper;
use App\Repositories\EtudiantRepository as etudiantRepo;
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
  public function index(Request $request, etudiantRepo $etudiantRepo) {
      $data = self::takeEtudiantInfos($request, $etudiantRepo);

      return view('admin.etudiants.index', compact('data'));
  }

    public function create () {
        $session = Session::whereStatus('pending')->first();
        $formations = CommuneFormation::whereSessionId($session->id)->with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->orderBy('name', 'asc')->get();
        $phase = Phase::whereTitle('Formation')->first();
        $etat = Etat::whereName('inscris')->first();
        $categories = StudentCategory::orderBy('name', 'asc')->get();
        $fonctions = Fonction::orderBy('name', 'asc')->get();

        return view('admin.etudiants.create', compact('formations', 'communes', 'phase', 'etat', 'fonctions', 'categories'));
    }

    public function edit ($number)
    {
        $session = Session::whereStatus('pending')->first();
        $etudiant  = Etudiant::with('formations', 'formations.phases', 'formations.site', 'formations.site.commune', 'formations.site.formation')
                      ->whereNumber($number)->first();

        if (!$etudiant)
            return redirect()->route('stagiaires.index');

        $formations = CommuneFormation::whereSessionId($session->id)->with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::with('departement', 'departement.region')->orderBy('id', 'asc')->get();
        $phases = Phase::get();
        $etats = Etat::get();
        $categories = StudentCategory::orderBy('name', 'asc')->get();
        $fonctions = Fonction::orderBy('name', 'asc')->get();
        $session = Session::whereStatus('pending')->first();

        $ind = 0;
        foreach ($formations as $key => $item) {
          $count = FormationEtudiant::whereSessionId($session->id)->whereCommuneFormationId($item->id)->count();
          if ($count === $item->qte_requis) {
            $formations = $formations->where('id', '<>', $item->id)->get();
          }
        }

        return view('admin.etudiants.edit', compact('formations', 'communes', 'etudiant', 'phases', 'etats', 'fonctions', 'categories'));
    }

    public function editEtudiantFormation ($id)
    {
        $session = Session::whereStatus('pending')->first();
        $phases = Phase::get();
        $etats = Etat::get();
        $form_etud  = FormationEtudiant::with('phases', 'etats', 'etudiant')->find($id);
        if (!$form_etud)
            return redirect()->route('stagiaires.index');

        $formations = CommuneFormation::whereSessionId($session->id)->with('commune', 'formation')->orderBy('id', 'desc')->get();

        return view('admin.etudiants.edit-formation', compact('form_etud', 'formations', 'phases', 'etats'));
    }

    public function inscrireEtudiant (Request $request, $number) {
       $etudiant  = Etudiant::whereNumber($number)->whereIsActive(true)->first();
       $session = Session::whereStatus('pending')->first();

       if (!$etudiant)
         return redirect()->back()->withErrors(['existing' => 'stagiaire non actif']);

         $form_etud = FormationEtudiant::whereSessionId($session->id)->whereEtudiantId($etudiant->id)
                      ->whereCommuneFormationId($request->commune_formation_id)
                      ->first();

         $commune_formation = CommuneFormation::whereSessionId($session->id)->with('formation')->findOrFail($request->commune_formation_id);
         $count = FormationEtudiant::whereSessionId($session->id)->whereCommuneFormationId($request->commune_formation_id)->count();

         if (!$form_etud && ($count <= $commune_formation->qte_requis)) {
             $form = FormationEtudiant::create([
                 'session_id'           => $session->id,
                 'etudiant_id'          => $etudiant->id,
                 'commune_formation_id' => $commune_formation->id,
                 'created_at'           => Carbon::now()
             ]);

             if ($request->phases)
                $form->phases()->sync($request->phases);

             if ($request->etats)
                $form->etats()->sync($request->etats);

             return redirect()->back()->with('message', 'stagiaire enregistré et ajouté avec succès à la formation');
         } else {
            return redirect()->back()->withErrors(['validator' => 'Le quota des inscriptions à cette formation a atteind !']);
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
            'phone' => 'required',
            'commune_formation_id' => 'required',
            'structure_id' => 'required'
        ]);

        if ($validator->fails()) {
          return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs prénom, formation, structure et Telephone sont obligatoires']);
        }

        $session = Session::whereStatus('pending')->first();
        $existing = Etudiant::wherePhone($request->phone)->first();

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
              'student_category_id' => $request->student_category_id,
              'fonction_id'     => $request->fonction_id,
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
                $commune_formation = CommuneFormation::whereSessionId($session->id)->with('formation')->findOrFail($request->commune_formation_id);
                $form_etud = FormationEtudiant::whereSessionId($session->id)->whereEtudiantId($etudiant->id)
                             ->whereCommuneFormationId($commune_formation->id)->first();

                $count = FormationEtudiant::whereSessionId($session->id)->whereCommuneFormationId($commune_formation->id)->count();

                if (!$form_etud && ($count <= $commune_formation->qte_requis)) {
                    $form = FormationEtudiant::create([
                        'session_id'   => $session->id,
                        'etudiant_id'   => $etudiant->id,
                        'commune_formation_id'    => $commune_formation->id,
                        'created_at'    => Carbon::now()
                    ]);

                    $form->phases()->sync($request->phase_id);
                    $form->etats()->sync($request->etat_id);

                    return redirect()->route('stagiaires.edit', $etudiant->number)
                                    ->with('message', "stagiaire enregistré et ajouté avec succès à la formation");
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEtudiantFormation (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'phases' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Phase obligatoire']);

        $form_etud = FormationEtudiant::find($id);
        if (!$form_etud)
            return redirect()->back()->withErrors(['user' => 'Formation non existante']);

        $form_etud->commune_formation_id = $request->has('commune_formation_id') ? $request->commune_formation_id : $form_etud->commune_formation_id;
        $form_etud->save();
        $form_etud->phases()->sync($request->phases);
        $form_etud->etats()->sync($request->etats);

        return redirect()->back()->with('message', 'Mise à jour effectuée succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $number) {
        $validator = Validator::make($request->all(), [
            'structure_id' => 'required',
            'firstname' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Les champs Prénom, structure & Telephone sont obligatoires']);

        $etudiant = Etudiant::whereNumber($number)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['user' => 'Stagiaire inconnu!']);

        $etudiant->structure_id      = $request->has('structure_id') ? $request->structure_id : $etudiant->structure_id;
        $etudiant->firstname         = $request->has('firstname') ? $request->firstname : $etudiant->firstname;
        $etudiant->lastname          = $request->has('lastname') ? $request->lastname : $etudiant->lastname;
        $etudiant->phone             = $request->has('phone') ? $request->phone : $etudiant->phone;
        $etudiant->email             = $request->has('email') ? $request->email : $etudiant->email;
        $etudiant->sex               = $request->has('sex') ? $request->sex : $etudiant->sex;
        $etudiant->dob               = $request->has('dob') ? $request->dob : $etudiant->dob;
        $etudiant->student_category_id      = $request->has('student_category_id') ? $request->student_category_id : $etudiant->student_category_id;
        $etudiant->fonction_id       = $request->has('fonction_id') ? $request->fonction_id : $etudiant->fonction_id;
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

        return redirect()->back()->with('message', 'Stagiaire mis à jour avec succès');
    }

    public function desactivateOrActivate (Request $request, $number)
    {
        $etudiant = Etudiant::whereNumber($numer)->first();

        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Stagiaire non existant']);

        if ($etudiant->is_active === 1) {
            $etudiant->is_active = false;
            $etudiant->save();

            return redirect()->back()->with('message', 'Stagiaire désactivé');
        }

        if ($etudiant->is_active === 0) {
            $etudiant->is_active = true;
            $etudiant->save();

            return redirect()->back()->with('message', 'Stagiaire activé');
        }
    }

    public function destroy ($id)
    {
        $etudiant = Etudiant::whereIsActive(true)->whereId($id)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Stagiaire non existant']);

        $form_etud = FormationEtudiant::whereEtudiantId($etudiant->id)->get();
        if ($form_etud) {
            foreach ($form_etud as $item) {
                FormationEtudiantPhase::whereFormationEtudiantId($item->id)->delete();
                FormationEtudiantEtat::whereFormationEtudiantId($item->id)->delete();
            }
        }

        $etudiant->delete();

        return redirect()->route('stagiaires.index')->with('message', 'Stagiaire supprimé');
    }

    public function desincrire ($id) {
      $form_etud = FormationEtudiant::find($id);
      if (!$form_etud)
          return redirect()->back()->withErrors(['message' => 'Enregistrement non existant']);

      FormationEtudiantPhase::whereFormationEtudiantId($form_etud->id)->delete();
      FormationEtudiantEtat::whereFormationEtudiantId($form_etud->id)->delete();
      $form_etud->delete();
      return redirect()->back()->with('message', 'Stagiaire desincris avec succès');
    }

    public function removeEtudiantFormation ($id) {
      $form_etud = FormationEtudiant::with('etudiant')->find($id);
      if (!$form_etud)
          return redirect()->back()->withErrors(['message' => 'Enregistrement non existant']);

      $etud = Etudiant::find($form_etud->etudiant_id);
      $form_etud->delete();

      return redirect()->route('stagiaires.edit', $etud->number)->with('message', 'Stagiaire desincris avec succès');
    }

    /**
     * Download PDF Etudiant
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    public function downloadEtudiant (Request $request, etudiantRepo $etudiantRepo)
    {
        $data = self::takeEtudiantInfos($request, $etudiantRepo);

        $pdf = PDF::loadView('pdfs.etudiant', $data);
        return $pdf->stream();
    }

    /**
     * Recup Etudiant Information
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    private static function takeEtudiantInfos (Request $request, etudiantRepo $etudiantRepo)
    {
        $keywords = $request->keywords;
        $commune_formation = $request->commune_formation;
        $structure = $request->structure;
        $fonction = $request->fonction;

        $etudiants = Etudiant::with('category', 'formations', 'formations.site',
        'formations.site.commune', 'formations.site.formation', 'structure', 'fonction')
        ->when($keywords, function($query) use ($keywords) {
            return $query->where('firstname', 'like', '%'.$keywords.'%')
                        ->orWhere('lastname', 'like', '%'.$keywords.'%');
        })
        ->when($commune_formation, function ($q) use ($commune_formation) {
            return $q->whereHas('formations', function($sql) use ($commune_formation) {
                return $sql->where('commune_formation_id', '=', $commune_formation);
            });
        })
        ->when($structure, function($query) use ($structure) {
            return $query->where('structure_id', '=', $structure);
        })
        ->when($fonction, function($query) use ($fonction) {
            return $query->where('fonction_id', '=', $fonction);
        })
        ->where('deleted_at', null)
        ->orderBy('lastname', 'asc')
        ->paginate(self::BACKEND_PAGINATE);

        $session = Session::whereStatus('pending')->first();
        $formations = CommuneFormation::whereSessionId($session->id)->with('commune', 'formation')->orderBy('id', 'desc')->get();
        $communes = Commune::orderBy('name', 'asc')->get();
        $categories = StudentCategory::orderBy('name', 'asc')->get();
        $fonctions = Fonction::orderBy('name', 'asc')->get();

        $data = [
            'etudiants' => $etudiants,
            'formations' => $formations,
            'communes' => $communes,
            'categories' => $categories,
            'fonctions' => $fonctions,
        ];

        return $data;
    }

}
