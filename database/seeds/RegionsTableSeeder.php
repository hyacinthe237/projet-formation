<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $regions = [
           ["name" => "Adamaoua", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Centre", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Est", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Extrême Nord", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Littoral", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nord", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nord Ouest", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Ouest", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Sud", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Sud Ouest", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

        DB::table('regions')->insert($regions);
    }
}
