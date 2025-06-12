<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\SaleController;
use App\Http\Middleware\CheckValueInHeader;
use App\Http\Middleware\LogRequests;
use App\Http\Middleware\UppercaseName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/test", function() {
    return "El backend funciona correctamente";
});

Route::get("/backend", [BackendController::class, "getAll"]);

Route::get("/backend/{id?}", [BackendController::class, "get"]);

Route::post("/backend", [BackendController::class, "create"]);

// parametros opcionales (colocamos el ? al lado de id): Route::get("/backend/{id?}", [BackendController::class, "get"]);

Route::put("/backend/{id}", [BackendController::class, "update"]);

Route::delete("/backend/{id}", [BackendController::class, "delete"]);

Route::get("/query", [QueriesController::class, "get"]);

Route::get("/query/{id}", [QueriesController::class, "getById"]);

Route::get("/query/method/names", [QueriesController::class, "getnames"]);

Route::get("/query/method/search/{name}/{price}", [QueriesController::class, "searchName"]);

Route::get("/query/method/searchString/{value}", [QueriesController::class, "searchString"]);

Route::post("/query/method/advancedSearch", [QueriesController::class, "advancedSearch"]);

Route::get("/query/method/join", [QueriesController::class, "join"]);

Route::get("/query/method/groupby", [QueriesController::class, "groupBy"]);

Route::apiResource("/product", ProductController::class);
//->middleware("jwt.auth", [LogRequests::class]);

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::middleware(["jwt.auth"])->group(function (){
    Route::get("/who", [AuthController::class, "who"]);
    Route::post("/logout", [AuthController::class, "logout"]);

    Route::post("/refresh", [AuthController::class, "refresh"]);
});

Route::get("/info/message", [InfoController::class, "message"]);

Route::get("/info/iva/{id}", [InfoController::class, "iva"]);

Route::get("/info/encrypt/{data}", [InfoController::class, "encrypt"]);

Route::get("/info/decrypt/{data}", [InfoController::class, "decrypt"]);

Route::get("/info/encryptEmail/{id}", [InfoController::class, "encryptEmail"]);

Route::get("/info/singleton", [InfoController::class, "singleton"]);

Route::get("/info/encryptEmail2/{id}", [InfoController::class, "encryptEmail2"]);

Route::get("/api", [ApiController::class, "get"]);



Route::get("/sale", [SaleController::class, "get"]);
Route::post("/sale", [SaleController::class, "create"]);
