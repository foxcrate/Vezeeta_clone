<?php

use App\models\Blood;
use Illuminate\Database\Seeder;

class bloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodSeeder = [
            ['id'=>1,'name'=>'A+'],
            ['id'=>2,'name'=>'A-'],
            ['id'=>3,'name'=>'B+'],
            ['id'=>4,'name'=>'B-'],
            ['id'=>5,'name'=>'O+'],
            ['id'=>6,'name'=>'O-'],
            ['id'=>7,'name'=>'AB+'],
            ['id'=>8,'name'=>'AB-'],
        ];

        foreach($bloodSeeder as $blood){
            Blood::create($blood);
        }
    }
}
