<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerCategory;
use App\Http\Controllers\BrandController;
use App\Models\User;
use Illuminate\Support\Facades\DB;


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

Route::get('/category/all', [ControllerCategory::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [ControllerCategory::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [ControllerCategory::class, 'Edit']);
Route::post('/category/update/{id}', [ControllerCategory::class, 'Update']);
Route::get('/softdelete/category/{id}', [ControllerCategory::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [ControllerCategory::class, 'Restore']);
Route::get('/category/pdelete/{id}', [ControllerCategory::class, 'pdelete']);

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/store', [BrandController::class, 'StoreBrand'])->name('store.brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
