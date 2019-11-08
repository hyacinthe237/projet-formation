<?php

use Illuminate\Database\Seeder;
use App\Models\Phase;


class PhasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phase_01 = Phase::create([ 'title' => 'Formation' ]);

        $phase_01->thematiques()->createMany([
          [ 'name' => 'Conception des cartes de visite', 'duree' => '10 jours'],
          [ 'name' => 'Entrepreneuriat', 'duree' => '10 jours'],
          [ 'name' => 'Management', 'duree' => '10 jours']
        ]);

        $phase_02 = Phase::create([ 'title' => 'Suivi et Evaluation' ]);

        $phase_02->thematiques()->createMany([
          [ 'name' => 'Conception des sites web', 'duree' => '10 jours'],
          [ 'name' => 'Confiance en soi', 'duree' => '5 jours'],
          [ 'name' => 'Comprendre les iOS', 'duree' => '30 jours']
        ]);

    }
}
