<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FruitController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//para obtener las futas y almacenarlas
Route::get('/Fruits', [FruitController::class,'getFruits'])->name("get.fruits");
//para consultar todas las frutas
Route::get('/AllFruits', [FruitController::class,'getAllFruits'])->name("get.allfruits");
//para consultar fruta por nombre
Route::get('/FruitName/{name}', [FruitController::class,'getFruitByName'])->name("get.namefruit");
//para consultar fruta por id
Route::get('/FruitId/{id}', [FruitController::class,'getFruitById'])->name("get.idfruit");

