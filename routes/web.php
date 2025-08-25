<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(QRCodeController::class)->group(function () {
    Route::get('qr-code', 'create')->name('qr-code');
    Route::post('generate-qr-code', 'generateQrCode')->name('generate-qr-code');
});
