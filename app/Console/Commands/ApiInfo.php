<?php

namespace App\Console\Commands;

use App\ExternalService\ApiService;
use Illuminate\Console\Command;

class ApiInfo extends Command
{
    public function __construct(protected ApiService $apiService)
    {
        parent::__construct();
    }
    protected $signature = 'app:api-info';
    protected $description = 'It consults an api third party API.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonString = json_encode($this->apiService->getData());
        $this->info($jsonString);
    }
}
