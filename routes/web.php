<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Data\EventController;
use App\Http\Controllers\Data\VespaController;
use App\Http\Controllers\Data\GaleriController;
use App\Http\Controllers\Data\ArticelController;
use App\Http\Controllers\Data\ProfileController;
use App\Http\Controllers\FrontPopularController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Data\DashboardController;
use App\Http\Controllers\Data\PortfolioController;
use App\Http\Controllers\Data\CategoriesController;
use App\Http\Controllers\Data\TestimonialController;
use App\Http\Controllers\Data\SpecificationController;
use App\Http\Controllers\Data\ManageKaryawanController;
use App\Http\Controllers\Data\DashboardKaryawanController;
use App\Http\Controllers\FrontArticelController;
use App\Http\Controllers\FrontEventsController;
use App\Http\Controllers\FrontPortofolioController;
// ONly About Routes 
use App\Models\Web_Builder\Galeri;
use App\Models\Web_Builder\Profile;

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

// Root First Access
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
Route::get('/karyawan/manage_data', [DashboardKaryawanController::class, 'index'])->middleware('karyawan');
Route::name('karyawan.')->prefix('manage_data')->middleware(['karyawan'])->group(function() {
    Route::resource('/web_builder/galeri', GaleriController::class)->except('show');
    Route::get('/web_builder/profile/form/{id}', [ProfileController::class, 'form'])->name('profile.form');
    Route::post('/web_builder/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::put('/web/builder/profile/update/{id}', [ProfileController::class, 'updateProfiles'])->name('update.form');
    Route::resource('/articel', ArticelController::class)->except('show');
    Route::resource('/event', EventController::class)->except('show');
    Route::resource('/portofolio', PortfolioController::class)->except('show');
});
Route::get('/karyawan/manage_data/articel/checkSlug', [ArticelController::class, 'checkSlug'])->middleware('karyawan');
Route::get('/karyawan/manage_data/event/checkSlug', [EventController::class, 'checkSlug'])->middleware('karyawan');
Route::get('/karyawan/manage_data/portofolio/checkSlug', [PortfolioController::class, 'checkSlug'])->middleware('karyawan');

// Authenticate Routes 
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

// Default Routes Content for Front View
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', function(){
    return view('pages.users.about', [
        'data_about' =>  Profile::latest()->first(),
        'data_galeri' => Galeri::latest()->get(),
    ]);
});
Route::get('/visiMisi', function(){
    return view('pages.users.visiMisi', [
        'data_visi_misi' => Profile::latest()->first(),
    ]);
});
Route::resource('/popular', FrontPopularController::class)->except(['create', 'store', 'edit', 'show', 'update', 'destroy'])->middleware('auth');
Route::get('/eventsCompany', [FrontEventsController::class, 'index'])->middleware('auth');
Route::get('/eventsCompany/detail/{slug}', [FrontEventsController::class, 'show'])->middleware('auth');
Route::get('/portofolioCompany', [FrontPortofolioController::class, 'index'])->middleware('auth');
Route::get('/portofolioCompany/detail/{slug}', [FrontPortofolioController::class, 'show'])->middleware('auth');
Route::resource('/articelCompany', FrontArticelController::class)->middleware('auth');
Route::get('/detailProduk/{products_vespa:uuid}', [HomeController::class, 'detail'])->name('detail.produk')->middleware('auth');