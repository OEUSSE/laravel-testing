<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WriteInLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:write 
                            { mensaje=No hay mensaje : Mensaje a mostrar en log }
                            {--queue= : Si el mensaje será encolado }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escribe en log lo que se envíe por parámetros';

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
        //$mensaje = $this->argument('mensaje') ?? 'No pusieron mensaje';
        //\Log::info($mensaje);
        $mensaje = $this->option('queue') ? 'va por una cola y va por '.$this->option('queue') : 'no va por una cola';
        \Log::info($this->argument('mensaje').' - '.$mensaje);
    }
}
