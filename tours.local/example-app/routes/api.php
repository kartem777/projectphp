<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather/{city}', function ($city) {
    $apiKey = '292e0ee8e709fada8cfb0bb124f015bd';

    $response = Http::get('http://api.weatherstack.com/current', [
        'access_key' => $apiKey,
        'query' => $city,
    ]);

    if ($response->successful()) {
        return response()->json($response->json());
    } else {
        return response()->json(['error' => 'Failed to fetch weather data'], 500);
    }
});
