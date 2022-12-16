<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgeCalculatorController;
use App\Http\Controllers\WorkTimeCalculatorController;
use App\Http\Controllers\BMICalculatorcontroller;
use App\Http\Controllers\PercentageCalculatorController;
use App\Http\Controllers\SimpleCalculatorController;
use App\Http\Controllers\AverageCalculatorController;
use App\Http\Controllers\DateCalculatorController;
use App\Http\Controllers\LengthConveterController;
use App\Http\Controllers\RandomGenratorController;
use App\Http\Controllers\CarInsuranceGeneratorController;
use App\Http\Controllers\ParkingLotManagementController;
use App\Http\Controllers\generalController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    
    // age calculator
    Route::post('/age', [AgeCalculatorController::class, 'AgeCalculate']);
    
    // WorkTimeCalculator 
    Route::post('/time', [WorkTimeCalculatorController::class, 'timeCalculate']);
    //bmi calculate
    Route::post('/bmi', [BMICalculatorcontroller::class, 'bmiCalculate']);

    //percentage calculate
    Route::post('/percentage', [PercentageCalculatorController::class, 'percentageCalculate']);

    //simple Calculator
    Route::post('/simple', [SimpleCalculatorController::class, 'simpleCalculator']);

    //average calculator
    Route::post('/average', [AverageCalculatorController::class, 'averageCalculator']);

    //date calculator
    Route::post('/date', [DateCalculatorController::class, 'dateCalculator']);

    //power Calculator
    Route::post('/length', [LengthConveterController::class, 'lengthCalculate']);

    // random genrator
    Route::post('/random', [RandomGenratorController::class, 'randomGenrate']);
    // car insurance Generator
    Route::post('/car', [CarInsuranceGeneratorController::class, 'carGenerate']);

    // bar graph 
    Route::post('/bar', [CarInsuranceGeneratorController::class, 'barGraph']);

    // parking management 
    Route::post('/parking', [ParkingLotManagementController::class, 'parkingRegister']);
    Route::post('/parking-list', [ParkingLotManagementController::class, 'parkingList']);
    Route::post('/search-list', [ParkingLotManagementController::class, 'serchList']);

    //counter
    Route::get('/count', [ParkingLotManagementController::class,'countNumber']);

    // time watch
    Route::post('/time', [generalController::class,'timeWatch']);

    //Pythagorean Theorem Calculator
    Route::post('/pythagorean', [generalController::class,'pythagoreanTheorem']);



});
