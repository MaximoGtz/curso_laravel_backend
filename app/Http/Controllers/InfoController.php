<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Interfaces\ProductServiceInterface;
use App\Business\Interfaces\SalesServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\HiService;
use App\Business\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class InfoController extends Controller
{
    public function __construct(protected ProductService $productService, protected EncryptService $encryptService, protected SalesServiceInterface $salesService)
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
    public function encrypt($data){
        return response()->json($this->encryptService->encrypt($data));
    }
    public function decrypt($data){
        return response()->json($this->encryptService->decrypt($data));
    }
    public function getProductPrice(int $id){
        $product = Product::find($id);
        return response()->json($this->salesService->getTotalPrice($product->price));
    }
}
