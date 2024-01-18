<?php

use App\Http\Controllers\Uprofile;
use App\Http\Controllers\userAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

