<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Gustavo',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'pagina_web' => 'http://gustavoru.github.io/Portafolio/',
        ]);
        

        $user2 = User::create([
            'name' => 'Leandro',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('12345678'),
            'pagina_web' => 'http://gustavoru.github.io/Portafolio/',
        ]);
        
       
    }
}
