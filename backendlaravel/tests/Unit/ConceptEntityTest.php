<?php

namespace Tests\Unit;

use App\Business\Entities\ConceptEntity;

use PHPUnit\Framework\TestCase;

class ConceptEntityTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
        $concept = new ConceptEntity(quantity: 3, price: 20.0, product_id: 10);

        expect($concept->quantity)->toBe(3)
        ->and($concept->price)->toBe(20.0)
        ->and($concept->product_id)->toBe(10)
        ->and($concept->total)->toBe(60.0);

    }
}

test("Calcular total", function(){
    $concept = new ConceptEntity(quantity: 3, price: 15.0, product_id: 11);

    expect($concept->calculateTotal())->toBe(45.0);
});
