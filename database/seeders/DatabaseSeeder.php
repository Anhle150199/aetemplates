<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'anhle@aefreetemplates.xyz',
            'password' => bcrypt('Super@dmin.1999'),
            'user_role' => 'superAdmin'
        ]);

    }
}
