<?php
namespace App\Business\Services;
use App\Business\Interfaces\SalesServiceInterface;
use App\Business\Entities\Taxes;
class OwnerCostsService implements SalesServiceInterface{
    public function getTotalPrice($quantity): array
    {
        $array=[
            "subtotal" => $quantity,
            "total" => $quantity * (Taxes::IVA +1)
        ];
        return $array;
    }
}