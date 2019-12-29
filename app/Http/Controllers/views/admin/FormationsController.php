<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Commune;
use App\Models\FormationEtudiant;
use App\Models\CommuneFormation;
use App\Helpers\FormationHelper;
use App\Repositories\FormationRepository as formRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FormationsController extends Controller
{
    private $formRepo;

    // model args
    public function __construct(formRepo $formRepo)
    {
        $this->formRepo = $formRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request) {
         $status = $request->is_active;
         $stagiaires = Etudiant::whereIsActive(true)->count();
         $formations = Formation::with(['sites', 'sites.commune', 'phases'])
             ->when($request->keywords, function($query) use ($request) {
                 return $query->where('title', 'like', '%'.$request->keywords.'%');
             })
             ->when($status, function($query) use ($status) {
                 return $query->where('is_active', $status);
             })
             ->orderBy('id', 'desc')
             ->paginate(50);

         return view('admin.formations.index', compact('formations', 'stagiaires', 'status'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create () {
         $communes = Commune::orderBy('name', 'asc')->get();

         return view('admin.formations.create', compact('communes'));
     }

    /**
     * Store a newly created formation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request) {
         $validator = Validator::make($request->all(), [
             'title'      => 'required'
         ]);

         if ($validator->fails())
             return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Le champ Titre est obligatoire']);

         $existing = Formation::whereTitle($request->title)->first();

         $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
         $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
         $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
         $end_date = Carbon::parse($fin)->format('Y-m-d H:i');
         $duree = FormationHelper::dateDifference($start_date, $end_date, '%a');

         if (!$existing) {
             $formation = Formation::create([
               'number'      => FormationHelper::makeFormationNumber(),
               'title'       => $request->title,
               'description' => $request->description,
               'is_active'   => $request->is_active
             ]);

            $formation->phases()->attach([1,2]);

             CommuneFormation::create([
                 'formation_id' => $formation->id,
                 'commune_id'  => $request->commune_id,
                 'start_date'  => $start_date,
                 'end_date'    => $end_date,
                 'duree'       => $duree > 1 ? $duree . ' jours' : $duree . ' jour',
                 'qte_requis'  => $request->qte_requis,
                 'type'        => $request->type
             ]);

             return redirect()->back()->with('message', 'Formation ajoutée avec succès');
         }

         return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['existing' => 'Cette Formation existe déjà']);
     }
    /**
     * Store a newly created site formation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function storeSite(Request $request, $number) {
         $validator = Validator::make($request->all(), [
             'commune_id' => 'required',
             'start_date' => 'required',
             'end_date'   => 'required'
         ]);

         if ($validator->fails())
             return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs Site, Date début & Date fin sont obligatoires']);

         $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
         $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
         $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
         $end_date = Carbon::parse($fin)->format('Y-m-d H:i');
         $duree = FormationHelper::dateDifference($start_date, $end_date, '%a');

         $formation = Formation::whereNumber($number)->whereIsActive(true)->first();
         if (!$formation)
             return redirect()->back()->withErrors(['status' => "Cette Formation n'est pas active"]);

         $site = CommuneFormation::whereFormationId($formation->id)->whereCommuneId($request->commune_id)->first();
         if (!$site) {
           CommuneFormation::create([
               'formation_id' => $formation->id,
               'commune_id'  => $request->commune_id,
               'start_date'  => $start_date,
               'end_date'    => $end_date,
               'duree'       => $duree > 1 ? $duree . ' jours' : $duree . ' jour',
               'qte_requis'  => $request->qte_requis,
               'type'        => $request->type
           ]);

           return redirect()->route('formation.edit', $formation->number)->with('message', 'Site ajouté avec succès');
         } else {
           return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['status' => "Vous tentez d'ajouter un site qui existe deja pour cette formation"]);
         }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($number) {
      $formation  = Formation::whereNumber($number)->first();
      if (!$formation)
          return redirect()->route('formations.index');

      return view('admin.formations.show', compact('formation'));
    }

    /**
     * Editer une formation.
     *
     * @param  int  $number
     * @return \Illuminate\Http\Response
     */
     public function edit ($number) {
         $formation  = Formation::whereNumber($number)->with('phases', 'formateurs', 'formateurs.formateur', 'sites', 'sites.commune', 'sites.etudiants')->first();
         if (!$formation)
             return redirect()->route('formation.edit', $formation->number);

         $communes   = Commune::with('departement', 'departement.region')->get();
         $formation->commune_formations = CommuneFormation::with('etudiants.etudiant')->whereFormationId($formation->id)->get();
         $formation->etudiants = $this->formRepo->getStagiaireFormation($formation->id);

         return view('admin.formations.edit', compact('formation', 'communes'));
     }

    /**
     * Editer le site d'une formation
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function editSite ($id) {
         $site = CommuneFormation::with('formation', 'commune', 'etudiants')->find($id);
         if (!$site)
             return redirect()->back()->withErrors(['status' => 'Site inconnu']);

         $communes = Commune::orderBy('name', 'asc')->get();
         $etudiants  = Etudiant::whereIsActive(true)->get();

         return view('admin.formations.edit-site', compact('communes', 'etudiants', 'site'));
     }

     /**
      * Ajouter un etudiant a une formation
      *
      * @param  int  $number
      * @return \Illuminate\Http\Response
      */
     public function ajouterEtudiant (Request $request, $id) {
        $commune_formation  = CommuneFormation::find($id);
        $etudiant  = Etudiant::whereIsActive(true)->find($request->etudiant_id);

        if (!$commune_formation)
          return redirect()->back()->withErrors(['existing' => 'Formation non active']);

        if (!$etudiant)
          return redirect()->back()->withErrors(['existing' => 'Etudiant non actif']);

          $form_etud = FormationEtudiant::whereEtudiantId($etudiant->id)
                       ->whereCommuneFormationId($commune_formation->id)
                       ->whereEtat('inscris')
                       ->first();

          $count = FormationEtudiant::whereCommuneFormationId($commune_formation->id)->whereEtat('inscris')->count();

          if (!$form_etud && ($count <= $formation->qte_requis)) {
              FormationEtudiant::create([
                  'etudiant_id'          => $etudiant->id,
                  'commune_formation_id' => $commune_formation->id,
                  'etat'                 => 'inscris',
                  'created_at'           => Carbon::now()
              ]);

              return redirect()->back()->with('message', 'Etudiant ajouté avec succès à la formation');
          } else {
             return redirect()->back()->withErrors(['existing' => "Nombre requis de la formation est atteind ou Vous voulez inscrire l'étudiant à formation qui suit déjà"]);
          }
     }

    /**
     * Update Une formation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $number) {

         $validator = Validator::make($request->all(), [
             'title'      => 'required'
         ]);

         if ($validator->fails())
             return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Le champ Titre est obligatoire']);

         $formation = Formation::whereNumber($number)->first();
         if (!$formation)
             return redirect()->back()->withErrors(['user' => 'Formation inconnue!']);

         $formation->title        = $request->has('title') ? $request->title : $formation->title;
         $formation->description  = $request->has('description') ? $request->description : $formation->description;
         $formation->is_active    = $request->has('is_active') ? $request->is_active : $formation->is_active;
         $formation->update();

         return redirect()->back()->with('message', 'Formation mise à jour avec succès');
     }

    /**
     * Update the site resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function updateSite(Request $request, $id) {

         $validator = Validator::make($request->all(), [
             'commune_id' => 'required',
             'start_date' => 'required',
             'end_date'   => 'required'
         ]);

         if ($validator->fails())
             return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['validator' => 'Les champs Site, Date début & Date fin sont obligatoires']);

         $formation = Formation::whereId($request->formation_id)->first();
         $site = CommuneFormation::whereId($id)->first();
         if (!$site)
             return redirect()->back()->withErrors(['user' => 'Site inconnu']);

         $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
         $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
         $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
         $end_date = Carbon::parse($fin)->format('Y-m-d H:i');
         $duree = FormationHelper::dateDifference($start_date, $end_date, '%a');

         $site->commune_id   = $request->has('commune_id') ? $request->commune_id : $site->commune_id;
         $site->start_date   = $request->has('start_date') ? $start_date : $site->start_date;
         $site->end_date     = $request->has('end_date') ? $end_date : $site->end_date;
         $site->duree        = $duree > 1 ? $duree . ' jours' : $duree . ' jour';
         $site->type         = $request->has('type') ? $request->type : $site->type;
         $site->qte_requis   = $request->has('qte_requis') ? $request->qte_requis : $site->qte_requis;
         $site->update();

         return redirect()->route('formation.edit', $formation->number)->with('message', 'Site mit à jour avec succès');
     }

     public function desactivateOrActivate ($number) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy ($id) {
         $formation = Formation::whereIsActive(true)->whereId($id)->first();
         if (!$formation)
             return redirect()->back()->withErrors(['message' => 'Formation non existante']);

         $formation->delete();
         return redirect()->back()->with('message', 'Formation supprimée');
     }

     /**
      * Download PDF Formation
      * @param  [type] $id [description]
      * @return [type]         [description]
      */
     public function downloadFormation ()
     {
         $data = self::takeFormationInfos();

         $pdf = PDF::loadView('pdfs.formation', $data);
         return $pdf->stream();
     }

     /**
      * Recup Formation Information
      * @param  [type] $id [description]
      * @return [type]         [description]
      */
     private static function takeFormationInfos ()
     {
         $formations = Formation::with('sites', 'sites.commune')->whereIsActive(true)->get();

         $data = [
             'formations' => $formations
         ];

         return $data;
     }
}
