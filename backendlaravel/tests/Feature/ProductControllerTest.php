<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->withoutMiddleware(\Tymon\JWTAuth\Http\Middleware\Authenticate::class);
});

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_token(): void
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        Product::factory()->count(15)->create();

        $response = $this->withHeader("Authorization", "Bearer $token")
            ->getJson('/api/product?per_page=5&page=0');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(5)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price', 'description', 'category_id']
            ]);

        $data = $response->json();

        expect(count($data))->toBe(5);
    }
}

test('Crear un producto de manera correcta', function(){
    $category = Category::factory()->create();

    $productData = [
        'name' => 'Producto A',
        'price' => 99.99,
        'description' => 'Descripción A',
        'category_id' => $category->id,
    ];

    $response = $this->postJson(route("product.store"), $productData);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson($productData);

    $this->assertDatabaseHas('product', $productData);
});

test('Datos de productos invalidos al crear', function(){
    $invalidProductData = [
        "name" => '',
        "price" => 'texto',
        "description" => str_repeat('a', 3000),
        "category_id" => 9999
    ];

    $response = $this->postJson(route("product.store"), $invalidProductData);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors([
            'name', 'price', 'description', 'category_id'
        ]);
});

test('Actualizar un producto correctamente', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        "category_id" => $category->id
    ]);

    $newCategory = Category::factory()->create();

    $data = [
        "name" => 'Producto Actualizado',
        "price" => 199.99,
        "description" => 'Una descripción',
        "category_id" => $newCategory->id
    ];

    $response = $this->putJson(route("product.update", $product), $data);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([

            "message" => 'Producto actualizado correctamente',

            "product" => [
                "id" => $product->id,
                "name" => 'Producto Actualizado',
                "price" => 199.99,
                "description" => 'Una descripción',
                "category_id" => $newCategory->id
            ]
        ]);

    $this->assertDatabaseHas('product', [
        "id" => $product->id,
        "name" => 'Producto Actualizado',
        "price" => 199.99,
        "description" => 'Una descripción',
        "category_id" => $newCategory->id
    ]);
});

test('Falla si no se envia id de la categoria', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(["category_id" => $category->id]);

    $data = [
        "name" => 'Producto sin categoria',
        "price" => 150.00,
        "description" => 'Descripción sin categoría'
    ];

    $response = $this->putJson(route("product.update", $product), $data);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors(['category_id']);
});

test('Falla si el id de la categoria no existe', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(["category_id" => $category->id]);

    $data = [
        "name" => 'producto con categoría inexistente',
        "price" => 175.75,
        "category_id" => 99999
    ];

    $response = $this->putJson(route("product.update", $product), $data);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors(["category_id"]);
});

test('Eliminar un producto correctamente', function(){
    $product = Product::factory()->create();

    $response = $this->deleteJson(route("product.destroy", $product));

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            "message" => "Producto eliminado correctamente"
        ]);

    $this->assertSoftDeleted("product", [
        "id" => $product->id
    ]);
});

test("Comprobar que el producto no existe", function(){
    $response = $this->deleteJson(route("product.destroy", ["product" => 987878]));

    $response->assertStatus(Response::HTTP_NOT_FOUND);
});
