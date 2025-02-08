<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleDetailController;
use App\Http\Controllers\ModuleHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::get('/modules/index', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
Route::post('/modules/store', [ModuleController::class, 'store'])->name('modules.store');
Route::get('/modules/edit/{id}', [ModuleController::class, 'show'])->name('modules.edit');
Route::PUT('/modules/update/{id}', [ModuleController::class, 'update'])->name('modules.update');
Route::delete('/modules/destroy/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');

Route::get('modules/{module}/details', [ModuleDetailController::class, 'index'])->name('module_details.index');
Route::get('modules/{module}/histories', [ModuleHistoryController::class, 'index'])->name('module_histories.index');

Route::get('/modules/status', [ModuleController::class, 'status'])->name('modules.status');
Route::get('/modules/auto-status', [ModuleController::class, 'autoStatus'])->name('modules.autoStatus');
