<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$ENDPOINT = '/tasks';

Route::get($ENDPOINT, [TaskController::class, 'index']);
Route::get($ENDPOINT . '/{id}',[TaskController::class, 'show']);
Route::post($ENDPOINT, [TaskController::class, 'store']);
Route::put($ENDPOINT . '/{id}', [TaskController::class, 'update']);
Route::delete($ENDPOINT . '/{id}', [TaskController::class, 'destroy']);