<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Services\HiService;
use App\Business\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\json;

class InfoController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        
    }
    public function message(HiService $service){
        return $service->sayHi();
    }
    // Aqui estas usando la interfaz MessageServiceInterface sin importar desde que clase se te envíe ni el comportamiento
    // Para poder usar esta interfaz tenemos que ligarla en provider que se encuentra en: Providers: AppServideProviders
    public function message2(MessageServiceInterface $service){
        return $service->hi();
    }
    public function taxes(int $id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(["message" => "Producto no encontrado"], Response::HTTP_NOT_FOUND);
        }
        $priceWithTaxes= $this->productService->calculateTaxes($product->price);
        return response()->json([
            "price" => $product->price,
            "price_with_taxes" => $priceWithTaxes
        ]);
    }
}
