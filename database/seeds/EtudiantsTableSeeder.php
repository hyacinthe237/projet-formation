<?php

use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\FormationEtudiant;
use Carbon\Carbon;

class EtudiantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etudiant_01 = Etudiant::create([
            'number'          => 1000000,
            'firstname'       => 'Jean Jacques',
            'lastname'        => 'ABEGA',
            'phone'           => '691636304',
            'email'           => 'jean.jacques@email.com',
            'sex'             => 'Male',
            'dob'             => '1991-06-24',
            'structure'       => 'Izy Tech Group Sarl',
            'fonction'        => 'Développeur Web Junior',
            'desc_fonction'   => 'Ma tâche consiste à produire des applications web, mobiles et des sites internet',
            'form_souhaitee'  => 'Intelligence Artificielle',
            'diplome_elev'    => 'Diplôme d\'Ingénieur des Travaux Informatiques Option Génie Logicielle',
            'form_compl'      => 'Aucune formation complémentaire',
            'an_exp'          => '4 ans'
        ]);

        $fe1 = FormationEtudiant::create([
            'etudiant_id'   => $etudiant_01->id,
            'commune_formation_id'  => 1,
            'etat'          => 'inscris',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $fe1->phases()->sync([1]);

        $etudiant_02 = Etudiant::create([
            'number'          => 1000001,
            'firstname'       => 'Marceline',
            'lastname'        => 'MINFOUMOU',
            'phone'           => '691604363',
            'email'           => 'marceline@email.com',
            'sex'             => 'Female',
            'dob'             => '1989-06-24',
            'structure'       => 'Commune de Yaoundé 3',
            'fonction'        => 'Chef du personnel',
            'desc_fonction'   => 'Technique de recrutement du personnel',
            'form_souhaitee'  => 'Management d\'équipe',
            'diplome_elev'    => 'Diplôme en DRH',
            'form_compl'      => 'Aucune formation complémentaire',
            'an_exp'          => '6 ans'
        ]);

        $fe2 = FormationEtudiant::create([
            'etudiant_id'  => $etudiant_02->id,
            'commune_formation_id'  => 1,
            'etat'          => 'inscris',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $fe2->phases()->sync([1,2]);
    }
}
