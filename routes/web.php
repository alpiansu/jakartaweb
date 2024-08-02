<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ContactController;
use App\Http\Controllers\FE\InsightController;
use App\Http\Controllers\FE\WorkController;
use App\Http\Controllers\FE\ServiceController;
use App\Http\Controllers\FE\Service2Controller;

use App\Http\Controllers\Admin\AdminController;

//test
// Route::get('/', function () {
//     return view('master-fe');
// });

Route::get("/", [HomeController::class, "index"])->name('fe.home');
Route::get("/contact", [ContactController::class, "index"])->name('fe.contact');
Route::get("/insight", [InsightController::class, "index"])->name('fe.insight');
Route::get("/work", [WorkController::class, "index"])->name('fe.work');
Route::get("/service", [ServiceController::class, "index"])->name('fe.service');
Route::get("/service2", [Service2Controller::class, "index"])->name('fe.service2');

Auth::routes();

use App\Http\Controllers\Admin\HomeCarouselController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/home/carousel', [HomeCarouselController::class, 'index'])->name('admin.home.carousel');
    Route::post('/admin/home/carousel', [HomeCarouselController::class, 'store'])->name('admin.home.carousel.store');
    Route::get('/admin/home/carousel/edit/{id}', [HomeCarouselController::class, 'edit'])->name('admin.home.carousel.edit');
    Route::put('/admin/home/carousel/{id}', [HomeCarouselController::class, 'update'])->name('admin.home.carousel.update');
    Route::delete('/admin/home/carousel/{id}', [HomeCarouselController::class, 'destroy'])->name('admin.home.carousel.destroy');
});
