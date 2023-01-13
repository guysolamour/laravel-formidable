<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');


