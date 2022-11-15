<?php

use App\Http\Controllers\Admin\LinksController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    $links = Auth::user()->getLike()->get();
    return view('dashboard', compact('links'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('links', LinksController::class)->
    except(['show', 'destroy', 'edit', 'update']);

});


require __DIR__ . '/auth.php';
