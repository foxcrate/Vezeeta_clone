<?php

use App\models\Admin;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123aA')
        ]);
    }
}
