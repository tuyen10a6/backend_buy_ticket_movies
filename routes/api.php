<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => true,
        'response' => 'Hello World'
    ]);
});

Route::get('/danhmuc', [\App\Http\Controllers\Api\DanhMucController::class, 'getDanhMuc']);
Route::get('/rap_phim', [\App\Http\Controllers\Api\RapPhimController::class, 'getRapPhim']);
Route::get('/phim', [\App\Http\Controllers\Api\PhimController::class, 'getPhim']);
Route::get('/search_phim', [\App\Http\Controllers\Api\PhimController::class, 'searchPhim']);
Route::get('/getPhimByDanhMuc/{id}', [\App\Http\Controllers\Api\PhimController::class, 'getPhimByDanhMuc']);
Route::get('/getLichChieu', [\App\Http\Controllers\Api\LichChieuController::class, 'getLichChieu']);
Route::get('/getDatVe', [\App\Http\Controllers\Api\DatVeController::class, 'getDatVe']);
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->middleware(['cors']);;
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['cors']);;
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware(['cors']);;
    Route::post('me', [AuthController::class, 'me']);
});
Route::group(['middleware' => 'admin.auth'], function () {
    // Danh Mục
    Route::post('addDanhMuc', [\App\Http\Controllers\Api\DanhMucController::class, 'addDanhMuc']);
    Route::post('updateDanhMuc/{id}', [\App\Http\Controllers\Api\DanhMucController::class, 'updateDanhMuc']);
    Route::delete('deleteDanhMuc/{id}', [\App\Http\Controllers\Api\DanhMucController::class, 'deleteDanhMuc']);
    // Rạp phim
    Route::post('addRapPhim', [\App\Http\Controllers\Api\RapPhimController::class, 'addRapPhim']);
    Route::post('updateRapPhim/{id}', [\App\Http\Controllers\Api\RapPhimController::class, 'updateRapPhim']);
    Route::delete('deleteRapPhim/{id}', [\App\Http\Controllers\Api\RapPhimController::class, 'deleteRapPhim']);
    // Phim
    Route::post('addPhim', [\App\Http\Controllers\Api\PhimController::class, 'addPhim']);
    Route::post('updatePhim/{id}', [\App\Http\Controllers\Api\PhimController::class, 'updatePhim']);
    Route::delete('deletePhim/{id}', [\App\Http\Controllers\Api\PhimController::class, 'deletePhim']);
    //Lịch chiếu
    Route::post('addLichChieu', [\App\Http\Controllers\Api\LichChieuController::class, 'addLichChieu']);
    Route::post('updateLichChieu/{id}', [\App\Http\Controllers\Api\LichChieuController::class, 'updateLichChieu']);
    Route::delete('deleteLichChieu/{id}', [\App\Http\Controllers\Api\LichChieuController::class, 'deleteLichChieu']);
    // Đặt vé
    Route::post('addDatVe', [\App\Http\Controllers\Api\DatVeController::class, 'addDatVe']);
    Route::post('updateDatVe/{id}', [\App\Http\Controllers\Api\DatVeController::class, 'updateDatVe']);
    Route::delete('deleteDatVe/{id}', [\App\Http\Controllers\Api\DatVeController::class, 'deleteDatVe']);
});
