<?php

use App\models\product;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            ['id'=>1,'name'=>'product1','price' => 24],
            ['id'=>2,'name'=>'product2', 'price'    => 30],
            ['id'=>3,'name'=>'product3', 'price' => 50],
        ];

        foreach($product as $p){
            product::create($p);
        }

    }
}
