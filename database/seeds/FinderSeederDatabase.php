<?php

use App\models\Finder;
use Illuminate\Database\Seeder;

class FinderSeederDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $finders=[['id' => 1, 'name' => 'Pharmacy Ghalab','phone'=>'4455666',
        'address'=>'Shoubra','lat'=>'30.122793','lng'=>'31.260916','type'=>'pharmacy'],
        ['id' => 2, 'name' => 'Pharmacy Sand','phone'=>'4455666',
        'address'=>'Shoubra','lat'=>'30.126877','lng'=>'31.270508','type'=>'pharmacy'],
        ['id' => 3, 'name' => 'Pharmacy Mansheia','phone'=>'4455666',
        'address'=>'Shoubra','lat'=>'30.122752','lng'=>'31.261460','type'=>'pharmacy'],
        ['id' => 4, 'name' => 'Pharmacy khater','phone'=>'4455666',
        'address'=>'Shoubra','lat'=>'30.122880','lng'=>'31.260833','type'=>'pharmacy'],
    ];
        foreach($finders as $finder){
            Finder::create($finder);
        }
    }
}
