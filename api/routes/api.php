<?php

use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $roles = $request->user()->roles()->pluck('name');
    $user = $request->user();
    $user['roles'] = $roles;
    return response()->json($user);
})->middleware('auth:sanctum');

Route::prefix("questions")->group(function () {
    Route::get('/', [QuestionController::class, 'index']);
    Route::post('/', [QuestionController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{question}', [QuestionController::class, 'show']);
    Route::put('/{question}', [QuestionController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{question}', [QuestionController::class, 'destroy'])->middleware('auth:sanctum');

    Route::post('/{question}/vote', [QuestionController::class, 'vote'])->middleware('auth:sanctum');
});
