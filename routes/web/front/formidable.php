<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FormidableController;

Route::get('formidable', [FormidableController::class, 'show'])->name('formidable.show');
Route::post('formidable/{url}', [FormidableController::class, 'store'])->name('formidable.store');
