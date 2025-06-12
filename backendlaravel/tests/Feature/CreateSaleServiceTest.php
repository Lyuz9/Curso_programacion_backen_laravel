<?php

namespace Tests\Feature;

use App\Business\Services\CreateSaleService;
use App\Http\Requests\SaleRequest;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

beforeEach(function(){
    $this->service = new CreateSaleService();
});

uses(RefreshDatabase::class);

class CreateSaleServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

test("Creación de una venta correctamente", function(){
    $product1 = Product::factory()->create(["price" => 100.0]);
    $product2 = Product::factory()->create(["price" => 50.0]);

    $request = new SaleRequest([
        "email" => "test@example.com",
        "sale_date" => "2025-01-01 00:00:00",
        "concepts" => [
            ["quantity" => 2, "product_id" => $product1->id], // 2 * 100 = 200
            ["quantity" => 3, "product_id" => $product2->id], // 3 * 50 = 150
        ]
    ]);

    $saleEntity = $this->service->create($request);

    $this->assertDatabaseHas("sale", [
        "id" => $saleEntity->id,
        "email" => "test@example.com",
        "sale_date" => "2025-01-01 00:00:00",
        "total" => 350.0
    ]);

    $this->assertDatabaseHas("concept", [
        "sale_id" => $saleEntity->id,
        "product_id" => $product1->id,
        "quantity" => 2,
        "price" => 100.0
    ]);

    $this->assertDatabaseHas("concept", [
        "sale_id" => $saleEntity->id,
        "product_id" => $product2->id,
        "quantity" => 3,
        "price" => 50.0
    ]);
});

test("Falla la validación del request", function(){
    $data = [
        "email" => '',
        "sale_date" => '',
        "concepts" => []
    ];

    $validator = Validator::make($data, (new SaleRequest())->rules());

    expect($validator->fails())->toBeTrue();
});
