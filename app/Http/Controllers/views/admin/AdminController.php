<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\CommuneFormation;
use App\Models\Formateur;
use App\Models\Region;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Thematique;
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
        $user          = User::whereIsActive(true)->whereId(Auth::id())->first();
        $users         = User::whereIsActive(true)->get();
        $data     = self::takeInfos($this->adminRepo, $this->formRepo);


        if ($request->start_date) {
            $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
            $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
            $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
            $end_date = Carbon::parse($fin)->format('Y-m-d H:i');

            $communeParPeriode  = $this->adminRepo->getCommunesToucherParPeriode($start_date, $end_date);
        }

        return view('admin.all.dashboard', compact(['data', 'users',  'user']));
    }

    /**
     * Download PDF Formation
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    public function download (adminRepo $adminRepo, formRepo $formRepo)
    {
        $data = self::takeInfos($adminRepo, $formRepo);

        $pdf = PDF::loadView('pdfs.dashboard', $data);
        return $pdf->stream();
    }

    /**
     * Recup Formation Information
     * @param  [type] $id [description]
     * @return [type]         [description]
     */
    private static function takeInfos ($adminRepo, $formRepo)
    {
        $allFormations = Formation::whereIsActive(true)->get();
        $communes      = Commune::get();
        $departements  = Departement::get();
        $regions       = Region::get();
        $communesToucher  = $adminRepo->getCommunesToucher();
        $totalPersonnePrevuFormer  = $adminRepo->getTotalPersonnePrevuFormer();
        $formationExecuter  = $adminRepo->getFormationExecuter();
        $etudiants     = Etudiant::get();
        $formateurs    = Formateur::get();
        $formations    = CommuneFormation::with('formation', 'commune')->get();

        foreach ($regions as $region) {
            $region->commune_touchees = $adminRepo->getCommunesToucherParRegion($region->id);
            $region->personnes_inscrite = $adminRepo->getPersonnesInscriteParRegion($region->id);
            $region->personnes_formee = $adminRepo->getPersonnesFormeeParRegion($region->id);
        }

        foreach ($departements as $item) {
            $item->commune_touchees = $adminRepo->getCommunesToucherParDepartement($item->id);
            $item->personnes_inscrite = $adminRepo->getPersonnesInscriteParDepartement($item->id);
            $item->personnes_formee = $adminRepo->getPersonnesFormeeParDepartement($item->id);
        }

        foreach ($allFormations as $item) {
            $item->communes = $adminRepo->getCommunesParFormation($item->id);
            $item->personnes_formee = $formRepo->getStagiaireFormees($item->id);
        }

        $data = [
            'regions' => $regions,
            'departements' => $departements,
            'communes' => $communes,
            'communesToucher' => $communesToucher,
            'totalPersonnePrevuFormer' => $totalPersonnePrevuFormer,
            'formationExecuter' => $formationExecuter,
            'etudiants' => $etudiants,
            'formateurs' => $formateurs,
            'formations' => $formations,
            'allFormations' => $allFormations,
        ];

        return $data;
    }


}
