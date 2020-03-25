<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'user:create {--name} {name} {--email} {email} {--password} {password}';
    /* protected $signature = 'user:create 
                            {--N|name= : Nombre del usuario}
                            {--E|email= : Email del usuario}
                            {--P|password= : Contraseña del usuario}'; */

    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un usuario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # Validar que las opciones sean obligatorias

        $name = $this->ask('¿Cuál es el nombre del usuario?');
        $email = $this->ask('¿Cuál es el correo del usuario?');
        $password = $this->secret('¿Cuál será la contraseña del usuario?');

        if (empty($name) || empty($email) || empty($password)) {
            $this->error('Los datos deben completarse');
        } else {
            if ($this->confirm('¿Están todos los datos bien?')) {
                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->password = Hash::make($password);

                if ($newUser->save()) {
                    $this->info('Usuario creado');
                } else {
                    $this->info('Usuario no creado');
                }
            }
        }
    }
}
