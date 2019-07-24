<?php

use Illuminate\Database\Seeder;
use App\Models\Thematique;


class ThematiquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thema_01 = Thematique::create([
            'name'   => 'Conception des cartes de visite',
            'duree'  => '10 jours',
        ]);

        $thema_01->formations()->create([
            'number'       => 1000000,
            'title'        => '10 jours',
            'location'     => 'Conception des cartes de visite',
            'start_date'   => '10 jours',
            'end_date'     => 'Conception des cartes de visite',
            'description'  => '10 jours',
            'qte_requis'   => 'Conception des cartes de visite',
            'duree'        => '10 jours',
            'is_active'    => 'Conception des cartes de visite',
            'type'         => '10 jours',
        ]);

        $thema_02 = Thematique::create([
            'name'   => 'Utilisation des logiciels Ms Office',
            'duree'  => '06 mois',
        ]);

        $thema_03 = Thematique::create([
            'name'   => 'Archivage',
            'duree'  => '01 an',
        ]);

    }
}
