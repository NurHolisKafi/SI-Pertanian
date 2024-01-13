<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanTanamController;
use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KebutuhanTanamController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\UserController;
use App\Models\Tanaman;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about']);
Route::get('/news', [HomeController::class, 'news']);
Route::get('/budidaya', [HomeController::class, 'budidaya']);
// Route::get('/hpt', [HomeController::class, 'hpt']);
Route::get('/news/{id}/d', [HomeController::class, 'news_detail'])->name('news.detail');
Route::get('/budidaya/{id}/d', [HomeController::class, 'budidaya_detail'])->name('budidaya.detail');
// Route::get('/hpt/{id}/d', [HomeController::class, 'hpt_detail'])->name('hpt.detail');
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/logout', [AuthController::class, 'Logout']);


Route::middleware(['guest', 'guest:admin'])->group(function () {
    Route::get('/login/', [HomeController::class, 'login_umum'])->name('login');
    Route::get('/admin/l', [AdminController::class, 'Login']);
    Route::get('/register', [HomeController::class, 'register_umum']);
    Route::post('/register/store', [UserController::class, 'store_register_umum'])->name('store');
    Route::post('/auth/u', [AuthController::class, 'AuthLogin'])->name('auth');
    Route::post('/auth/ad', [AuthController::class, 'AuthLoginAdmin'])->name('auth.admin');
    // Route::post('/auth/p', [AuthController::class, 'AuthLoginPetani'])->name('auth.petani');
    // Route::get('/login/p', [HomeController::class, 'login_petani'])->name('login.petani');
    // Route::get('/register/p', [HomeController::class, 'register_petani']);
    // Route::post('/register/p/store', [UserController::class, 'store_register_petani'])->name('store.petani');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/kalkulator', [UserController::class, 'kalkulator_panen']);
    Route::get('/{id}/kebutuhan', [UserController::class, 'KebutuhanTanam']);
    Route::post('/store/tanam', [UserController::class, 'store_perhitungan_tanam']);
    Route::get('/perhitungan/{id}/d', [UserController::class, 'remove_perhitungan']);
    // Route::group(['prefix' => 'umum', 'middleware' => 'cekrole:umum'], function () {
    //     // Route::get('/chat', [ChatController::class, 'umum']);
    // });

    // Route::group(['prefix' => 'petani', 'middleware' => 'cekrole:petani'], function () {
    //     Route::get('/profile', [UserController::class, 'profile_petani']);
    //     // Route::get('/chat', [ChatController::class, 'petani']);
    // });

    Route::post('/store/i', [UserController::class, 'update_profileImage'])->name('store.img');
    Route::post('/store/pi', [UserController::class, 'update_profileInformation'])->name('store.information');
    Route::post('/delete/i', [UserController::class, 'remove_profileImage'])->name('delete.img');
    Route::post('/pass/u', [UserController::class, 'update_password'])->name('update.password');
});

Route::middleware('auth:admin')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('news', NewsController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('tanaman', TanamanController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('kebutuhantanam', KebutuhanTanamController::class)->except('show');
        Route::resource('bahan', BahanTanamController::class);
        Route::resource('budidaya', BudidayaController::class);
        Route::get('dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
        Route::get('umum', [AdminController::class, 'ViewUserUmum']);
        Route::get('petani', [AdminController::class, 'ViewUserPetani']);
        Route::put('/user/u', [AdminController::class, 'updatePassUser'])->name('update.user');
        Route::delete('/user/{id}/d', [AdminController::class, 'deleteUser'])->name('delete.user');
    });
});
Route::get('user/{id}/data', [AdminController::class, 'getDataUser'])->name('user.data');
Route::get('/user/{name}/image/', [UserController::class, 'view_image'])->name('view.image');
Route::get('/news/{name}/image/', [NewsController::class, 'show_thumbnail'])->name('news.image');
Route::get('/tanaman/{name}/image/', [BudidayaController::class, 'show_thumbnail'])->name('tanaman.image');
Route::get('/lahan/min/{name}', [UserController::class, 'minLuasLahan']);
Route::get('tanaman/kebutuhan/{id}', [KebutuhanTanamController::class, 'getDataKebutuhan']);


// Route::get('/test/{users}/{tanaman}', [UserController::class, 'test']);
Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');
Route::get('/bot', function () {
    return view('page.bot');
});
