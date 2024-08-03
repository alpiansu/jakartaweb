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
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get("/insight", [InsightController::class, "index"])->name('fe.insight');
Route::get("/work", [WorkController::class, "index"])->name('fe.work');
Route::get('/work/filter', [WorkController::class, 'filterProjects'])->name('work.filter');
Route::get("/service", [ServiceController::class, "index"])->name('fe.service');
Route::get("/service2", [Service2Controller::class, "index"])->name('fe.service2');

Auth::routes();

use App\Http\Controllers\Admin\HomeCarouselController;
use App\Http\Controllers\Admin\HomeAboutController;
use App\Http\Controllers\Admin\HomeGalleryController;
use App\Http\Controllers\Admin\HomeFeatureController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminService2Controller;
use App\Http\Controllers\Admin\AdminWorkController;
use App\Http\Controllers\Admin\AdminInsightController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminConfigController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/home/carousel', [HomeCarouselController::class, 'index'])->name('admin.home.carousel');
    Route::post('/admin/home/carousel', [HomeCarouselController::class, 'store'])->name('admin.home.carousel.store');
    Route::get('/admin/home/carousel/edit/{id}', [HomeCarouselController::class, 'edit'])->name('admin.home.carousel.edit');
    Route::put('/admin/home/carousel/{id}', [HomeCarouselController::class, 'update'])->name('admin.home.carousel.update');
    Route::delete('/admin/home/carousel/{id}', [HomeCarouselController::class, 'destroy'])->name('admin.home.carousel.destroy');

    Route::get('/admin/home/about', [HomeAboutController::class, 'index'])->name('admin.home.about');
    Route::post('/admin/home/about', [HomeAboutController::class, 'store'])->name('admin.home.about.store');
    Route::get('/admin/home/about/{id}', [HomeAboutController::class, 'edit'])->name('admin.home.about.edit');
    Route::put('/admin/home/about/{id}', [HomeAboutController::class, 'update'])->name('admin.home.about.update');
    Route::get('/admin/home/about/feature/{id}', [HomeAboutController::class, 'editFeature'])->name('admin.home.about.feature.edit');
    Route::put('/admin/home/about/feature/{id}', [HomeAboutController::class, 'updateFeature'])->name('admin.home.about.feature.update');
    Route::post('/admin/home/about/{about_us_id}/feature', [HomeAboutController::class, 'addFeature'])->name('admin.home.about.feature.store');
    Route::delete('/admin/home/about/feature/{id}', [HomeAboutController::class, 'destroyFeature'])->name('admin.home.about.feature.destroy');

    Route::get('/admin/home/gallery', [HomeGalleryController::class, 'index'])->name('admin.home.gallery');
    Route::post('/admin/home/gallery', [HomeGalleryController::class, 'store'])->name('admin.home.gallery.store');
    Route::put('/admin/home/gallery/{id}', [HomeGalleryController::class, 'update'])->name('admin.home.gallery.update');
    Route::delete('/admin/home/gallery/{id}', [HomeGalleryController::class, 'destroy'])->name('admin.home.gallery.destroy');

    Route::get('/admin/home/feature', [HomeFeatureController::class, 'index'])->name('admin.home.feature');
    Route::post('/admin/home/feature', [HomeFeatureController::class, 'store'])->name('admin.home.feature.store');
    Route::put('/admin/home/feature/{id}', [HomeFeatureController::class, 'update'])->name('admin.home.feature.update');
    Route::delete('/admin/home/feature/{id}', [HomeFeatureController::class, 'destroy'])->name('admin.home.feature.destroy');
    Route::put('/admin/home/feature-text', [HomeFeatureController::class, 'updateFeatureText'])->name('admin.home.feature.text.update');

    Route::get('/admin/service', [AdminServiceController::class, 'index'])->name('admin.service.index');
    Route::post('/admin/service/subservice/update', [AdminServiceController::class, 'updateSubService'])->name('admin.service.subservice.update');
    Route::post('/admin/service', [AdminServiceController::class, 'storeService'])->name('admin.service.store');
    Route::put('/admin/service/{id}', [AdminServiceController::class, 'updateService'])->name('admin.service.update');
    Route::delete('/admin/service/{id}', [AdminServiceController::class, 'destroyService'])->name('admin.service.destroy');
    Route::post('/admin/service/counter', [AdminServiceController::class, 'storeCounter'])->name('admin.service.counter.store');
    Route::put('/admin/service/counter/{id}', [AdminServiceController::class, 'updateCounter'])->name('admin.service.counter.update');
    Route::delete('/admin/service/counter/{id}', [AdminServiceController::class, 'destroyCounter'])->name('admin.service.counter.destroy');

    Route::get('/admin/service2', [AdminService2Controller::class, 'index'])->name('admin.service2.index');
    Route::post('/admin/service2/subservice/update', [AdminService2Controller::class, 'updateSubService'])->name('admin.service2.subservice.update');
    Route::post('/admin/service2', [AdminService2Controller::class, 'storeService'])->name('admin.service2.store');
    Route::put('/admin/service2/{id}', [AdminService2Controller::class, 'updateService'])->name('admin.service2.update');
    Route::delete('/admin/service2/{id}', [AdminService2Controller::class, 'destroyService'])->name('admin.service2.destroy');
    Route::post('/admin/service2/counter', [AdminService2Controller::class, 'storeCounter'])->name('admin.service2.counter.store');
    Route::put('/admin/service2/counter/{id}', [AdminService2Controller::class, 'updateCounter'])->name('admin.service2.counter.update');
    Route::delete('/admin/service2/counter/{id}', [AdminService2Controller::class, 'destroyCounter'])->name('admin.service2.counter.destroy');

    Route::get('/admin/work', [AdminWorkController::class, 'index'])->name('admin.projects.index');
    Route::get('/admin/work/create', [AdminWorkController::class, 'create'])->name('admin.projects.create');
    Route::post('/admin/work', [AdminWorkController::class, 'store'])->name('admin.projects.store');
    Route::get('/admin/work/{id}/edit', [AdminWorkController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/admin/work/{id}', [AdminWorkController::class, 'update'])->name('admin.projects.update');
    Route::put('/admin/work', [AdminWorkController::class, 'updateHeading'])->name('admin.projects.updateHeading');
    Route::delete('/admin/work/{id}', [AdminWorkController::class, 'destroy'])->name('admin.projects.destroy');

    Route::get('/admin/insight', [AdminInsightController::class, 'index'])->name('admin.insight.index');
    Route::post('/admin/insight', [AdminInsightController::class, 'store'])->name('admin.insight.store');
    Route::put('/admin/insight/{id}', [AdminInsightController::class, 'update'])->name('admin.insight.update');
    Route::put('/admin/insight', [AdminInsightController::class, 'updateHeading'])->name('admin.insight.updateHeading');
    Route::delete('/admin/insight/{id}', [AdminInsightController::class, 'destroy'])->name('admin.insight.destroy');

    Route::get('/admin/contact', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/admin/contact/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::put('/admin/contact/{id}', [AdminContactController::class, 'update'])->name('admin.contacts.update');

    Route::get('/admin/config', [AdminConfigController::class, 'index'])->name('admin.config.index');
    Route::post('/admin/config', [AdminConfigController::class, 'store'])->name('admin.config.store');
    Route::post('/admin/config/social-media', [AdminConfigController::class, 'storeSocialMedia'])->name('admin.config.storeSocialMedia');
    Route::put('/admin/config/social-media/{id}', [AdminConfigController::class, 'updateSocialMedia'])->name('admin.config.updateSocialMedia');
    Route::delete('/admin/config/{id}', [AdminConfigController::class, 'destroy'])->name('admin.config.destroy');
});
