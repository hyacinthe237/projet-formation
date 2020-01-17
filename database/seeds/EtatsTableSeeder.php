<?php

use Illuminate\Database\Seeder;
use App\Models\Etat;


class EtatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etat::create([ 'name' => 'inscris' ]);
        Etat::create([ 'name' => 'formee' ]);
    }
}
