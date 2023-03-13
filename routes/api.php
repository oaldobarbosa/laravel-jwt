<?php

use App\Http\Middleware\API\v1\ProtectedRouteAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\v1\AuthController;


Route::get('/', function () {
    return response()->json(['api_name' => 'laravel-jwt', 'api_version' => '1.0.0']);
});


Route::prefix('v1')->group( function (){
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware([ProtectedRouteAuth::class])->group(function (){
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });



});

/*Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');*/
