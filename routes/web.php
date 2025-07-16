<?php

use Illuminate\Support\Facades\Route;

//login
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;

//backend
use App\Http\Controllers\backend\BeritabackController;
use App\Http\Controllers\backend\CarouselController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\TentangController;
use App\Http\Controllers\backend\BidangController;
use App\Http\Controllers\backend\JabatanController;
use App\Http\Controllers\backend\PegawaiController;
use App\Http\Controllers\backend\DokumenController;
use App\Http\Controllers\backend\LokasiInternetController;
use App\Http\Controllers\backend\MaklumatController;
use App\Http\Controllers\backend\GaleriController;
use App\Http\Controllers\backend\KontakController;
use App\Http\Controllers\backend\LogoController;
use App\Http\Controllers\backend\PengumumanbackController;
use App\Http\Controllers\backend\VideoController;
use App\Http\Controllers\backend\LayananController;

//frontend
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\TentangfrontController;

use App\Http\Controllers\frontend\BeritaController;
use App\Http\Controllers\frontend\PengumumanController;
use App\Http\Controllers\frontend\PetaController;

// Route::get('/', function () {
//     return view('welcome');
// });

//login
Route::middleware('guest')->group(function () {
    //Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    // Forgot password
    Route::get('/password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset password
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//frontend
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang', [TentangfrontController::class, 'index'])->name('frontend.tentang');


Route::get('/berita', [BeritaController::class, 'index'])->name('lihat-berita');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('lihat-pengumuman');
Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');


//backend
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    Route::resource('/logo', LogoController::class);

    Route::resource('/carousel', CarouselController::class);

    Route::resource('/berita', BeritabackController::class);

    Route::resource('/pengumuman', PengumumanbackController::class);

    Route::resource('/galeri', GaleriController::class);

    Route::resource('/video', VideoController::class);

    Route::resource('/kontak', KontakController::class);

    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::resource('/tentang', TentangController::class);

    Route::resource('/maklumat', MaklumatController::class);

    Route::resource('/bidang', BidangController::class);

    Route::resource('/pegawai', PegawaiController::class);
  
    Route::resource('/jabatan', JabatanController::class);
    
    Route::resource('/dokumen', DokumenController::class);
    Route::get('/dokumen/download/{id}', [DokumenController::class, 'download'])->name('dokumen.download');

    Route::resource('/lokasi', LokasiInternetController::class);
    Route::post('lokasi-import', [LokasiInternetController::class,'import'])->name('lokasi.import');
    
    Route::resource('/layanan', LayananController::class);

});