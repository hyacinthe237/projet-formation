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
        $thematiques   = Thematique::get();

        $search = Formation::with(['sites', 'sites.formation', 'sites.commune', 'sites.commune.departement', 'sites.commune.departement', 'phases', 'phases.thematiques'])
                      ->get();

          foreach ($regions as $item) {
            $item->formations = $this->adminRepo->getFormation($item->id);
          }

        return view('admin.all.dashboard', compact(['users', 'etudiants', 'search',  'user', 'FormationExecuter',
        'formateurs', 'formations', 'regions', 'departements', 'communes', 'thematiques', 'communesToucher', 'TotalPersonnePrevuFormer']));
    }


}
