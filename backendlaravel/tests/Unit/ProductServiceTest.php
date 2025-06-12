<?php

namespace Tests\Unit;

use App\Business\Services\ProductService;
use PHPUnit\Framework\TestCase;
use App\Business\Entities\Taxes;


class ProductServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function Calcula_testIva(): void
    {
        $price = 100;

        $service = new ProductService();

        $result = $service->calculateIVA($price);

        expect($result)->toBe($price * (1 + Taxes::IVA));
    }
}
