<?php

namespace Tests\Feature;

use App\Business\Services\EncryptService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Session\EncryptedStore;
use Tests\TestCase;

class EncryptorServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_encriptador(): void
    {
        $key ='unaclavesecreta';
        $encryptor = new EncryptService($key);

        $originalString = 'Una cadena de texto';

        $encryptedString = $encryptor->encrypt($originalString);

        expect($encryptedString)->not->toBe($originalString);

        $decryptedString = $encryptor->decrypt($encryptedString);

        expect($decryptedString)->toBe($originalString);
    }

}


test('Excepcion cuando la clave es incorrecta', function(){
    $key1 = 'unaclavesecreta';
    $key2 = 'unaclavemal';

    $encryptor1 = new EncryptService($key1);
    $encryptor2 = new EncryptService($key2);

    $encryptedString = $encryptor1->encrypt('Prueba');

    $this->expectException(Exception::class);

    $encryptor2->decrypt($encryptedString);
});

