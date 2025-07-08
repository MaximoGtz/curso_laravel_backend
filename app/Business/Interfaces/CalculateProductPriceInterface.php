<?php

namespace App\Business\Interfaces;
use App\Models\Product;
interface CalculateProductPriceInterface{
    public function calculateProductPrice(Product $product):float;
}
