<?php

use Evention\Database\Seeds\Seeder;
use Evention\Database\Seeds\SampleDataSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultUser()
            ->call(SampleDataSeeder::class);
    }
}
