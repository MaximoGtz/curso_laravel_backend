<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\Foreach_;

class ClearOldUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:clear-old-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It deletes all the files in the public/temp files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folder_path = public_path("temp");
        if(!File::exists($folder_path)){
            $this->error("Folder {$folder_path} doesn't exist");
            return Command::FAILURE;
        };
        $files = File::files($folder_path);
        foreach ($files as $file) {
            File::delete($file);
            $this->info("Deleted file: {$file->getFilename()}");
        }
        $this->info("Files deleted succesfully");
    }
}
