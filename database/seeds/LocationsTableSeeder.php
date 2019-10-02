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
      $file = 'public/data/location.csv';

      $this->loadFile($file);

  }

  /**
   * [loadFile description]
   * @param  [type] $filename [description]
   * @param  [type] $city_id  [description]
   * @return [type]           [description]
   */
  private function loadFile($file){
      $column_size = 3;

      $errors = [];

      if (($handle = fopen($file, "r")) !== FALSE) {
          $row_number = 0;
          while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
              if ($row_number == 0) {
                  $row_number ++;
                  continue;
              }

              // field data
              $location = new Location();

              $location->name = $data[0];
              $location->lat = floatval($data[1]);
              $location->lon = floatval($data[2]);

              $location->save();
          }
      }
  }
}
