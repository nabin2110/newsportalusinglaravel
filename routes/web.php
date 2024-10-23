<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\TagController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('/backend/')->group(function(){
        // category route from here
            Route::get('category/sort',[CategoryController::class,'sort'])->name('backend.categories.sort');
            Route::resource('category',CategoryController::class)->names('backend.categories');#

            //tag route from here
            Route::resource('tag',TagController::class)->names('backend.tags');
    });
});

require __DIR__.'/auth.php';
