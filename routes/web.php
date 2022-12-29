<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Seashell;

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

Route::get('/', function () {
    $query = Seashell::all();
    return view('users', compact('query'));
})->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/admin_logout', [AdminController::class, 'logout'])->name('admin_logout');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/export-users', [AdminController::class, 'exportUsers'])->name('export');
    Route::delete('/delete' , [AdminController::class, 'delete'])->name('delete');
});

Route::get('/dashboard', function () {
    $query = Seashell::all();
    return view('users', compact('query'));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
