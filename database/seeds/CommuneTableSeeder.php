<?php

use App\Models\Commune;
use Illuminate\Database\Seeder;

class CommuneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codeQuantity = 450;

        factory(Commune::class, $codeQuantity)->create();
    }
}
