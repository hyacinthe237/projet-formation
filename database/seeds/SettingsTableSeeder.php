<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
      $structures = [
           ["name" => "FEICOM", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Personnels Société Civil", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('structures')->insert($structures);

      $financeurs = [
           ["name" => "FEICOM", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "PNMFV", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

      DB::table('financeurs')->insert($financeurs);

      $fonctions = [
           ["name" => "DRH", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Service Technique", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
