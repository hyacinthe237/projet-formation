<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PhasesTableSeeder::class);
        $this->call(FormationsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(EtudiantsTableSeeder::class);
        $this->call(BudgetsTableSeeder::class);
        $this->call(BudgetItemsTableSeeder::class);
    }
}
