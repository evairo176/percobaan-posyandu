<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\GeografiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KepengurusanController;
use App\Http\Controllers\PembentukanController;
use App\Http\Controllers\PerkembanganController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RekapPosyanduControler;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\SkdnController;
use App\Http\Controllers\StrataController;
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
    Route::get('/posyandu/cetak-pdf/{id}', [RekapPosyanduControler::class, 'cetakPdf'])->name('posyandu.cetakPdf');
    Route::get('/posyandu/detail-all/', [RekapPosyanduControler::class, 'detailAll'])->name('posyandu.detailAll');

    Route::get('/posyandu/getdesa', [RekapPosyanduControler::class, 'getDesa']);
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
    Route::post('/kepengurusan/store', [KepengurusanController::class, 'store'])->name('kepengurusan.store');
    Route::get('/kepengurusan/fetch-all', [KepengurusanController::class, 'fetchAll'])->name('kepengurusan.fetch');
    Route::post('/kepengurusan/edit', [KepengurusanController::class, 'edit'])->name('kepengurusan.edit');

    Route::get('/sarana', [SaranaController::class, 'index'])->name('sarana');
    Route::post('/sarana/store', [SaranaController::class, 'store'])->name('sarana.store');
    Route::get('/sarana/fetch-all', [SaranaController::class, 'fetchAll'])->name('sarana.fetch');
    Route::post('/sarana/edit', [SaranaController::class, 'edit'])->name('sarana.edit');

    Route::get('/strata', [StrataController::class, 'index'])->name('strata');
    Route::post('/strata/store', [StrataController::class, 'store'])->name('strata.store');
    Route::get('/strata/fetch-all', [StrataController::class, 'fetchAll'])->name('strata.fetch');
    Route::post('/strata/edit', [StrataController::class, 'edit'])->name('strata.edit');

    Route::get('/kader', [KaderController::class, 'index'])->name('kader');
    Route::post('/kader/store', [KaderController::class, 'store'])->name('kader.store');
    Route::get('/kader/fetch-all', [KaderController::class, 'fetchAll'])->name('kader.fetch');
    Route::post('/kader/edit', [KaderController::class, 'edit'])->name('kader.edit');

    Route::get('/skdn', [SkdnController::class, 'index'])->name('skdn');
    Route::post('/skdn/store', [SkdnController::class, 'store'])->name('skdn.store');
    Route::get('/skdn/fetch-all', [SkdnController::class, 'fetchAll'])->name('skdn.fetch');
    Route::post('/skdn/edit', [SkdnController::class, 'edit'])->name('skdn.edit');

    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/fetch-all', [KegiatanController::class, 'fetchAll'])->name('kegiatan.fetch');
    Route::post('/kegiatan/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');

    Route::get('/program', [ProgramController::class, 'index'])->name('program');
    Route::post('/program/store', [ProgramController::class, 'store'])->name('program.store');
    Route::get('/program/fetch-all', [ProgramController::class, 'fetchAll'])->name('program.fetch');
    Route::post('/program/edit', [ProgramController::class, 'edit'])->name('program.edit');

    Route::get('/perkembangan', [PerkembanganController::class, 'index'])->name('perkembangan');
    Route::post('/perkembangan/store', [PerkembanganController::class, 'store'])->name('perkembangan.store');
    Route::get('/perkembangan/fetch-all', [PerkembanganController::class, 'fetchAll'])->name('perkembangan.fetch');
    Route::post('/perkembangan/edit', [PerkembanganController::class, 'edit'])->name('perkembangan.edit');
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

    Route::get('/posyandu/cetak-pdf-all/', [RekapPosyanduControler::class, 'cetakPdfAll'])->name('posyandu.cetakPdfAll');
    Route::delete('/posyandu/delete', [RekapPosyanduControler::class, 'delete'])->name('posyandu.delete');
});
