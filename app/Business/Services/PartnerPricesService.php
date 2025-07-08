<?php
namespace App\Business\Services;
use App\Business\Entities\Taxes;
use App\Business\Interfaces\CalculateProductPriceInterface;
use App\Models\Product;

class PartnerPricesService implements CalculateProductPriceInterface {
    public function calculateProductPrice(Product $product):float{
        $totalIva = $product->price * Taxes::IVA;
        $totalComission = $product->price * Taxes::OwnerComission;
        $finalprice = $product->price + $totalComission + $totalIva;
        return $finalprice;
    }
}