<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TestEduController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SalaEduController;
use App\Http\Controllers\TestVersionController;

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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('/cargos', CargoController::class);
    Route::apiResource('/categorias', CategoriaController::class);
    Route::apiResource('/tests', TestController::class);
    Route::apiResource('/tipos', TipoController::class);
    Route::apiResource('/salas', SalaController::class);
    Route::apiResource('/tests/{test}/test-versions', TestVersionController::class);
    Route::apiResource('/edu/test-versions/{test_version}/visitas', TestEduController::class);
    Route::apiResource('/edu/salas/{sala}/alumno-salas', SalaEduController::class);

    Route::post('/home/tests', [HomeController::class, 'tests'])->name('home.tests');
    Route::post('/home/salas', [HomeController::class, 'salas'])->name('home.salas');

    Route::get('/hola', function() {
        return ['Enviando Email'];
    });
});


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');