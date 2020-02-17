<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id'        => 1,
            'number'         => 1000000,
            'firstname'      => 'Marcel',
            'lastname'       => 'Admin',
            'phone'          => '694694694',
            'email'          => 'admin@email.com',
            'password'       => bcrypt('pass'),
            'sex'            => 'Male',
            'is_active'      => 1,
            'api_token' => str_random(100)
        ]);

        User::create([
            'role_id'        => 2,
            'number'         => 1000001,
            'firstname'      => 'Josiane',
            'lastname'       => 'Editor',
            'phone'          => '694694694',
            'email'          => 'editor@email.com',
            'password'       => bcrypt('pass'),
            'sex'            => 'Female',
            'is_active'      => 1,
            'api_token' => str_random(100)
        ]);

        // User::create([
        //     'role_id'        => 3,
        //     'number'         => 1000003,
        //     'firstname'      => 'Hyacinthe',
        //     'lastname'       => 'Member',
        //     'phone'          => '694694694',
        //     'email'          => 'member@email.com',
        //     'password'       => bcrypt('pass'),
        //     'sex'            => 'Male',
        //     'is_active'      => 1,
        //     'api_token' => str_random(100)
        // ]);


        // factory(App\Models\User::class, 30)->create();
    }
}
