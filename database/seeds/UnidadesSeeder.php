<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unid_admin')->insert([
            'codigo' => '1234567890',
            'unid_admin' => 'Unidad de Desarrollo Institucional y Tecnologías de la Información',
            'siglas' => 'UDITI',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('unid_admin')->insert([
            'codigo' => '0987654321',
            'unid_admin' => 'Secretaría Particular',
            'siglas' => 'SecPart',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
