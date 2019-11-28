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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard (Request $request)
    {
        $user          = User::whereIsActive(true)->whereId(Auth::id())->first();
        $users         = User::whereIsActive(true)->get();
        $etudiants     = Etudiant::get();
        $formateurs    = Formateur::get();
        $formations    = CommuneFormation::with('formation', 'commune')->get();
        $communes      = Commune::get();
        $departements  = Departement::get();
        $regions       = Region::get();
        $thematiques   = Thematique::get();

        $search = Formation::with('sites', 'sites.formation', 'sites.commune', 'sites.commune.departement', 'sites.commune.departement', 'phases', 'phases.thematiques')
                      ->when($request->commune_id, function ($q) use ($request) {
                          return $q->whereHas('sites', function($sql) use ($request) {
                              return $sql->where('commune_id', $request->commune_id);
                          });
                      })
                      ->when($request->departement_id, function ($q) use ($request) {
                          return $q->whereHas('sites.commune', function($sql) use ($request) {
                              return $sql->where('departement_id', $request->departement_id);
                          });
                      })
                      ->when($request->region_id, function ($q) use ($request) {
                          return $q->whereHas('sites.commune.departement', function($sql) use ($request) {
                              return $sql->where('region_id', $request->region_id);
                          });
                      })
                      ->when($request->thematique_id, function ($q) use ($request) {
                          return $q->whereHas('phases.thematiques', function($sql) use ($request) {
                              return $sql->where('id', $request->thematique_id);
                          });
                      })
                      ->get();

        return view('admin.all.dashboard', compact('users', 'etudiants', 'search',  'user', 'formateurs', 'formations', 'regions', 'departements', 'communes', 'thematiques'));
    }


}
