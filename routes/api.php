<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Cprofile;
use App\Http\Controllers\Experience;
use App\Http\Controllers\Offer;
use App\Http\Controllers\Uprofile;
use App\Http\Controllers\User_Offer;
use App\Http\Controllers\userAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('USignUp',[Authentication::class, 'USignUp']);
Route::post('USignIn', [Authentication::class, 'USignIn']);

Route::post('CSignUp', [Authentication::class, 'CSignUp']);
//////////////////////////////////////////////////////////////////
Route::get('getUProfile/{id}', [Uprofile::class, 'getUProfile']);
Route::post('CreateUProfile', [Uprofile::class, 'CreateUProfile']);
Route::post('UpdateUProfile', [Uprofile::class, 'UpdateUProfile']);

Route::get('getCProfile/{id}',  [Cprofile::class, 'getCProfile']);
Route::post('CreateCProfile',   [Cprofile::class, 'CreateCProfile']);
Route::post('UpdateCProfile',   [Cprofile::class, 'UpdateCProfile']);

Route::get('getExp/{id}',  [Experience::class, 'getExp']);
Route::post('CreateExp',   [Experience::class, 'CreateExp']);
Route::post('UpdateExp',   [Experience::class, 'UpdateExp']);
Route::post('DeleteExp',   [Experience::class, 'DeleteExp']);

Route::get('getOffer/{id}',  [Offer::class, 'getOffer']);
Route::post('CreateOffer',   [Offer::class, 'CreateOffer']);
Route::post('UpdateOffer',   [Offer::class, 'UpdateOffer']);
Route::post('DeleteOffer',   [Offer::class, 'DeleteOffer']);

Route::get('getUoffers/{userid}',   [User_Offer::class, 'getUoffers']);
Route::get('getCoffers/{comid}',   [User_Offer::class, 'getCoffers']);
Route::get('checkSendCv/{userid}/{offerid}',   [User_Offer::class, 'checkSendCv']);
