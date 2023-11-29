<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdiController;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// metode nya get lalu masukkan namespace AuthController
// attribute name merupakan penamaan dari route yang kita buat
// kita tinggal panggil fungsi route(name) pada layout atau controller
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan user biasa maka akan diarahkan ke UserController
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });

    Route::get('prodi', [ProdiController::class, 'index']);

    Route::get('/prodi/all-join-facade', [ProdiController::class, 'allJoinFacade']);
    Route::get('/prodi/all-join-elq', [ProdiController::class, 'allJoinElq']);

    Route::get('/prodi/create', [ProdiController::class,'create'])->name('prodi.create');

    Route::post('prodi/store', [ProdiController::class,'store']);

    Route::get('/prodi', [ProdiController::class,'index'])->name('prodi.index');

    Route::get('/prodi/{prodi}', [ProdiController::class,'show'])->name('prodi.show');

    Route::get('/prodi/{prodi}/edit', [ProdiController::class,'edit'])->name('prodi.edit');

    Route::patch('/prodi/{prodi}', [ProdiController::class,'update'])->name('prodi.update');

    Route::delete('/prodi/{prodi}', [ProdiController::class,'destroy'])->name('prodi.destroy');
});
