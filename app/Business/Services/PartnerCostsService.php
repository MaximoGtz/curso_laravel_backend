<?php
namespace App\Business\Services;
use App\Business\Interfaces\SalesServiceInterface;
use App\Business\Entities\Taxes;
class PartnerCostsService implements SalesServiceInterface{
    public function getTotalPrice($quantity): array
    {
        $array = [
            "price" => $quantity,
            "taxes" => $quantity * Taxes::IVA,
            "owner_comission" => $quantity * Taxes::OwnerComission,
            "total" => $quantity + $quantity * (Taxes::IVA) + $quantity * (Taxes::OwnerComission)
        ];
        return $array;
    }
}