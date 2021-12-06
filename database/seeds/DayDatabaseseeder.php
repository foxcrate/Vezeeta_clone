<?php

use App\models\Day;
use Illuminate\Database\Seeder;

class DayDatabaseseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysName = [
            ['id' => 1, 'name' => 'Saturday'],
            ['id' => 2, 'name' => 'Sunday'],
            ['id' => 3, 'name' => 'Monday'],
            ['id' => 4, 'name' => 'Tuesday'],
            ['id' => 5, 'name' => 'Wednesday'],
            ['id' => 6, 'name' => 'Thursday'],
            ['id' => 7, 'name' => 'Friday'],
        ];
        foreach($daysName as $day){
            Day::create($day);
        }
    }
}
