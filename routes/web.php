<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\Archive;

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

Route::get('test', function() {
    Storage::disk('google')->put('testingkalaks.txt', 'Hello World');
    dd('done');
});

Route::get('/', function () {
    return view('welcome');
});

// User Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/logout', 'destroy')->middleware(['auth', 'verified'])->name('logout');
    Route::get('/projects', 'Projects')->middleware(['auth', 'verified'])->name('projects');
    Route::get('/view/project/{id}', 'ViewProject')->middleware(['auth', 'verified'])->name('view.project');
    Route::get('/edit/project/{id}', 'EditProject')->middleware(['auth', 'verified'])->name('edit.project');
    Route::post('/update/project/{id}', 'UpdateProject')->middleware(['auth', 'verified'])->name('update.project');

    Route::get('/submit', 'SubmitThesis')->middleware(['auth', 'verified'])->name('submit');
    Route::post('/store/thesis', 'StoreThesis')->middleware(['auth', 'verified'])->name('store.thesis');

    Route::get('/about', 'About')->middleware(['auth', 'verified'])->name('about');
    Route::get('/profile', 'Profile')->middleware(['auth', 'verified'])->name('profile');
    Route::get('/edit/profile', 'EditProfile')->middleware(['auth', 'verified'])->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->middleware(['auth', 'verified'])->name('store.profile');

    Route::get('/archives', 'ArchivesList')->middleware(['auth', 'verified'])->name('archives');
    Route::get('/view/archives/{id}', 'ViewArchives')->middleware(['auth', 'verified'])->name('view.archives');
    Route::get('/edit/archives/{id}', 'EditArchives')->middleware(['auth', 'verified'])->name('edit.archives');
    Route::post('/update/archives/{id}', 'UpdateArchives')->middleware(['auth', 'verified'])->name('update.archives');

    Route::get('/change/password', 'ChangePassword')->middleware(['auth', 'verified'])->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->middleware(['auth', 'verified'])->name('update.password');

    Route::get('/department/{dept}', 'CollegeDepartments')->middleware(['auth', 'verified'])->name('department');
    Route::get('/view/department/{dept}/{id}', 'ViewCollegeDepartments')->middleware(['auth', 'verified'])->name('view.department');

});

Route::get('/dashboard', function () {
    return view('home', ["currentPage" => 'home']);
})->middleware(['auth', 'verified'])->name('home');

require __DIR__.'/auth.php';

// Admin Routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->middleware(['auth:admin', 'custom_verify'])->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->middleware(['auth:admin', 'custom_verify'])->name('admin.profile');
    Route::get('/admin/edit/profile', 'EditProfile')->middleware(['auth:admin', 'custom_verify'])->name('admin.edit.profile');
    Route::post('/admin/store/profile', 'StoreProfile')->middleware(['auth:admin', 'custom_verify'])->name('admin.store.profile');

    Route::get('/admin/change/password', 'ChangePassword')->middleware(['auth:admin', 'custom_verify'])->name('admin.change.password');
    Route::post('/admin/update/password', 'UpdatePassword')->middleware(['auth:admin', 'custom_verify'])->name('admin.update.password');

    Route::get('/admin/view/archive-list/{id}', 'ViewArchives')->middleware(['auth:admin', 'verified'])->name('admin.view.archive-list');

    Route::get('/admin/user/list', 'UserList')->middleware(['auth:admin', 'custom_verify'])->name('admin.user.list');
    Route::post('/admin/user/register', 'RegisterUser')->middleware(['auth:admin', 'custom_verify'])->name('admin.user.register');
});

Route::get('/admin/dashboard', function () {
    $uploadedArchive = Archive::orderBy('created_at', 'desc')->paginate(5);

    return view('admin.index',compact('uploadedArchive'));
})->middleware(['auth:admin', 'custom_verify'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
