<?php

namespace Database\Seeders;

use App\Models\categories;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            UserSeeder::class,

        ]);



        \App\Models\Author::factory(8)->create();
        \App\Models\Book::factory(25)->create();
    }
}
