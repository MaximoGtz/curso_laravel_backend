<?php

namespace App\Business\Interfaces;
use App\Business\Entities\Taxes;

interface SalesServiceInterface{
    public function getTotalPrice($quantity):array;
}