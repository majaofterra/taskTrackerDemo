<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/project', [DashboardController::class, 'project'])->name('project');
    Route::put('/filter', [DashboardController::class, 'filter'])->name('filter');
    Route::put('/search', [DashboardController::class, 'search'])->name('search');

    Route::delete('/task/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
});
