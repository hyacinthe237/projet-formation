<?php

use Illuminate\Database\Seeder;
use App\Models\Location;
use Carbon\Carbon;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Location::create([
              'region'      => 'Centre',
              'commune'     => 'Yaoundé 3',
              'departement' => 'Mfoundi',
              'lon'         => 3.831622,
              'lat'         => 11.488940,
              'created_at'  => Carbon::now(),
              'updated_at'  => Carbon::now()
          ]);

          Location::create([
              'region'      => 'Nord',
              'commune'     => 'Garoua 1',
              'departement' => 'Moundam',
              'lon'         => 3.831622,
              'lat'         => 11.488940,
              'created_at'  => Carbon::now(),
              'updated_at'  => Carbon::now()
          ]);
          
    }
}
