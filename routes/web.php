<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

// User Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/projects', 'Projects')->name('projects');
    Route::get('/submit', 'SubmitThesis')->name('submit');
    Route::get('/about', 'About')->name('about');
    Route::get('/profile', 'Profile')->name('profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

    Route::get('/department/cce', 'DeptCCE')->name('department.cce');
});

Route::get('/dashboard', function () {
    return view('home', ["currentPage" => 'home']);
})->middleware(['auth', 'verified'])->name('home');

require __DIR__.'/auth.php';

// Admin Routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/admin/edit/profile', 'EditProfile')->name('admin.edit.profile');
    Route::post('/admin/store/profile', 'StoreProfile')->name('admin.store.profile');

    Route::get('/admin/change/password', 'ChangePassword')->name('admin.change.password');
    Route::post('/admin/update/password', 'UpdatePassword')->name('admin.update.password');

    Route::get('/admin/user/list', 'UserList')->name('admin.user.list');
    Route::post('/admin/user/register', 'RegisterUser')->name('admin.user.register');
});

Route::get('/admin/dashboard', function () {
    return view('admin.index');
})->middleware(['auth:admin', 'custom_verify'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
