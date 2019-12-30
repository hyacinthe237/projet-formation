<?php

namespace App\Http\Controllers\views\admin;

use Auth;
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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $adminRepo;

    // model args
    public function __construct(adminRepo $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function dashboard (Request $request)
    {
        $user          = User::whereIsActive(true)->whereId(Auth::id())->first();
        $users         = User::whereIsActive(true)->get();
        $etudiants     = Etudiant::get();
        $communesToucher  = $this->adminRepo->getCommunesToucher();
        $TotalPersonnePrevuFormer  = $this->adminRepo->getTotalPersonnePrevuFormer();
        $FormationExecuter  = $this->adminRepo->getFormationExecuter();
        $formateurs    = Formateur::get();
        $formations    = CommuneFormation::with('formation', 'commune')->get();
        $communes      = Commune::get();
        $departements  = Departement::get();
        $regions       = Region::get();

        if ($request->start_date) {
            $debut = $request->start_date .' '. $request->start_heure.':'.$request->start_minutes;
            $fin = $request->end_date .' '. $request->end_heure.':'.$request->end_minutes;
            $start_date = Carbon::parse($debut)->format('Y-m-d H:i');
            $end_date = Carbon::parse($fin)->format('Y-m-d H:i');

            $communeParPeriode  = $this->adminRepo->getCommunesToucherParPeriode($start_date, $end_date);
        }

        foreach ($regions as $region) {
            $region->commune_touchees = $this->adminRepo->getCommunesToucherParRegion($region->id);
        }

        foreach ($departements as $item) {
            $item->commune_touchees = $this->adminRepo->getCommunesToucherParDepartement($item->id);
        }

        return view('admin.all.dashboard', compact(['users', 'etudiants',  'user', 'FormationExecuter',
        'formateurs', 'formations', 'regions', 'departements', 'communes', 'communesToucher', 'TotalPersonnePrevuFormer']));
    }


}
