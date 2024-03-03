<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalendarController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
Route::resource('fullcalendar', FullCalendarController::class)
->only(['index'])
->middleware(['auth', 'verified']); 

Route::resource('fullcalendarAjax', FullCalendarController::class)
->only(['ajax'])
->middleware(['auth', 'verified']);
*/

Route::controller(FullCalendarController::class)->group(function(){
    Route::get('fullcalendar', 'index')
    ->middleware(['auth', 'verified']);
    Route::post('fullcalendarAjax', 'ajax')
    ->middleware(['auth', 'verified']);
});


require __DIR__.'/auth.php';
