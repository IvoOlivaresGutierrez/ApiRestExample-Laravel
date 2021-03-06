<?php

use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class UserAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codeQuantity = 1000;

        factory(UserAddress::class, $codeQuantity)->create();
    }
}
