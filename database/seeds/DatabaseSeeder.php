<?php

use Database\Seeders\RolesSeeder;
use Database\Seeders\RoleUserSeeder;
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
        $this->call([
            UsersQuestionsAnswersTableSeeder::class,
	        RolesSeeder::class,
            RoleUserSeeder::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);    
    }
}
