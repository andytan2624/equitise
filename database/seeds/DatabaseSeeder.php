<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(SyndicateSeeder::class);
        $this->call(CompanySeeder::class);
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password'),
        ]);
    }
}
