<?php

use Illuminate\Database\Seeder;
use App\Models\Formation;
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
            'number'      => 100000,
            'title'       => 'Résilience des collectivités locales aux effets des changements climatiques et développement local',
            'site'        => 'Garoua',
            'start_date'  => '2019-07-15 08:00',
            'end_date'    => '2019-07-19 08:00',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'qte_requis'  => 30,
            'duree'       => '5 jours',
            'type'        => 'Effective'
        ]);

        $form_02 = Formation::create([
            'number'      => 100001,
            'title'       => 'Développement des projets ecojobs',
            'site'        => 'Yaoundé',
            'start_date'  => '2019-06-15 08:00',
            'end_date'    => '2019-06-19 08:00',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'qte_requis'  => 35,
            'duree'       => '5 jours',
            'type'        => 'Besoin'
        ]);


    }
}
