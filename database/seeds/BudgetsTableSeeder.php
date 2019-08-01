<?php

use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Budget::create([
            'formation_id' => 1,
            'user_id'      => 1,
            'budget_initial' => 7964200
        ]);
    }
}
