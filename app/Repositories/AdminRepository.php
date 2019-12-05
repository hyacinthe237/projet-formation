<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Etudiant;
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
}
