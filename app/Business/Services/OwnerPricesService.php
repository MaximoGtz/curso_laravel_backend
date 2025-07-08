<?php
namespace App\Business\Services;

use App\Business\Entities\Taxes;
use App\Business\Interfaces\CalculateProductPriceInterface;
use App\Models\Product;
class OwnerPricesService implements CalculateProductPriceInterface{
    public function calculateProductPrice(Product $product):float{
        $totalIva = $product->price * Taxes::IVA;
        $finalprice = $product->price + $totalIva;
        return $finalprice;
    }
}