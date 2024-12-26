<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DdHouseController;
use App\Http\Controllers\ItopReplaceController;
use App\Http\Controllers\LiftingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\RsoController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth','verified'])->group(function () {
    // Dashboard
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    // Filter Commission
    Route::post('/commission/filter', [ CommissionController::class, 'filter'])->name('commission.filter');
    Route::get('/commission/export', [CommissionController::class, 'export'])->name('commission.export');


    Route::resources([
        'user'          => UserController::class,
        'ddHouse'       => DdHouseController::class,
        'rso'           => RsoController::class,
        'retailer'      => RetailerController::class,
        'itopReplace'   => ItopReplaceController::class,
        'commission'    => CommissionController::class,
        'lifting'       => LiftingController::class,
        'product'       => ProductController::class,
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
