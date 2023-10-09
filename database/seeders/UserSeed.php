<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Services\NetworkService;
use Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Criando usuario admin
         */
        User::create([
            'admin' => 1,
            'username' => 'admin',
            'cpf' => '00000000000',
            'name' => 'Administrador',
            'email' => 'admin@teste.com',
            'password' => Hash::make('123456789'),
        ]);

        $nUsuarios = (int) $this->command->ask('Quantos usuarios serão cadastrados?', 6);

        /**
         * Criando os usuários
         */
        $lastUser = null;
        for($i = 1; $i <= $nUsuarios; $i++) {
            $user = User::create([
                'username' => 'usuario_'.$i,
                'cpf' => '0000000000'.$i,
                'name' => 'Usuario Teste '.$i,
                'email' => 'usuario_'.$i.'@teste.com',
                'password' => Hash::make('123456789'),
            ]);

            if($i == $nUsuarios) {
                $user->orders()->create([
                    'description' => 'Produto 01',
                    'value' => 100,
                    'created_at' => '2023-10-01 02:30:00',
                ]);

                $user->orders()->create([
                    'description' => 'Produto 02',
                    'value' => 500,
                    'created_at' => '2023-10-05 12:00:00',
                ]);
            }

            if($i == ($nUsuarios - 1)) {
                $user->orders()->create([
                    'description' => 'Produto 03',
                    'value' => 1000,
                    'created_at' => '2023-09-30 23:00:00',
                ]);
            }

            if(!empty($lastUser)) {
                NetworkService::register($user, $lastUser, 1);
            }

            $lastUser = $user;
        }
    }
}
