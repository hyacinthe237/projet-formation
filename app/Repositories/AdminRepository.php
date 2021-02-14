<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Departement;
use App\Models\Formation;
use App\Models\FormationEtudiant;
use App\Models\CommuneFormation;
use App\Models\Commune;

class AdminRepository
{
    public function getEvaluations ($sessionId) {
      $formations = CommuneFormation::with('evaluations')
                      ->whereSessionId($sessionId)
                      ->get();

      return $formations;
    }

    public function getPersonnesParDiplome () {
      $etudiants = Etudiant::whereIsActive(true)->count();
      $personnes = DB::table('etudiants')
                      ->select('diplome_elev', DB::raw('count(*) as total'))
                      ->whereIsActive(true)
                      ->whereDeletedAt(null)
                      ->groupBy('diplome_elev')
                      ->get();

      foreach ($personnes as $value) {
        $value->pourcentage = number_format(($value->total/$etudiants) * 100, 2);
      }

      return $personnes;
    }

    public function getPersonnesParAge () {
      $etudiants = Etudiant::whereIsActive(true)->count();
      $personnes = DB::table('etudiants')
                      ->select('dob', DB::raw('count(*) as total'))
                      ->whereIsActive(true)
                      ->whereDeletedAt(null)
                      ->groupBy('dob')
                      ->get();


      if ($etudiants>0) {
        foreach ($personnes as $value) {
          $value->pourcentage = number_format(($value->total/$etudiants) * 100, 2);
          $value->age = Carbon::parse($value->dob)->diff(Carbon::now())->format('%y');
        }
      }

      $pers_20_30 = [];
      $pers_31_40= [];
      $pers_41_50 = [];
      $pers_51_60 = [];
      $index = 0;
      foreach ($personnes as $item) {
        if (($item->age >= 20) && ($item->age <= 30)) {
          $pers_20_30[$index] = $item;
        }

        if (($item->age >= 31) && ($item->age <= 40)) {
          $pers_31_40[$index] = $item;
        }

        if (($item->age >= 41) && ($item->age <= 50)) {
          $pers_41_50[$index] = $item;
        }

        if (($item->age >= 51) && ($item->age <= 60)) {
          $pers_51_60[$index] = $item;
        }

        $index++;
      }

      return [
        'pers_20_30' => $pers_20_30,
        'pers_31_40' => $pers_31_40,
        'pers_41_50' => $pers_41_50,
        'pers_51_60' => $pers_51_60,
        'personnes' => count($personnes),
      ];
    }

    public function getPersonnesParGenreEtAge () {
      $etudiants = Etudiant::whereIsActive(true)->count();
      $personnes = DB::table('etudiants')
                      ->select(['sex', 'dob'], DB::raw('count(sex, dob) as total'))
                      ->whereIsActive(true)
                      ->whereDeletedAt(null)
                      ->groupBy(['sex', 'dob'])
                      ->get();


      foreach ($personnes as $value) {
        // $value->pourcentage = number_format(($value->total/$etudiants) * 100, 2);
        $value->age = Carbon::parse($value->dob)->diff(Carbon::now())->format('%y');

      }

      $pers_20_30_female = [];
      $pers_20_30_male = [];
      $pers_31_40_female = [];
      $pers_31_40_male = [];
      $pers_41_50_female = [];
      $pers_41_50_male = [];
      $pers_51_60_female = [];
      $pers_51_60_male = [];
      $index = 0;
      foreach ($personnes as $item) {
        if (($item->age >= 20) && ($item->age <= 30)) {
          if ($item->sex == 'female') {
            $pers_20_30_female[$index] = $item;
          } else {
            $pers_20_30_male[$index] = $item;
          }
        }

        if (($item->age >= 31) && ($item->age <= 40)) {
          if ($item->sex == 'female') {
            $pers_31_40_female[$index] = $item;
          } else {
            $pers_31_40_male[$index] = $item;
          }
        }

        if (($item->age >= 41) && ($item->age <= 50)) {
          if ($item->sex == 'female') {
            $pers_41_50_female[$index] = $item;
          } else {
            $pers_41_50_male[$index] = $item;
          }
        }

        if (($item->age >= 51) && ($item->age <= 60)) {
          if ($item->sex == 'female') {
            $pers_51_60_female[$index] = $item;
          } else {
            $pers_51_60_male[$index] = $item;
          }
        }

        $index++;
      }

      return [
        'pers_20_30_female' => $pers_20_30_female,
        'pers_20_30_male' => $pers_20_30_male,
        'pers_31_40_female' => $pers_31_40_female,
        'pers_31_40_male' => $pers_31_40_male,
        'pers_41_50_female' => $pers_41_50_female,
        'pers_41_50_male' => $pers_41_50_male,
        'pers_51_60_female' => $pers_51_60_female,
        'pers_51_60_male' => $pers_51_60_male,
        'personnes' => count($personnes),
      ];
    }

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

    public function getCommunesParRegion ($regionId) {
        $departements = Departement::whereRegionId($regionId)->with('communes')->get();
        $communes = 0;
        foreach ($departements as $item) {
          $communes +=  count($item->communes);
        }

        return $communes;
    }

    public function getStagiaires ($sessionId) {
        $personnes = DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->where('fe.session_id', '=', $sessionId)
                        ->where('e.deleted_at', '=', null)
                        ->get();

        $uniques = array();
            foreach($personnes as $personne) {
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
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fep.etat_id', '=', 1)
                        ->get();

        return  $personnes;
    }

    public function getPersonnesFormeeParRegion ($regionId, $sessionId) {
        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fep.etat_id', '=', 2)
                        ->get();

        return  $personnes;
    }

    public function getPersonnesParStructure ($regionId, $sessionId, $structureId) {
        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('e.structure_id', '=', $structureId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->get();

        $uniques = array();
            foreach($personnes as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }

        return  $uniques;
    }

    public function getPersonnesParFonction ($regionId, $sessionId, $fonctionId) {
        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('departements as d', 'd.id', '=', 'c.departement_id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('d.region_id', '=', $regionId)
                        ->where('e.fonction_id', '=', $fonctionId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->get();

        $uniques = array();
            foreach($personnes as $personne) {
                $key = $personne->number;
                $uniques[$key] = $personne;
            }

        return  $uniques;
    }

    public function getPersonnesInscriteParDepartement ($departementId, $sessionId) {
        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('c.departement_id', '=', $departementId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fep.etat_id', '=', 1)
                        ->get();

        return  $personnes;
    }

    public function getPersonnesFormeeParDepartement ($departementId, $sessionId) {
        $personnes =  DB::table('etudiants as e')
                        ->join('formation_etudiants as fe', 'fe.etudiant_id', '=', 'e.id')
                        ->join('commune_formations as cf', 'cf.id', '=', 'fe.commune_formation_id')
                        ->join('communes as c', 'c.id', '=', 'cf.commune_id')
                        ->join('formation_etudiant_etats as fep', 'fe.id', '=', 'fep.formation_etudiant_id')
                        ->where('c.departement_id', '=', $departementId)
                        ->where('cf.session_id', '=', $sessionId)
                        ->where('fep.etat_id', '=', 2)
                        ->get();

        return  $personnes;
    }

    public function getCommunesToucher ($sessionId) {
        $resultat = 0;
        $commune_formations = CommuneFormation::whereSessionId($sessionId)->count();
        $communes = Commune::count();

        if ($communes > 0)
           $resultat = ($commune_formations/$communes) * 100;

        $resultat = $resultat >= 100 ? 100 : $resultat;
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

        if ($formation_prevu == 0) return 0;

        return number_format(($formation_exec/$formation_prevu) * 100, 2);
    }

    public function getCTD2015 () {
        $an_2015 = Carbon::parse('2015-12-31 00:00')->format('Y-m-d H:i');
        $communes = Commune::count();
        $formations = CommuneFormation::count();
        $total = $communes + $formations;

        if ($total == 0) return 0;

        return number_format(($formations/$total) * 100, 2);
    }

    public function getCTDRestantes ($sessionId) {
        $communes = Commune::count();
        $formations = CommuneFormation::whereSessionId($sessionId)->count();
        $plus = $this->getCTDPlusUneFois($sessionId);
        $touchees = $this->getCTDTouchees($sessionId);
        $nouvelles = $this->getCTDNouvelles($sessionId);
        $total = $communes + $formations;
        $reste = $communes - $formations;
        $per_reste = number_format(($reste/$total) * 100, 2);
        $result = $per_reste - $plus - $touchees - $nouvelles;
        $result = $result < 0 ? 0 : $result;

        return $result;
    }

    public function getCTDTouchees ($sessionId) {
        $communes = Commune::count();
        $formations = CommuneFormation::whereSessionId($sessionId)->count();
        $total = $communes + $formations;

        return number_format(($formations/$total) * 100, 2);
    }

    public function getCTDNouvelles ($sessionId) {
        $communes = Commune::get();

        //communes depuis 2015
        $formations_2015 = CommuneFormation::get();

        //communes de la session en cours
        $formation_touchees = CommuneFormation::whereSessionId($sessionId)->get();

        //total de toutes les communes
        $total = count($communes) + count($formations_2015);

        //communes a comparer
        $communes_comparer = [];
        $index = 0;
        foreach ($formations_2015 as $item) {
          $check = $formation_touchees->where('id', $item->id)->first();
          if ($check) {
            unset($formations_2015[$index]);
          }
          $index++;
        }

        $iterator = 0;
        foreach ($formations_2015 as $item) {
          $check = $formation_touchees->where('commune_id', '<>', $item->commune_id)->first();
          if ($check) {
            $communes_comparer[$iterator] = $check;
          }
          $iterator++;
        }

        return number_format((count($communes_comparer)/$total) * 100, 2);
    }

    public function getCTDPlusUneFois ($sessionId) {
        $counter = 0;
        $communes = Commune::with('formations')->get();
        foreach ($communes as $commune) {
          if (count($commune->formations) >= 1) {
            $counter += 1;
          }
        }

        $formations = CommuneFormation::whereSessionId($sessionId)->count();
        $total = count($communes) + $formations;

        return number_format(($counter/$total) * 100, 2);
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
