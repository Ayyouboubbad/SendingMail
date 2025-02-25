
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StageController;

Route::get('/demande-stage', function () {
    return view('stage_form');
})->name('form.stage');

Route::post('/send-email', [StageController::class, 'store'])->name('email');
