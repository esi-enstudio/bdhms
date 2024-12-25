<?php

use App\Http\Controllers\Api\ManagerController;
use App\Http\Controllers\Api\RetailerController;
use App\Http\Controllers\Api\RsoController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::get('managers', ManagerController::class);
Route::get('supervisors', SupervisorController::class);
Route::get('rsos', RsoController::class);
Route::get('retailers', RetailerController::class);
Route::get('users', [UserController::class, 'fetchUsers']);
