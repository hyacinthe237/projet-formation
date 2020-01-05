<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\FormationEtudiant;
use App\Models\CommuneFormation;

class AdminRepository
{
    public function getCommunesToucherParRegion ($regionId, $sessionId) {

        $communes = DB::table('commune_formations as cf')
                        ->join('communes as c', 'cf.commune_id', '=', 'c.id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->where('d.region_id', $regionId)
                        ->where('cf.session_id', $sessionId)
                        ->get();

        return $communes;
    }

    public function getCommunesParFormation ($formationId, $sessionId) {
        $communes = DB::table('communes as c')
                    ->join('commune_formations as cf', 'cf.commune_id', '=', 'c.id')
                    ->where('cf.formation_id', '=', $formationId)
                    ->where('cf.session_id', '=', $sessionId)
                    ->get();

        return $communes;
    }

    public function getCommunesToucherParDepartement ($departementId, $sessionId) {

        $communes = DB::table('commune_formations as cf')
                        ->join('communes as c', 'cf.commune_id', '=', 'c.id')
                        ->where('c.departement_id', $departementId)
                        ->where('cf.session_id', $sessionId)
                        ->get();

        return $communes;
    }

    public function getStagiairesFormer () {

        $stagiaires = DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->where('cf.formation_id', '=', 'fe.formation_id')
                        ->get();

        $uniques = array();
            foreach($stagiaires as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }

        return  $uniques;
    }

    public function getPersonnesInscriteParRegion ($regionId, $sessionId) {

        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fe.etat', '=', 'inscris')
                        ->get();

        return $personnes;
    }

    public function getPersonnesFormeeParRegion ($regionId, $sessionId) {

        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fe.etat', '=', 'formee')
                        ->get();

        return $personnes;
    }

    public function getPersonnesInscriteParDepartement ($departementId, $sessionId) {

        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->where('c.departement_id', '=', $departementId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fe.etat', '=', 'inscris')
                        ->get();

        return $personnes;
    }

    public function getPersonnesFormeeParDepartement ($departementId, $sessionId) {

        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->where('c.departement_id', '=', $departementId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fe.etat', '=', 'formee')
                        ->get();

        return $personnes;
    }

    public function getCommunesToucher ($sessionId) {

        $resultat = 0;

        $commune_formations = CommuneFormation::whereSessionId($sessionId)->get();

        if (count($commune_formations))
           $resultat = (count($commune_formations)/360) * 100;

        return  number_format($resultat, 2);
    }

    public function getTotalPersonnePrevuFormer ($sessionId) {
        $nbr_prevu_former = 0;
        $nbr_former = count(FormationEtudiant::whereSessionId($sessionId)->get());
        $commune_formations = CommuneFormation::whereSessionId($sessionId)->get();

        if ($commune_formations) {
            foreach ($commune_formations as $item) {
              $nbr_prevu_former += $item->qte_requis;
            }
        }

        if ($nbr_prevu_former == 0) return 0;

        return number_format(($nbr_former/$nbr_prevu_former) * 100, 2);
    }

    public function getFormationExecuter ($sessionId) {
        $today = Carbon::parse(Carbon::now())->format('Y-m-d H:i');
        $formation_exec = CommuneFormation::where('end_date', '<=', $today)->count();
        $formation_prevu = CommuneFormation::whereSessionId($sessionId)->count();
        
        if ($formation_prevu == 0) {
          return 0;
        }

        return number_format(($formation_exec/$formation_prevu) * 100, 2);

    }

    public function getCommunesToucherParPeriode ($debut, $fin) {
        $com_form = CommuneFormation::with('commune')
            ->when($debut, function($query) use ($debut) {
                return $query->where('start_date', '>=', $debut);
            })
            ->when($fin, function($query) use ($fin) {
                return $query->where('end_date', '<=', $fin);
            })->get();

        return $com_form;

    }


}
