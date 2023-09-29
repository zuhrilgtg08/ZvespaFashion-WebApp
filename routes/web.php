<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Data\VespaController;
use App\Http\Controllers\Data\GaleriController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Data\KaryawanController;
use App\Http\Controllers\Data\DashboardController;
use App\Http\Controllers\Data\CategoriesController;
use App\Http\Controllers\Data\TestimonialController;
use App\Http\Controllers\Data\SpecificationController;
use App\Http\Controllers\Data\ManageKaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Root Access
Route::get('/', function () {
    return redirect('/home');
});

// Routes Admin Dashboard Data
Route::get('/admin/manage_dashboard', [DashboardController::class, 'index'])->middleware('admin');
Route::name('admin.')->prefix('manage_dashboard')->middleware('admin')->group(function() {
    Route::resource('manage_karyawan', ManageKaryawanController::class);
    Route::resource('kategori', CategoriesController::class);
    Route::resource('vespa', VespaController::class);
    Route::resource('spesifikasi', SpecificationController::class);
    Route::get('/setting/account/{users:email}', [DashboardController::class, 'setting'])->name('setting');
    Route::put('/setting/account/update/{id}', [DashboardController::class, 'updateData'])->name('setting.update');
    Route::put('/setting/account/updatePassword/{id}', [DashboardController::class, 'updatePassword'])->name('update.password');
    Route::get('/source/testimoni', [TestimonialController::class, 'index'])->name('testimoni.index');
    Route::get('/source/testimoni/detail/{uuid}', [TestimonialController::class, 'detail'])->name('testimoni.detail');
    Route::delete('/source/testimoni/destroy/{testimonial:id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
});
Route::get('/admin/manage_dashboard/kategori/checkSlug', [CategoriesController::class, 'checkSlug'])->middleware('admin');
Route::get('/admin/manage_dashboard/city/{id}', [ManageKaryawanController::class, 'chooseCity'])->middleware('admin');

// Routes Karyawan Dashboard Data
Route::get('/karyawan/manage_data', [KaryawanController::class, 'index'])->middleware('karyawan');
Route::name('karyawan.')->prefix('manage_data')->middleware(['karyawan'])->group(function() {
    Route::resource('/web_builder/galeri', GaleriController::class);
});

// Auth Routes 
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

// Root Default
Route::get('/home', [HomeController::class, 'index'])->name('home');
