<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileSearchController;

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

Route::get('/directory/{path?}', [FileSearchController::class, 'showDirectoryContent'])->name('directory.content');
Route::get('/file/{filePath}', [FileSearchController::class, 'serveFile'])->where('filePath', '.*')->name('file.serve');
