<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ItemApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('item', function () {
    return response()->json('Hello World');
});
//category
Route::apiResource('category', CategoryApiController::class);
//item
Route::apiResource('item', ItemApiController::class);
// Route::get('category', [CategoryApiController::class, 'index']);
// Route::post('category', [CategoryApiController::class, 'store']);
// Route::delete('category/{id}', [CategoryApiController::class, 'destroy']);
// Route::put('category/{id}', [CategoryApiController::class, 'update']);
