<?php

use Illuminate\Database\Seeder;
use App\models\API\analyzes;
class DatabaseTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = [
            ['id' => 1 , 'name' => 'Conventional angiography'],
            ['id' => 2 , 'name' => 'CT angiography (CTA)'],
            ['id' => 3 , 'name' => 'MR angiography (MRA)'],
            ['id' => 4 , 'name' => 'CT guided biopsy'],
            ['id' => 5 , 'name' => 'Ultrasound guided biopsy'],
            ['id' => 6 , 'name' => 'Mammogram and Son mammography'],
            ['id' => 7 , 'name' => 'Fine Needle Aspiration & Breast Core biopsy'],
            ['id' => 8 , 'name' => 'Breast Ultrasound'],
            ['id' => 9 , 'name' => 'CT Brain'],
            ['id' => 10 , 'name' => 'paranasal sinuses (PNS)'],
            ['id' => 11 , 'name' => 'CT Chest'],
            ['id' => 12 , 'name' => 'CT paranasal sinuses (PNS)'],
            ['id' => 13 , 'name' => 'CT Chest'],
            ['id' => 14 , 'name' => 'CT Abdomen (or abdomen & pelvis)'],
            ['id' => 15 , 'name' => 'CT triphasic (Detailed liver imaging)'],
            ['id' => 16 , 'name' => 'CT angiography'],
            ['id' => 17 , 'name' => 'Any other CT examination requiring contrast administration'],
            ['id' => 18 , 'name' => 'Arterial Doppler'],
            ['id' => 19 , 'name' => 'Venous Doppler'],
            ['id' => 21 , 'name' => 'Thyroid Doppler'],
            ['id' => 22 , 'name' => 'Renal Doppler'],
            ['id' => 23 , 'name' => 'Renal Doppler'],
            ['id' => 24 , 'name' => 'Computed and Digital Radiography'],
            ['id' => 25 , 'name' => 'Barium Enema'],
            ['id' => 26 , 'name' => 'Barium Swallow or Barium meal'],
            ['id' => 27 , 'name' => 'Barium meal follow through'],
            ['id' => 28 , 'name' => 'Cystogram'],
            ['id' => 29 , 'name' => 'Hysterosalpingography'],
            ['id' => 30 , 'name' => 'IVP or IVU (Excretory urography)'],
            ['id' => 31 , 'name' => 'Sialography",3 Tesla MRI'],
            ['id' => 32 , 'name' => '1.5 Tesla MRI'],
            ['id' => 33 , 'name' => 'Open MRI'],
            ['id' => 34 , 'name' => 'MR Spectroscopy'],
            ['id' => 35 , 'name' => 'MR angiography'],
            ['id' => 36 , 'name' => 'Thyroid Uptake and Scan'],
            ['id' => 37 , 'name' => 'Renal isotopes'],
            ['id' => 38 , 'name' => 'Thalium Scan (Stress test)'],
            ['id' => 39 , 'name' => 'Hepatobiliary (Gallbladder) Scan'],
            ['id' => 40 , 'name' => 'Bone Scan'],
            ['id' => 41 , 'name' => 'Ventilation / perfusion (pulmonary) Scan'],
        ];

        foreach($test as $test){
            analyzes::create($test);
        }
        // for($i = 0;$i< 40; $i++){
        //     analyzes::create([
        //         'name' => str_random(10),
        //     ]);
        // }
    }
}
