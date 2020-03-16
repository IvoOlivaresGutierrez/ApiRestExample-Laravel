<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codeQuantity = 50;

        factory(Province::class, $codeQuantity)->create();
    }
}
