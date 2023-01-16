<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\FormidableController;

Route::middleware(['admin.auth'])->group(function () {
    Route::resource('formidable', FormidableController::class)->names([
        'index'      => 'back.formidable.index',
        'create'     => 'back.formidable.create',
        'show'       => 'back.formidable.show',
        'store'      => 'back.formidable.store',
        'edit'       => 'back.formidable.edit',
        'update'     => 'back.formidable.update',
        'destroy'    => 'back.formidable.delete',
    ]);
});

