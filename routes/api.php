<?php
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('post/index',[PostsController::class, 'index'])->name('index');
Route::post('post/store',[PostsController::class, 'store'])->name('store');
Route::get('post/edit/{id}',[PostsController::class, 'show'])->name('show');
Route::post('post/update/{id}',[PostsController::class, 'update'])->name('update');
Route::post('post/delete/{id}',[PostsController::class, 'destroy'])->name('destroy');
