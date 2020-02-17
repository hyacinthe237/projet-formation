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
        $allFormations = Formation::whereSessionId($session->id)->whereIsActive(true)->get();
        $communes      = Commune::get();
        $departements  = Departement::get();
        $regions       = Region::get();
        $communesToucher  = $adminRepo->getCommunesToucher($session->id);
        $totalPersonnePrevuFormer  = $adminRepo->getTotalPersonnePrevuFormer($session->id);
        $formationExecuter  = $adminRepo->getFormationExecuter($session->id);
        $etudiants     = $adminRepo->getStagiaires($session->id);
        $formateurs    = Formateur::get();
        $formations    = CommuneFormation::whereSessionId($session->id)->with('formation', 'commune')->get();
        $totalCommunesToucher = 0;
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

        foreach ($regions as $region) {
            $region->commune_touchees = $adminRepo->getCommunesToucherParRegion($region->id, $session->id);
            $region->personnes_inscrite = $adminRepo->getPersonnesInscriteParRegion($region->id, $session->id);
            $region->personnes_formee = $adminRepo->getPersonnesFormeeParRegion($region->id, $session->id);
            $totalCommunesToucher += count($region->commune_touchees);
            $totalPersonnesIncrites += count($region->personnes_inscrite);
            $totalPersonnesFormees += count($region->personnes_formee);
        }

        $data = [
            'regions' => $regions,
            'communes' => $communes,
            'communesToucher' => $communesToucher,
            'formationExecuter' => $formationExecuter,
            'session' => $session,
            'totalCommunesToucher' => $totalCommunesToucher,
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
        ];

        return $data;
    }


}
