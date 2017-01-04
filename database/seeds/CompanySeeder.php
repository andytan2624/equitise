<?php

use App\CompanyRoleUser;
use App\RoleUser;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Company::class, 10)->create()->each(function ($u) {
            $faker = Faker::create();
            $role_user_ids = RoleUser::all()->pluck('id')->toArray();
            CompanyRoleUser::create([
               'company_id' => $u->id,
                'role_user_id' => $faker->randomElement($role_user_ids),
            ]);
        });
    }
}
