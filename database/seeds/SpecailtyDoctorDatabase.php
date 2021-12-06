<?php

use App\models\DoctorSpecailty;
use Illuminate\Database\Seeder;

class SpecailtyDoctorDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctorSpecailty = [
            ['id' => 1, 'name' => 'General'],
            ['id' => 2, 'name' => 'Audiologist'],
            ['id' => 3, 'name' => 'Anesthesiologist'],
            ['id' => 4, 'name' => 'Andrologists'],
            ['id' => 5, 'name' => 'Cardiologist'],
            ['id' => 6, 'name' => 'Cardiovascular'],
            ['id' => 7, 'name' => 'Cardiovascular Surgery'],
            ['id' => 8, 'name' => 'Neurologist'],
            ['id' => 9, 'name' => 'Dentist'],
            ['id' => 10, 'name' => 'Dermatologist'],
            ['id' => 11, 'name' => 'Emergency Doctors'],
            ['id' => 12, 'name' => 'Endocrinologist'],
            ['id' => 13, 'name' => 'Gynecologist'],
            ['id' => 14, 'name' => 'Hematology'],
            ['id' => 15, 'name' => 'Hepatologists'],
            ['id' => 16, 'name' => 'Orthopdist'],
            ['id' => 17, 'name' => 'Pediatrician'],
            ['id' => 18, 'name' => 'Plastic Surgeon'],
            ['id' => 19, 'name' => 'Surgeon'],
            ['id' => 20, 'name' => 'Urologist'],
            ['id' => 21, 'name' => 'Rheumatologist'],
            ['id' => 22, 'name' => 'Ophthalmologist'],
            ['id' => 23, 'name' => 'General Practitioner'],
            ['id' => 24, 'name' => 'Ear , Nose and Throat'],
            ['id' => 25, 'name' => 'Endoscopic Surgeon'],
            ['id' => 26, 'name' => 'Laboratory & Analytical'],
            ['id' => 27, 'name' => 'Pharmacist'],
            ['id' => 28, 'name' => 'Oncologist'],
            ['id' => 29, 'name' => 'Gastroenterology and Endoscopy'],
    ];
        foreach($doctorSpecailty as $spceailty){
            DoctorSpecailty::create($spceailty);
        }
    }
}
