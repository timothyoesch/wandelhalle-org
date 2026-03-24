<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $roles = $request->user()->roles()->pluck('name');
    return response()->json([
        'user' => $request->user(),
        'roles' => $roles,
    ]);
})->middleware('auth:sanctum');
