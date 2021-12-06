<?php
use Illuminate\Database\Seeder;
use App\models\API\Rays;
class DatabaseRaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ray = [
            ['id' => 1 , 'name' => 'FBS'],
            ['id' => 2 , 'name' => '2h PP'],
            ['id' => 3 , 'name' => 'Blood Picture'],
            ['id' => 4 , 'name' => 'Alpha-1-antitrypsin'],
            ['id' => 5 , 'name' => 'Progesterone'],
            ['id' => 6 , 'name' => 'Bl. glucose curve'],
            ['id' => 7 , 'name' => 'WBC T & Diff'],
            ['id' => 8 , 'name' => 'AMA'],
            ['id' => 9 , 'name' => 'Free T3'],
            ['id' => 10 , 'name' => 'DHEA'],
            ['id' => 11 , 'name' => 'SGPT(ALT)'],
            ['id' => 12 , 'name' => 'ESR'],
            ['id' => 13 , 'name' => 'ANCA (P&C)'],
            ['id' => 14 , 'name' => 'TSH'],
            ['id' => 15 , 'name' => 'Cortisol'],
            ['id' => 16 , 'name' => 'Protein Albumin'],
            ['id' => 17 , 'name' => 'Alkaline phosphatase'],
            ['id' => 18 , 'name' => 'Prothrombin time'],
            ['id' => 19 , 'name' => 'Sickling test'],
            ['id' => 20 , 'name' => 'Pathology & cytology'],
            ['id' => 21 , 'name' => 'Stone analysis'],
            ['id' => 22 , 'name' => 'Fructose in semen'],
            ['id' => 23 , 'name' => 'Stool Occult blood'],
            ['id' => 24 , 'name' => 'Pregnancy test in Blood'],
            ['id' => 25 , 'name' => 'Cocaine'],
            ['id' => 26 , 'name' => 'Cannabinoids'],
            ['id' => 27 , 'name' => 'Opiates'],
            ['id' => 28 , 'name' => 'Rose Waller'],
            ['id' => 29 , 'name' => 'Rhumatoid F. (quantitative)'],
            ['id' => 30 , 'name' => 'Paul Bunnel test'],
            ['id' => 31 , 'name' => 'LKM-Ab'],
            ['id' => 32 , 'name' => 'Islet cell antibodies'],
            ['id' => 33 , 'name' => 'HIV Ab.'],
            ['id' => 34 , 'name' => 'Mumps Ab.'],
            ['id' => 35 , 'name' => 'Epstein Barr Ab. (EBV)'],
            ['id' => 36 , 'name' => 'Herpes Simplex Ab'],
            ['id' => 37 , 'name' => 'CMV Ab'],
            ['id' => 38 , 'name' => 'Rubella Ab'],
            ['id' => 39 , 'name' => 'Toxoplasma Ab'],
            ['id' => 40 , 'name' => 'Chlamydia Ab'],
        ];

        foreach($ray as $ray){
            Rays::create($ray);
        }
        // for($i = 0;$i< 40; $i++){
        //     Rays::create([
        //         'name' => str_random(10),
        //     ]);
        // }
    }
}
