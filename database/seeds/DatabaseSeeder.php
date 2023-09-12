<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('situation')->insert([
        //     ["id" => 1,"name" =>"Activo"],
        //     ["id" => 2,"name" =>"Reforma"],
        //     ["id" => 3,"name" =>"Falecimento"],
        //     ["id" => 4,"name" =>"Recisão"],
        //     ["id" => 5,"name" =>"Despedimento"],
        //     ["id" => 6,"name" =>"Fim do Contrato"]
        // ]);
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Gerson Maoze',
            'email' => 'gersonjfmaoze@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
