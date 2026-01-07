<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Hi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
                        // arg required   arg not required   flag
    protected $signature = 'app:hi {name} 
                            {--last_name= : You put your last name}
                            {--uppercase : You decide if you want to put it in uppercase}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra un saludo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Required argument
        $name = $this->argument("name");
        //Optional argument
        $last_name = $this->option("last_name");
        $uppercase = $this->option("uppercase");
        $message = "Hola ".$name." ".$last_name;
        if($uppercase){
            $message = strtoupper($message);
        }
        $this->info($message);
    }
}
