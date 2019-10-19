<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DepartementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $departements = [
           ["name" => "Djérem", "region_id" => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Faro-et-Déo", "region_id" => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Banyo", "region_id" => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mbéré", "region_id" => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Vina", "region_id" => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Haute-Sanaga", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Lekié", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mbam-et-Inoubou", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mbam-et-Kim", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Méfou-et-Afamba", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Méfou-et-Akono", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mfoundi", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nyong-et-Kellé", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nyong-et-Mfoumou", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nyong-et-So’o", "region_id" => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Boumba-et-Ngoko", "region_id" => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Haut-Nyong", "region_id" => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Kadey", "region_id" => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Lom-et-Djérem", "region_id" => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Diamaré", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Logone-et-Chari", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Danay", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Kani", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Sava", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Tsanaga", "region_id" => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Moungo", "region_id" => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Nkam", "region_id" => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Sanaga-Maritime", "region_id" => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Wouri", "region_id" => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Bénoué", "region_id" => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Faro", "region_id" => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Louti", "region_id" => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mayo-Rey", "region_id" => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Boyo", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Bui", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Donga-Mantung", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Menchum", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mezam", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Momo", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Ngo-Ketunjia", "region_id" => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Bamboutos", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Haut-Nkam", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Hauts-Plateaux", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Koung-Khi", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Menoua", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mifi", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Ndé", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Noun", "region_id" => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Dja-et-Lobo", "region_id" => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Mvila", "region_id" => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Océan", "region_id" => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Vallée-du-Ntem", "region_id" => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Fako", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Koupé-Manengouba", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Lebialem", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Manyu", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Meme", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ["name" => "Ndian", "region_id" => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
       ];

        DB::table('departements')->insert($departements);
    }
}
