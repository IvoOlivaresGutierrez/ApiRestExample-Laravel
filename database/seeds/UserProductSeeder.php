<?php

use App\Models\Product;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 600; $i++) {
            DB::table('user_product')->insert([
                'user_id' => User::all()->random()->id,
                'product_id' => Product::all()->random()->id
            ]);
        }
    }
}
