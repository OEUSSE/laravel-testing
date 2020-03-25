<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\User;

class UpdateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update {--id} {id} {--name} {name?} {--email} {email?} {--password} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar un usuario';

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
        $inputId = (int)$this->argument('id');
        $data = User::find($inputId);

        $name = ($this->argument('name')) ? $this->argument('name') : $data->name;
        $email = ($this->argument('email')) ? $this->argument('email') : $data->email;
        $password = ($this->argument('password')) ? Hash::make($this->argument('password')) : $data->password;


        $res = User::where('id', $inputId)
            ->update([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);

        if (!empty($res)) {
            $this->info('Actualizado');
        } else {
            $this->info('No se pudo actualizar');
        }
    }
}
