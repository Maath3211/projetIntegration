<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponsablesController;

Route::GET('/',
[GestionController::class,'index'])->name('gestion.index');

Route::GET('/administration',
[AdminController::class,'index'])->name('admin.index');

Route::GET('/responsable',
[ResponsablesController::class,'index'])->name('responsable.index');