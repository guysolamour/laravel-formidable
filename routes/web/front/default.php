<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;


Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('legal-mentions', [FrontController::class, 'legalMentions'])->name('front.legalmention.index');
Route::get('about', [FrontController::class, 'about'])->name('front.about.index');
