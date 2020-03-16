<?php

use App\Models\Commune;
use App\Models\Product;
use App\Models\Province;
use App\Models\UserAddress;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Desabilitamos la restricción de clave foranea mienstras se ejecutan los dbseeders
        Schema::disableForeignKeyConstraints();

        // Borramos los campos actuales en la db
        Commune::truncate();
        Province::truncate();
        UserAddress::truncate();
        Product::truncate();
        User::truncate();

        // Desabilitamos los disparadores de eventos por dbinsert
        Commune::flushEventListeners();
        Province::flushEventListeners();
        UserAddress::flushEventListeners();
        Product::flushEventListeners();
        User::flushEventListeners();

        // Ejecutacion los dbseeders
        $this->call(ProvinceTableSeeder::class);
        $this->call(CommuneTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserAddressTableSeeder::class);
        $this->call(ProductTableSeeder::class);

        // Habilitamos la restricción de clave foranea
        Schema::enableForeignKeyConstraints();
    }
}
