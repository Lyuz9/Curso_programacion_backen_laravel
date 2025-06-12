<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUserRegistered implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 3;


    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        throw new Exception("Error al registrar el usuario: {$this->attempts()}");


        //Log::info("Nuevo usuario registrado ", ["id" => $event->user->id]);
    }

    public function failed(UserRegistered $event, $exception)
    {
        Log::critical("El registro del usuario {$event->user["id"]} definitivamente");
    }
}
