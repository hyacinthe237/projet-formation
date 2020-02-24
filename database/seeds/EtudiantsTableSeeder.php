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
            'firstname'       => 'Prenom Stagiaire 1',
            'lastname'        => 'Nom Stagiaire 1',
            'phone'           => '691636304',
            'email'           => 'stagiaire1@email.com',
            'sex'             => 'Male',
            'dob'             => '1991-06-24',
            'structure_id'    => 1,
            'student_category_id'     => 1,
            'fonction_id'     => 1,
            'desc_fonction'   => 'gérer les ressources humaines du FEICOM',
            'form_souhaitee'  => 'Developpement communautaire',
            'diplome_elev'    => 'Licence',
            'form_compl'      => 'Aucune formation complémentaire',
            'an_exp'          => '4 ans'
        ]);

        $fe1 = FormationEtudiant::create([
            'session_id'  => 1,
            'etudiant_id'   => $etudiant_01->id,
            'commune_formation_id'  => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $fe1->phases()->sync([1]);
        $fe1->etats()->sync([1]);

        $etudiant_02 = Etudiant::create([
            'number'          => 1000001,
            'firstname'       => 'Prenom Stagiaire 2',
            'lastname'        => 'Nom Stagiaire 2',
            'phone'           => '693630164',
            'email'           => 'stagiaire2@email.com',
            'sex'             => 'Female',
            'dob'             => '1989-06-24',
            'structure_id'    => 2,
            'fonction_id'     => 2,
            'student_category_id'     => 2,
            'desc_fonction'   => 'chargé des projets',
            'form_souhaitee'  => 'Technique HIMO',
            'diplome_elev'    => 'Licence',
            'form_compl'      => 'Aucune formation complémentaire',
            'an_exp'          => '3 ans'
        ]);

        $fe1 = FormationEtudiant::create([
            'session_id'  => 1,
            'etudiant_id'   => $etudiant_02->id,
            'commune_formation_id'  => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $fe1->phases()->sync([1]);
        $fe1->etats()->sync([1]);


    }
}
