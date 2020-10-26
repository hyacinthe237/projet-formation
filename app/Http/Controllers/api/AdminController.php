<?php

namespace App\Http\Controllers\api;

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

    public function index (Request $request)
    {
        $session = Session::whereStatus('pending')->first();
        $data    = self::takeInfos($this->adminRepo, $this->formRepo, $session);

        return response()->json($data);
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
        $regions       = Region::where('id', '<>', 11)->get();
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
            $totalCommunesToucher += count($region->commune_touchees);
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
            'communes' => $communes,
            'formations' => $formations,
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
