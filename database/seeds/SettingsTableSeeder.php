<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Session;

class SettingsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
      Session::create(['name' => '2019', 'status' => 'pending' ]);

      $structures = [
           ["name" => "Personnels Communauté Urbaine", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels Mairie", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels SDE", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels Société Civil", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels FEICOM", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels Autres projets/programmes", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels Association des Communes", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels C2D", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('structures')->insert($structures);

      $financeurs = [
           ["name" => "FEICOM", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "PNMFV", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('financeurs')->insert($financeurs);

      $fonctions = [
           ["name" => "Sécrétaire Général", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Cadre communal Technique", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('fonctions')->insert($fonctions);

      $categories = [
           ["name" => "Propre", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Partenariale", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Commande", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('categories')->insert($categories);
  }
}
