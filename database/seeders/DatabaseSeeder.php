<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()
            // ->has(Product::factory()->count(7))
            ->create([
                'email' => 'admin@gmail.com',
                'password' =>'12341234',
                'name' => 'Super Admin',
            ]);

        User::factory()
            // ->has(Product::factory()->count(9))
            ->create([
                'email' => 'editor@editor.com',
                'password' => '12341234',
                'name' => 'Editor',
            ]);

        $this->call(RoleSeeder::class);
    }
}
