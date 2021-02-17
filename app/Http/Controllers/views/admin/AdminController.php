<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\FormationEtudiant;
use App\Models\CommuneFormation;
use App\Models\Formateur;
use App\Models\Region;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Thematique;
use App\Models\Session;
use App\Models\Setting;
use App\Repositories\AdminRepository as adminRepo;
use App\Repositories\FormationRepository as formRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $adminRepo;
    private $formRepo;

    // model args
    public function __construct(adminRepo $adminRepo, formRepo $formRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->formRepo = $formRepo;
    }

    public function getDashboard () {
        $session = Session::whereStatus('pending')->first();
        $communes = CommuneFormation::with('commune', 'formation')->whereSessionId($session->id)->get();
        if (!$communes) return response()->json([]);

        return response()->json($communes);
    }

    public function dashboard (Request $request)
    {
        $user    = User::find(Auth::id());
        $users   = User::whereIsActive(true)->get();
        $session = Session::whereStatus('pending')->first();
        $data    = self::takeInfos($this->adminRepo, $this->formRepo, $session);

        if ($request->start_date) {
            $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
            $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
            $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
            $end_date = Carbon::parse($fin)->format('Y-m-d H:i');

            $communeParPeriode  = $this->adminRepo->getCommunesToucherParPeriode($start_date, $end_date);
        }

        return view('admin.all.dashboard', compact(['data', 'users', 'user', 'requetes', 'session']));
    }

    /**
     * Download PDF Formation
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    public function download (adminRepo $adminRepo, formRepo $formRepo)
    {
        $session = Session::whereStatus('pending')->first();

        $data = self::takeInfos($adminRepo, $formRepo, $session);

        $pdf = PDF::loadView('pdfs.dashboard', $data);
        return $pdf->stream();
    }

    /**
     * Recup Formation Information pqr session
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    private static function takeInfos ($adminRepo, $formRepo, $session)
    {
        $allFormations = Formation::whereSessionId($session->id)->whereIsActive(true)->with('sites', 'sites.etudiants')->get();
        foreach ($allFormations as $item) {
          foreach ($item->sites as $value) {
              $item->nb_prevus += $value->qte_requis;
              $item->nb_effectif += count($value->etudiants);
          }
        }

        $communes      = Commune::get();
        $setting      = Setting::whereSessionId($session->id)->first();
        $personnes_diplome  = $adminRepo->getPersonnesParDiplome();
        $evaluations  = $adminRepo->getEvaluations($session->id);
        $personnes_age  = $adminRepo->getPersonnesParAge();
        $personnes_agesex  = $adminRepo->getPersonnesParGenreEtAge();
        $departements  = Departement::get();
        $regions       = Region::where('id', '<>', 11)->get();
        $communesToucher  = $adminRepo->getCommunesToucher($session->id);
        $totalPersonnePrevuFormer  = $adminRepo->getTotalPersonnePrevuFormer($session->id);
        $formationExecuter  = $adminRepo->getFormationExecuter($session->id);
        $etudiants     = $adminRepo->getStagiaires($session->id);
        $stat_restantes     = $adminRepo->getCTDRestantes($session->id);
        $stat_touchees     = $adminRepo->getCTDTouchees($session->id);
        $stat_plus     = $adminRepo->getCTDPlusUneFois($session->id);
        $stat_new     = $adminRepo->getCTDNouvelles($session->id);
        $stat_2015     = $adminRepo->getCTD2015();
        $formateurs    = Formateur::get();
        $formations    = CommuneFormation::whereSessionId($session->id)->with('formation', 'commune', 'evaluations')->get();
        $totalCommunesToucher = 0;
        $totalCommunesNonToucher = 0;
        $totalPersonnesIncrites = 0;
        $totalPersonnesFormees = 0;
        $totalPersonnesCU = 0;
        $totalPersonnesMairie = 0;
        $totalPersonnesSG = 0;
        $totalPersonnesCadreComTech = 0;
        $totalPersonnesSDE = 0;
        $totalPersonnesScteCivil = 0;
        $totalPersonnesFEICOM = 0;
        $totalPersonnesAutresProjProg = 0;
        $totalPersonnesAssocCom = 0;
        $totalPersonnesC2D = 0;
        $SudOuest = null;
        $Sud	 = null;
        $Ouest	 = null;
        $NordOuest = null;
        $Nord	 = null;
        $Littoral	 = null;
        $ExtremeNord	 = null;
        $Est = null;
        $Centre	 = null;
        $Adamaoua	 = null;


        foreach ($regions as $region) {
          if (strtolower($region->name) == 'adamaoua') { $Adamaoua = $region; }
          if (strtolower($region->name) == 'centre') { $Centre = $region; }
          if (strtolower($region->name) == 'est') { $Est = $region; }
          if (strtolower($region->name) == 'sud') { $Sud = $region; }
          if (strtolower($region->name) == 'extrême nord') { $ExtremeNord = $region; }
          if (strtolower($region->name) == 'littoral') { $Littoral = $region; }
          if (strtolower($region->name) == 'nord') { $Nord = $region; }
          if (strtolower($region->name) == 'nord ouest') { $NordOuest = $region; }
          if (strtolower($region->name) == 'ouest') { $Ouest = $region; }
          if (strtolower($region->name) == 'sud ouest') { $SudOuest = $region; }

            $region->commune_touchees = $adminRepo->getCommunesToucherParRegion($region->id, $session->id);
            $region->personnes_inscrite = $adminRepo->getPersonnesInscriteParRegion($region->id, $session->id);
            $region->personnes_formee = $adminRepo->getPersonnesFormeeParRegion($region->id, $session->id);
            $region->personnes_cu = $adminRepo->getPersonnesParStructure($region->id, $session->id, 1);
            $region->personnes_mairie = $adminRepo->getPersonnesParStructure($region->id, $session->id, 2);
            $region->personnes_sg = $adminRepo->getPersonnesParFonction($region->id, $session->id, 1);
            $region->personnes_cct = $adminRepo->getPersonnesParFonction($region->id, $session->id, 2);
            $region->personnes_sde = $adminRepo->getPersonnesParStructure($region->id, $session->id, 3);
            $region->personnes_sde = $adminRepo->getPersonnesParStructure($region->id, $session->id, 3);
            $region->personnes_sc = $adminRepo->getPersonnesParStructure($region->id, $session->id, 4);
            $region->personnes_feicom = $adminRepo->getPersonnesParStructure($region->id, $session->id, 5);
            $region->personnes_autres = $adminRepo->getPersonnesParStructure($region->id, $session->id, 6);
            $region->personnes_asscom = $adminRepo->getPersonnesParStructure($region->id, $session->id, 7);
            $region->personnes_c2d = $adminRepo->getPersonnesParStructure($region->id, $session->id, 8);
            $region->communes = $adminRepo->getCommunesParRegion($region->id);
            $region->couverture = (count($region->commune_touchees) * 100) / $region->communes;
            $region->nontouchees = $region->communes - count($region->commune_touchees);
            $totalCommunesToucher += count($region->commune_touchees);
            $totalCommunesNonToucher += $region->nontouchees;
            $totalPersonnesIncrites += count($region->personnes_inscrite);
            $totalPersonnesFormees += count($region->personnes_formee);
            $totalPersonnesCU += count($region->personnes_cu);
            $totalPersonnesMairie += count($region->personnes_mairie);
            $totalPersonnesSG += count($region->personnes_sg);
            $totalPersonnesCadreComTech += count($region->personnes_cct);
            $totalPersonnesSDE += count($region->personnes_sde);
            $totalPersonnesScteCivil += count($region->personnes_sc);
            $totalPersonnesFEICOM += count($region->personnes_feicom);
            $totalPersonnesAutresProjProg += count($region->personnes_autres);
            $totalPersonnesAssocCom += count($region->personnes_asscom);
            $totalPersonnesC2D += count($region->personnes_c2d);
        }

        $data = [
            'regions' => $regions,
            'evaluations' => $evaluations,
            'setting' => $setting,
            'stat_2015' => $stat_2015,
            'stat_restantes' => $stat_restantes,
            'stat_touchees' => $stat_touchees,
            'stat_plus' => $stat_plus,
            'stat_new' => $stat_new,
            'personnes_diplome' => $personnes_diplome,
            'personnes_age' => $personnes_age,
            'personnes_agesex' => $personnes_agesex,
            'communes' => $communes,
            'allFormations' => $allFormations,
            'formations' => $formations,
            'communesToucher' => $communesToucher,
            'formationExecuter' => $formationExecuter,
            'session' => $session,
            'totalCommunesToucher' => $totalCommunesToucher,
            'totalCommunesNonToucher' => $totalCommunesNonToucher,
            'totalPersonnesIncrites' => $totalPersonnesIncrites,
            'totalPersonnesFormees' => $totalPersonnesFormees,
            'totalPersonnesCU' => $totalPersonnesCU,
            'totalPersonnesMairie' => $totalPersonnesMairie,
            'totalPersonnesSG' => $totalPersonnesSG,
            'totalPersonnesCadreComTech' => $totalPersonnesCadreComTech,
            'totalPersonnesSDE' => $totalPersonnesSDE,
            'totalPersonnesScteCivil' => $totalPersonnesScteCivil,
            'totalPersonnesFEICOM' => $totalPersonnesFEICOM,
            'totalPersonnesAutresProjProg' => $totalPersonnesAutresProjProg,
            'totalPersonnesAssocCom' => $totalPersonnesAssocCom,
            'totalPersonnesC2D' => $totalPersonnesC2D,
            'Adamaoua' => $Adamaoua,
            'Sud' => $Sud,
            'Est' => $Est,
            'NordOuest' => $NordOuest,
            'Nord' => $Nord,
            'Littoral' => $Littoral,
            'Centre' => $Centre,
            'ExtremeNord' => $ExtremeNord,
            'SudOuest' => $SudOuest,
            'Ouest' => $Ouest
        ];

        return $data;
    }


}
