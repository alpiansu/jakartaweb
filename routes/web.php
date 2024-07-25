<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ContactController;
use App\Http\Controllers\FE\InsightController;

use App\Http\Controllers\Admin\AdminController;

//test
// Route::get('/', function () {
//     return view('master-fe');
// });

Route::get("/", [HomeController::class, "index"])->name('fe.home');
Route::get("/contact", [ContactController::class, "index"])->name('fe.contact');
Route::get("/insight", [InsightController::class, "index"])->name('fe.insight');

Auth::routes();

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
