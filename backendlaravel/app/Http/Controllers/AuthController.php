<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $validatedDate = $request->validated();

        $user = User::create([
            'name' => $validatedDate['name'],
            'email' => $validatedDate['email'],
            'password' => bcrypt($validatedDate['password'])
        ]);

        event(new UserRegistered($user));

        return response()->json([
            'message' => 'Usuario registrado correctamente',
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $validatedDate = $request->validated();

        $credentials = ['email' => $validatedDate['email'],
                        'password' => $validatedDate['password']];
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Credenciales incorrectas'
                ], Response::HTTP_UNAUTHORIZED);
            }
        }catch(JWTException){
            return response()->json([
                'error' => 'No se pudo generar el token'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        /*
        return response()->json([
            'token' => $token
        ]);
        */

        return $this->respondWithToken($token);
    }



    public function who()
    {
        $user = auth()->user();

        return response()->json([
            'user' => $user
        ]);
    }

    public function logout()
    {
        try{
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);

            return response()->json([
                'message' => 'Sesión cerrada correctamente'
            ]);
        }catch(JWTException $e){
            return response()->json([
                'error' => 'No se pudo cerrar la sesión, el token no es valido'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function refresh()
    {
        try{
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            JWTAuth::invalidate($token);
            return $this->respondWithToken($newToken);
        }catch(JWTException $e){
            return response()->json([
                'error' => 'Ocurrio un error al refrescar el token'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
