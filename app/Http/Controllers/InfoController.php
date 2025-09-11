<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\CalculateProductPriceInterface;
use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Interfaces\ProductServiceInterface;
use App\Business\Interfaces\SalesServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\HiService;
use App\Business\Services\ProductService;
use App\Business\Services\SingletonService;
use App\Business\Services\UserService;
use App\ExternalService\ApiService;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class InfoController extends Controller
{
    public function __construct(
        protected ProductService $productService, 
        protected EncryptService $encryptService, 
        protected SalesServiceInterface $salesService, 
        protected UserService $userService,
        protected MessageServiceInterface $messageService,
        protected SingletonService $singletonService,
        protected CalculateProductPriceInterface $calculateProductPriceService
        )
    {
        
    }
    public function message(){
        return $this->messageService->hi();
    }
    // Aqui estas usando la interfaz MessageServiceInterface sin importar desde que clase se te envíe ni el comportamiento
    // Para poder usar esta interfaz tenemos que ligarla en provider que se encuentra en: Providers: AppServideProviders
    // public function message2(){
    //     return $service->sayHi();
    // }
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
    public function encryptEmail(int $id){
        $encryptedEmail =  $this->userService->encryptEmail($id);
        return response()->json($encryptedEmail, Response::HTTP_ACCEPTED);
    }
    public function encryptEmail2(int $id){
        $userService = app()->make(UserService::class);
        $encryptedEmail = $userService->encryptEmail($id);
        // $encryptedEmail =  $this->userService->encryptEmail($id);
        return response()->json($encryptedEmail, Response::HTTP_ACCEPTED);
    }
    public function singleton(SingletonService $singleton2){
        return response()->json($this->singletonService->value." ".$singleton2->value);

    }
    public function getPartnerPrice($id){
        $product = Product::findOrFail($id);
        return response()->json([
            "product" => $product,
            "finalPrice" => $this->calculateProductPriceService->calculateProductPrice($product)
        ]);
    }
}
