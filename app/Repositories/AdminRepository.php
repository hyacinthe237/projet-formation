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
    public function getFormation ($regionId) {

        $formations = DB::table('commune_formations as cf')
                        ->join('communes as c', 'cf.commune_id', '=', 'c.id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->where('d.region_id', $regionId)
                        ->get();

        return $formations;
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

    public function getCommunesToucher () {

        $resultat = 0;

        $commune_formations = CommuneFormation::get();

        if (count($commune_formations))
           $resultat = (count($commune_formations)/360) * 100;

        return  $resultat;
    }

    public function getTotalPersonnePrevuFormer () {
        $nbr_prevu_former = 0;
        $nbr_former = count(FormationEtudiant::get());
        $commune_formations = CommuneFormation::get();

        if ($commune_formations) {
            foreach ($commune_formations as $item) {
              $nbr_prevu_former += $item->qte_requis;
            }
        }

        return ($nbr_former/$nbr_prevu_former) * 100;
    }

    public function getFormationExecuter () {
        $formation_exec = CommuneFormation::whereType('Effective')->count();
        $formation_prevu = CommuneFormation::count();

        if ($formation_prevu == 0) {
          return 0;
        }

        return ($formation_exec/$formation_prevu) * 100;

    }


}