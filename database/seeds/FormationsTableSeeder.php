<?php

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\CommuneFormation;
use Carbon\Carbon;


class FormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form_01 = Formation::create([
            'number'      => 1000000,
            'title'       => 'Résilience des collectivités locales aux effets des changements climatiques et développement local',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        CommuneFormation::create([
            'formation_id' => $form_01->id,
            'commune_id'  => 1,
            'start_date'  => '2019-07-15 08:00',
            'end_date'    => '2019-07-19 08:00',
            'duree'       => '5 jours',
            'qte_requis'  => 10,
            'type'        => 'Effective'
        ]);

        $form_01->phases()->attach([1,2]);

        $form_02 = Formation::create([
            'number'      => 1000001,
            'title'       => 'Développement des projets ecojobs',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        CommuneFormation::create([
            'formation_id' => $form_02->id,
            'commune_id'  => 111,
            'start_date'  => '2019-07-15 08:00',
            'end_date'    => '2019-07-19 08:00',
            'duree'       => '5 jours',
            'qte_requis'  => 9,
            'type'        => 'Effective'
        ]);

        $form_02->phases()->attach([1,2]);

        $form_03 = Formation::create([
            'number'      => 1000003,
            'title'       => 'Développement Web',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        CommuneFormation::create([
            'formation_id' => $form_03->id,
            'commune_id'  => 99,
            'start_date'  => '2019-07-15 08:00',
            'end_date'    => '2019-07-19 08:00',
            'duree'       => '5 jours',
            'qte_requis'  => 9,
            'type'        => 'Effective'
        ]);

        $form_02->phases()->attach([1,2]);

    }
}
