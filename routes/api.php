<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Uprofile;
use App\Http\Controllers\userAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('USignUp',[Authentication::class, 'USignUp']);
Route::post('USignIn', [Authentication::class, 'USignIn']);
Route::post('CSignUp', [Authentication::class, 'CSignUp']);
Route::post('CSignIn', [Authentication::class, 'CSignIn']);