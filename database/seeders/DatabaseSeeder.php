<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use App\Models\Role;
use App\Models\User;

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
            CategorySeeder::class,
        ]);

        $this->call([
            RoleSeeder::class,
        ]);

        $this->call([
            AdminSeeder::class,
        ]);

        \App\Models\User::factory(20)->create();
        \App\Models\Item::factory(100)->create();
        \App\Models\Bid::factory(500)->create();

        $roles = Role::all();
        // Populate the pivot table
        User::all()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 1))
            );
        });

        $admin = User::findOrFail(1);
        $admin->roles()->detach();

        $admin->roles()->attach(Role::where('name', 'Admin')->first());
    }
}