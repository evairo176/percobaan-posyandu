<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\GeografiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KepengurusanController;
use App\Http\Controllers\PembentukanController;
use App\Http\Controllers\RekapPosyanduControler;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Models\Kepengurusan;
use App\Models\Website;
use Illuminate\Support\Facades\Route;

/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/cetak-pdf/{id_data}', [HomeController::class, 'cetakpdf']);




route::group(['middleware' => ['guest']], function () {

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register']);
    Route::get('/forgot', [UserController::class, 'forgot']);
    Route::get('/reset', [UserController::class, 'reset']);

    Route::post('/register', [UserController::class, 'saveUser'])->name('auth.register');
    Route::post('/login', [UserController::class, 'loginUser'])->name('auth.login');
});


route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('auth.profile');
    Route::post('/profile-image', [UserController::class, 'profileImageUpdate'])->name('auth.profile-image-update');
    Route::post('/profile-update', [UserController::class, 'profileUpdate'])->name('auth.profile-update');

    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/posyandu', [RekapPosyanduControler::class, 'index'])->name('posyandu');
    Route::post('/posyandu/store', [RekapPosyanduControler::class, 'store'])->name('posyandu.store');
    Route::get('/posyandu/fetch-all', [RekapPosyanduControler::class, 'fetchAll'])->name('posyandu.fetch');
    Route::post('/posyandu/edit', [RekapPosyanduControler::class, 'edit'])->name('posyandu.edit');
    Route::delete('/posyandu/delete', [RekapPosyanduControler::class, 'delete'])->name('posyandu.delete');
    Route::get('/posyandu/detail/{id}', [RekapPosyanduControler::class, 'detail'])->name('posyandu.detail');
});
route::group(['middleware' => ['auth', 'login_check:petugas']], function () {


    Route::get('/kuis-petugas', [DashboardController::class, 'kuispetugas']);
    Route::post('/get-data-kuis', [DashboardController::class, 'getdatakuis']);
    Route::post('/simpan-kuis', [DashboardController::class, 'simpankuis']);
    Route::post('/list-kuis', [DashboardController::class, 'listkuis']);
    Route::post('/kuis-hpus', [DashboardController::class, 'kuishpus']);



    Route::get('/geografi', [GeografiController::class, 'index'])->name('geografi');
    Route::post('/geografi/store', [GeografiController::class, 'store'])->name('geografi.store');
    Route::get('/geografi/fetch-all', [GeografiController::class, 'fetchAll'])->name('geografi.fetch');
    Route::post('/geografi/edit', [GeografiController::class, 'edit'])->name('geografi.edit');


    Route::get('/demografi', [DemografiController::class, 'index'])->name('demografi');
    Route::post('/demografi/store', [DemografiController::class, 'store'])->name('demografi.store');
    Route::get('/demografi/fetch-all', [DemografiController::class, 'fetchAll'])->name('demografi.fetch');
    Route::post('/demografi/edit', [DemografiController::class, 'edit'])->name('demografi.edit');



    Route::get('/pembentukan', [PembentukanController::class, 'index'])->name('pembentukan');
    Route::post('/pembentukan/store', [PembentukanController::class, 'store'])->name('pembentukan.store');
    Route::get('/pembentukan/fetch-all', [PembentukanController::class, 'fetchAll'])->name('pembentukan.fetch');
    Route::post('/pembentukan/edit', [PembentukanController::class, 'edit'])->name('pembentukan.edit');

    Route::get('/kepengurusan', [KepengurusanController::class, 'index'])->name('kepengurusan');
    Route::post('/kepengurusan/store', [KepengurusanController::class, 'store'])->name('pembekepengurusanntukan.store');
    Route::get('/kepengurusan/fetch-all', [KepengurusanController::class, 'fetchAll'])->name('kepengurusan.fetch');
    Route::post('/kepengurusan/edit', [KepengurusanController::class, 'edit'])->name('kepengurusan.edit');
    // Route::post('/geografi-update', [RekapPosyanduControler::class, 'geografiUpdate'])->name('geografi-update');
});

route::group(['middleware' => ['auth', 'login_check:super-admin']], function () {


    Route::get('/user', [DataUserController::class, 'index'])->name('user.index');
    Route::post('/user/store', [DataUserController::class, 'store'])->name('user.store');
    Route::get('/user/fetch-all', [DataUserController::class, 'fetchAll'])->name('user.fetch');
    Route::post('/user/edit', [DataUserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/delete', [DataUserController::class, 'delete'])->name('user.delete');
    Route::post('/user/detail', [DataUserController::class, 'detail'])->name('user.detail');



    Route::get('/website', [WebsiteController::class, 'index'])->name('website');
    Route::post('/website-image', [WebsiteController::class, 'websiteImageUpdate']);
    Route::post('/website-update', [WebsiteController::class, 'websiteUpdate']);
});
