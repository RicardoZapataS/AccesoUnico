<?php

namespace Database\Seeders;

use App\Models\PuntoAcceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuntoAccesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PuntoAcceso::create([
            'nombre_punto' => 'Reja 5',
            'areas_solicitadas' => '1-2-5',
            'ip_lector' => '172.16.111.23'
        ]);
        PuntoAcceso::create([
            'nombre_punto' => 'Felcn',
            'areas_solicitadas' => '7-8',
            'ip_lector' => '172.16.111.24'
        ]);
        PuntoAcceso::create([
            'nombre_punto' => 'Area 3',
            'areas_solicitadas' => '3',
            'ip_lector' => '172.16.111.21'
        ]);
        PuntoAcceso::create([
            'nombre_punto' => 'Area 2',
            'areas_solicitadas' => '2-3',
            'ip_lector' => '172.16.111.22'
        ]);
        PuntoAcceso::create([
            'nombre_punto' => 'prueba',
            'areas_solicitadas' => '2-3',
            'ip_lector' => '192.168.1.167'
        ]);
    }
}
