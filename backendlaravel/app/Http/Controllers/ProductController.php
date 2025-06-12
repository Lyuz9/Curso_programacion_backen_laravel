<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query("per_page", 10);
        $page = $request->query("page", 0);
        $offset = $page * $perPage;

        $products = Product::skip($offset)->take($perPage)->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|max:2000',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:category,id'
            ], [
                "name.required" => "El nombre del producto es obligatorio",
                "description.required" => "La description es obligatoria",
                "price.required" => "El precio es obligatorio",
                "category_id.required" => "La categoria seleccionada no es valida"
            ]);

            $product = Product::create($validatedData);

            return response()->json($product);
        } catch (ValidationException $e) {
            return response()->json([
                "errors" => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();

            $product->update($validatedData);

            return response()->json([
                "message" => "Producto actualizado correctamente",
                "product" => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            "message" => "Producto eliminado correctamente"
        ]);
    }
}
