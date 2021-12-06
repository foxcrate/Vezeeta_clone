<?php

use App\models\Finder;
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
            DatabaseTestSeeder::class,
            DatabaseRaySeeder::class,
            SpecailtyDoctorDatabase::class,
            FinderSeederDatabase::class,
            DayDatabaseseeder::class,
            bloodSeeder::class,
            BannerSeeder::class,
            // medicationSeeder::class,
            ]);

    }
}
