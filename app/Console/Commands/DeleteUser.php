<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {--id} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina un usuario mediante su id';

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
        $user = User::find($this->argument('id'));
        $res = $user->delete();

        if ($res) {
            $this->info('Eliminado');
        } else {
            $this->info('No se pudo eliminar');
        }
    }
}
