<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\CategorieController;
use App\Http\Livewire\Admin\Users\ListUsers;

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
    return view('welcome');
});


Route::get('admin/dashboard', [DashbordController::class, 'index'])->name('admin.dashboard');
Route::get('admin/users', ListUsers::class)->name('admin.users');

Route::get('/prods-cat', [CategorieController::class, 'prods'])->name('prods_cat');
Route::get('/cat-prods', [CategorieController::class, 'cat'])->name('cat_prods');


Route::resource('categorie', CategorieController::class);
Route::resource('produit', ProduitController::class);
Route::resource('commande', CommandeController::class);
