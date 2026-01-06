<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ProductInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:product-info {id : ID of the product}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consults and brings the information of a product';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $product = Product::find($this->argument('id'));
        if(!is_numeric($this->argument('id')) || $this->argument('id') <= 0){
           $this->error("El comando solo recibe numeros positivos");
            return Command::FAILURE; 
        };
        if(!$product){
            $this->error("No existe el producto");
            return Command::FAILURE;
        }
            $this->info($product);
        
    }
}
