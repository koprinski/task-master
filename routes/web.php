<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});


Route::get('/bs', function () {
    return view('bs');
});
Route::get('/habits/', [TaskController::class, 'habits'])-> name('habits');  ;
Route::get('/daily', [TaskController::class, 'dailyTasks'])-> name('daily');
Route::get('/longTerm', [TaskController::class, 'longTermTasks'])-> name('longTerm');
Route::get('/insertH', function () {
    return view('insertHabit');
}) -> name('insertH');
Route::get('/insertD', function () {
    return view('insertDaily');
}) -> name('insertD');
Route::get('/insertL', function () {
    return view('insertLong');
}) -> name('insertL');

Route::delete('/task.habits/{id}',[TaskController::class,'deleteHabit']) -> name('habit.delete');
Route::delete('/task.daily/{id}',[TaskController::class,'deleteDaily']) -> name('daily.delete');
Route::delete('/task.longTerm/{id}',[TaskController::class,'deleteLong']) -> name('longTerm.delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
