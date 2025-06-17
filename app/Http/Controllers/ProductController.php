<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\ProductServiceInterface;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query("per_page", 10);
        $page = $request->query("page", 0);
        $offset = $perPage * $page;
        $products = Product::skip($offset)->take($perPage)->get();

        return response()->json($products);
    }
    public function store(Request $request)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:550',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric'
            ], [
                'name.required' => "Se necesita el campo nombre.",
                'name.string' => "El campo nombre debe de ser texto.",
                'name.max' => 'El campo del nombre excede lo largo',
                'description.string' => 'El campo descripción debe de ser texto.',
                'description.required' => 'Se necesita el campo descripción.',
                'stock.required' => 'Se necesita el campo stock.',
                'stock.integer' => 'El campo stock necesita ser un número entero',
                'category_id.required' => 'Se necesita el campo id de categoría',
                'category_id.exists' => 'La categoría no existe.',
                'price.required' => 'El precio es requerido',
                'price.numeric' => 'El precio debe de ser un dato numerico'

            ]);

            $product = Product::create($request->all());
            return response()->json($product);
        } catch (ValidationException $e) {
            //throw $th;
            return response()->json([
                "error" => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function show(Product $product)
    {
        return $product;
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            //code...
            $validated_data = $request->validated();
            $product->update($validated_data);
            return response()->json([
                "message" => "success",
                "product" => $product
            ]);
        } catch (Exception $e) {
            return response()->json(["error" => $e]);
        }
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["message" => "Producto eliminado", "product" => $product]);
    }
}
