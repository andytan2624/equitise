<?php

use App\RoleUser;
use App\SyndicateRoleUser;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class SyndicateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Syndicate::class, 10)->create()->each(function ($u) {
            $faker = Faker::create();
            $role_user_ids = RoleUser::all()->pluck('id')->toArray();
            SyndicateRoleUser::create([
                'syndicate_id' => $u->id,
                'role_user_id' => $faker->randomElement($role_user_ids),
            ]);
        });
    }
}
