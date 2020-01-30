<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\FormationEtudiant;
use App\Models\CommuneFormation;

class FormationRepository
{
    public function getStagiaireFormation ($formationId) {

        $stagiaires = DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->where('cf.formation_id', $formationId)
                        ->get();

        $uniques = array();
            foreach($stagiaires as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }

        return  $uniques;
    }

    public function getStagiaireFormees ($formationId) {

        $stagiaires = DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->where('cf.formation_id', $formationId)
                        ->where('fep.etat_id', '=', 2)
                        ->get();

        $uniques = array();
            foreach($stagiaires as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }
        // dd($uniques);
        return  $uniques;
    }
}
