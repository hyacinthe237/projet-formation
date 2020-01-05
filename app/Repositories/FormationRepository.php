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
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('formation_etudiant_phases as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('cf.formation_id', $formationId)
                        ->whereIn('fep.phase_id', [1, 2])
                        ->get();

        $uniques = array();
            foreach($stagiaires as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }

        return  $uniques;
    }
}
