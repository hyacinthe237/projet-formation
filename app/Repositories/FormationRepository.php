<?php

namespace App\Repositories;

use DB;
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

        return $stagiaires;
    }

}
