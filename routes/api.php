<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SalaEduController;
use App\Http\Controllers\SalasUserController;
use App\Http\Controllers\SalaTestEduController;
use App\Http\Controllers\SolicitudSalaController;
use App\Http\Controllers\TestEduController;
use App\Http\Controllers\TestSalaController;
use App\Http\Controllers\TestSalaEduController;
use App\Http\Controllers\TestSalaUserController;
use App\Http\Controllers\TestVersionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSalaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitaSalaController;
use App\Http\Controllers\VisitaSalaUserController;
use App\Http\Controllers\VisitasUserController;
use App\Http\Resources\UserCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserCollection([$request->user()]);
    });
    
    Route::get('/usuario/visitas', VisitasUserController::class);
    Route::get('/usuario/visitas-salas', VisitaSalaUserController::class);
    Route::get('/usuario/salas', SalasUserController::class);
    
    Route::post('/home/tests', [HomeController::class, 'tests']);
    Route::post('/home/salas', [HomeController::class, 'salas']);
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/categorias', CategoriaController::class);
    Route::apiResource('/tipos', TipoController::class);
    Route::apiResource('/tests', TestController::class);
    Route::apiResource('/tests/{test}/test-versions', TestVersionController::class);
    Route::apiResource('/salas', SalaController::class);
    Route::apiResource('/salas/{sala}/user-salas', UserSalaController::class);
    Route::apiResource('/users/{user}/salas/{sala}/solicitud-salas', SolicitudSalaController::class);
    Route::apiResource('/test-versions/{test_version}/test-salas', TestSalaUserController::class);
    Route::apiResource('/edu/test-versions/{test_version}/visitas', TestEduController::class);
    Route::apiResource('/edu/salas/{sala}/user-salas', SalaEduController::class);
    Route::apiResource('/edu/salas/{sala}/test-salas', TestSalaController::class);
    Route::apiResource('/edu/salas/{sala}/test-salas/{test_sala}/visita-salas', SalaTestEduController::class);
    Route::apiResource('/salas/{sala}/test-salas', TestSalaEduController::class);
    Route::apiResource('/test-versions/{test_version}/visitas', VisitaController::class);
    Route::apiResource('/test-versions/{test_version}/test-salas/{test_sala}/visita-salas', VisitaSalaController::class);

    Route::get('/usuario/{user:usuario}', UserController::class);
});