<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
});


Route::get('/bs', function () {
    return view('bs');
});

//view routes
Route::get('/habits/', [TaskController::class, 'habits'])->middleware(['auth', 'verified'])-> name('habits');
Route::get('/daily', [TaskController::class, 'dailyTasks'])->middleware(['auth', 'verified'])-> name('daily');
Route::get('/longTerm', [TaskController::class, 'longTermTasks'])->middleware(['auth', 'verified'])-> name('longTerm');
Route::get('/iHabits/', [TaskController::class, 'iHabits'])->middleware(['auth', 'verified'])-> name('iHabits');
Route::get('/iDaily/', [TaskController::class, 'iDaily'])->middleware(['auth', 'verified'])-> name('iDaily');
Route::get('/iLongTerm/', [TaskController::class, 'iLongTerm'])->middleware(['auth', 'verified'])-> name('iLongTerm');

//insert routes
Route::post('/iLongTerm', [TaskController::class, 'newLongTerm'])->middleware(['auth', 'verified'])->name('insert.longTerm');
Route::post('/iDaily', [TaskController::class, 'newDaily'])->middleware(['auth', 'verified'])->name('insert.daily');
Route::post('/iHabits', [TaskController::class, 'newHabit'])->middleware(['auth', 'verified'])->name('insert.habit');


//delete routes
Route::delete('/task.habits/{id}',[TaskController::class,'deleteHabit'])->middleware(['auth', 'verified']) -> name('habit.delete');
Route::delete('/task.daily/{id}',[TaskController::class,'deleteDaily'])->middleware(['auth', 'verified']) -> name('daily.delete');
Route::delete('/task.longTerm/{id}',[TaskController::class,'deleteLong']) ->middleware(['auth', 'verified'])-> name('longTerm.delete');

//points routes
Route::post('/task.habits/{check}',[TaskController::class,'PointsHabit'])->middleware(['auth', 'verified']) -> name('habit.Points');
Route::post('/task.daily/{id}',[TaskController::class,'completeD'])->middleware(['auth', 'verified']) -> name('daily.complete');
Route::post('/task.longTerm/{id}',[TaskController::class,'completeL'])->middleware(['auth', 'verified']) -> name('longTerm.complete');


//profile updates
Route::post('/profile',[UserController::class,'upload'])->middleware(['auth', 'verified'])->name('profilePic');

Route::get('/habbit/', [TaskController::class, 'habits'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
