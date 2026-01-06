<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Bye extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bye {name} {--lenguage=} {--rude}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It can say goodbtye, in a polite o rude way, you decide';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        switch ($this->option('lenguage')) {
            case 'spanish':
                if ($this->option('rude')) {
                    $message = "Vete al diablo {$this->argument('name')}";
                } else {
                    $message = "Adiós {$this->argument('name')}";
                }
                break;
            case 'english':
                if ($this->option('rude')) {
                    $message = "Fuck off {$this->argument('name')}";
                } else {
                    $message = "Bye {$this->argument('name')}";
                }
                break;

            default:
                if ($this->option('rude')) {
                    $message = "Vá se foder {$this->argument('name')}";
                } else {
                    $message = "Tchau {$this->argument('name')}";
                }
                break;
        }
        $this->info($message);
    }
}
