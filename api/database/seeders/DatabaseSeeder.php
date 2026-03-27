<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(NRSRPartySeeder::class);
        $this->call(CouncilSeeder::class);
        $this->call(CantonSeeder::class);
        $this->call(ShieldSeeder::class);
        $this->call(TopicSeeder::class);
    }
}
