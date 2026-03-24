<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $roles = $request->user()->roles()->pluck('name');
    $user = $request->user();
    $user['roles'] = $roles;
    return response()->json($user);
})->middleware('auth:sanctum');
