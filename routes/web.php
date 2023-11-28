<?php

use App\Http\Controllers\plyerReport;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\workoutPlanReport;
use App\Http\Livewire\WorkoutLivewire;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Mangementlivewire;
use App\Http\Livewire\Playerlivewire;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Livewire\PlayerPreformances;
use App\Http\Livewire\CouchPreformances;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['can:fullAccessUser'])->group(function () {
        Route::get('/mangement', Mangementlivewire::class)->name('mangement');
        Route::get('/report/{id}/{month}', [plyerReport::class, 'report'])->name('report');
        Route::get('/reportmonth/{id}/{month}', [plyerReport::class, 'reportMonth'])->name('report');
        Route::get('/workoutplan/{team}/{month}/{week}', [workoutPlanReport::class, 'report'])->name('workoutplan');
    });

    Route::middleware(['can:seeAccessplayers'])->group(function () {
        Route::get('/player', Playerlivewire::class)->name('player');
    });
    Route::middleware(['can:createPlan'])->group(function () {
    });
    Route::get('/plan', WorkoutLivewire::class)->name('plan');



    Route::middleware(['can:seereportplayers'])->group(function () {
        Route::get('/playerPreformance', PlayerPreformances::class)->name('playerPreformance');

    });



});

require __DIR__ . '/auth.php';