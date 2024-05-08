<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Casos\Caso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'administrador',
            'email'=>'empresa@gmail.com',
            'password'=>bcrypt('12345678'),            
        ]);
        //abogado
        User::create([
            'name'=>'abogado',
            'nombre_completo'=>'vismark montaño vargas',
            'direccion'=>'barrio 22 de octubre-scz',
            'email'=>'abogado@gmail.com',
            'rol'=>'abogado',
            'telefono'=>'72634989',
            'empresa_id'=>1,
            'password'=>bcrypt('12345678'),   
        ]);
        //cliente
        User::create([
            'name'=>'cliente',
            'email'=>'cliente@gmail.com',
            'nombre_completo'=>'daniel montaño vargas',
            'direccion'=>'calle melchor pinto-cbba',
            'empresa_id'=>1,
            'telefono'=>'69485317',
            'rol'=>'cliente',
            'password'=>bcrypt('12345678'),   
        ]);
        User::create([
            'name'=>'cliente',
            'email'=>'cliente2@gmail.com',
            'nombre_completo'=>'javier montaño vargas',
            'direccion'=>'calle melchor pinto-cbba',
            'empresa_id'=>1,
            'telefono'=>'69485317',
            'rol'=>'cliente',
            'password'=>bcrypt('12345678'),   
        ]);
        User::create([
            'name'=>'cliente',
            'email'=>'cliente3@gmail.com',
            'nombre_completo'=>'gladys montaño vargas',
            'direccion'=>'calle melchor pinto-cbba',
            'empresa_id'=>1,
            'telefono'=>'69485317',
            'rol'=>'cliente',
            'password'=>bcrypt('12345678'),   
        ]);
        //caso
        Caso::create([
            'abogado_id'=>2,
            'cliente_id'=>3,
            'nombre'=>'feminicidio',
            'descripcion'=>'maliante mata a una mujer en estado de hebriedad',
            'fecha_apertura'=>Carbon::now('America/La_Paz')
        ]);
        Caso::create([
            'abogado_id'=>2,
            'cliente_id'=>4,
            'nombre'=>'infanticidio',
            'descripcion'=>'padre mata a su hijo en estado de hebriedad',
            'fecha_apertura'=>Carbon::now('America/La_Paz')
        ]);
        Caso::create([
            'abogado_id'=>2,
            'cliente_id'=>5,
            'nombre'=>'infanticidio',
            'descripcion'=>'padre mata a su hijo en estado de hebriedad',
            'fecha_apertura'=>Carbon::now('America/La_Paz')
        ]);
   

    }
}
 