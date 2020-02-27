<?php

use Illuminate\Database\Seeder;

class InsumosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('insumos')->insert([
        	'producto' => 'Tambores',
        	'descripcion' => 'Metal, 200 lts',
        	'serial' => 'TB234',
        	'modelo' => 'XYZ',
        	'modulo' => 'Almacenamiento Gasolina',
        	'id_gerencia' => 1,
        	'ubicacion' => 'Almacen nro 2',
        	'existencia' => 300,
        	'in_almacen' => 200,
        	'out_almacen' => 100,
        	'disponibles' => 300,
            'entregados' => 0,
        	'en_reparacion' => 0

        ]);

        \DB::table('insumos')->insert([
        	'producto' => 'Tambores',
        	'descripcion' => 'Plástico, 200 lts',
        	'serial' => 'TB244',
        	'modelo' => 'XYZ',
        	'modulo' => 'Almacenamiento de Agua',
        	'id_gerencia' => 1,
        	'ubicacion' => 'Almacen nro 1',
        	'existencia' => 300,
        	'in_almacen' => 200,
        	'out_almacen' => 100,
        	'disponibles' => 300,
            'entregados' => 0,
        	'en_reparacion' => 0

        ]);

        \DB::table('insumos')->insert([
        	'producto' => 'Palas',
        	'descripcion' => 'Metal',
        	'serial' => 'PL234',
        	'modelo' => 'PLTX',
        	'modulo' => 'Recolección',
        	'id_gerencia' => 2,
        	'ubicacion' => 'Almacen nro 2',
        	'existencia' => 300,
        	'in_almacen' => 200,
        	'out_almacen' => 100,
        	'disponibles' => 300,
            'entregados' => 0,
        	'en_reparacion' => 0

        ]);

        \DB::table('insumos')->insert([
        	'producto' => 'Carretilla',
        	'descripcion' => 'Capacidad 100 kgs.',
        	'serial' => 'CT234',
        	'modelo' => 'CT456',
        	'modulo' => 'Recolección',
        	'id_gerencia' => 2,
        	'ubicacion' => 'Almacen nro 2',
        	'existencia' => 300,
        	'in_almacen' => 200,
        	'out_almacen' => 100,
        	'disponibles' => 300,
            'entregados' => 0,
        	'en_reparacion' => 0

        ]);
    }
}
