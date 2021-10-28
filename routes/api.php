<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return [
        'message' => 'Welcome to my Damilola\'s  Eskimi test',
    ];
});


Route::post('campaigns/{campaign}', [CampaignController::class, 'update']);
Route::apiResource('campaigns', CampaignController::class);
Route::apiResource('images', ImageController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
