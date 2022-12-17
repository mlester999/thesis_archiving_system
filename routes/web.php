<?php

use App\Models\User;
use App\Models\Archive;
use App\Models\FrontPageSlider;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Permission;
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
    if(Auth::guard('admin')->user()) {
        return redirect()->route('admin.dashboard');
    } else if(Auth::user()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }
});

// User Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/projects', 'Projects')->middleware(['auth', 'verified', 'permission:View Thesis'])->name('projects');
    Route::post('/projects/views', 'ProjectsViews')->middleware(['auth', 'verified', 'permission:View Thesis'])->name('projects.views');

    Route::get('/submit', 'SubmitThesis')->middleware(['auth', 'verified', 'role:Graduating Students (Pending Thesis)', 'permission:View Submission of Thesis|Submit Thesis'])->name('submit');
    Route::post('/download/thesis/{id}', 'DownloadThesis')->middleware(['auth', 'verified'])->name('download.thesis');
    Route::post('/download/imrad/{id}', 'DownloadImrad')->middleware(['auth', 'verified'])->name('download.imrad');
    Route::post('/store/thesis', 'StoreThesis')->middleware(['auth', 'verified', 'role:Graduating Students (Pending Thesis)', 'permission:View Submission of Thesis|Submit Thesis'])->name('store.thesis');

    Route::get('/about', 'About')->middleware(['auth', 'verified'])->name('about');
    Route::get('/profile', 'Profile')->middleware(['auth', 'verified'])->name('profile');
    Route::get('/edit/profile', 'EditProfile')->middleware(['auth', 'verified'])->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->middleware(['auth', 'verified'])->name('store.profile');

    Route::get('/archives', 'ArchivesList')->middleware(['auth', 'verified'])->name('archives');
    Route::get('/view/archives/{id}', 'ViewArchives')->middleware(['auth', 'verified'])->name('view.archives');
    Route::get('/edit/archives/{id}', 'EditArchives')->middleware(['auth', 'verified', 'permission:Edit Submitted Thesis'])->name('edit.archives');
    Route::post('/update/archives/{id}', 'UpdateArchives')->middleware(['auth', 'verified'])->name('update.archives');

    Route::get('/change/password', 'ChangePassword')->middleware(['auth', 'verified'])->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->middleware(['auth', 'verified'])->name('update.password');

    Route::get('/department/{dept}', 'CollegeDepartments')->middleware(['auth', 'verified', 'permission:View Thesis'])->name('department');
    Route::get('/view/department/{dept}/{id}', 'ViewCollegeDepartments')->middleware(['auth', 'verified', 'permission:View Thesis'])->name('view.department');
    Route::post('/bookmark/department/{id}', 'BookmarkDepartment')->middleware(['auth', 'verified', 'permission:View Thesis|Bookmark Thesis'])->name('bookmark.department');

    Route::get('/bookmarks', 'BookmarksList')->middleware(['auth', 'verified'])->name('bookmarks.list');

});

// Student Home Interface
Route::get('/home', function () {
    $sliders = FrontPageSlider::all()->where('status', 1);

    return view('home', ["currentPage" => 'home'], compact('sliders'));
})->middleware(['auth', 'verified'])->name('home');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth:admin', 'verified', 'prevent-back-history'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // Auth::routes();

    Route::get('profile', [AdminController::class, 'Profile'])->middleware(['custom_verify'])->name('profile');
    Route::get('edit/profile', [AdminController::class, 'EditProfile'])->middleware(['custom_verify'])->name('edit.profile');
    Route::post('store/profile', [AdminController::class, 'StoreProfile'])->middleware(['custom_verify'])->name('store.profile');

    Route::get('change/password', [AdminController::class, 'ChangePassword'])->middleware(['custom_verify'])->name('change.password');
    Route::post('update/password', [AdminController::class, 'UpdatePassword'])->middleware(['custom_verify'])->name('update.password');

    Route::get('view/archive-list/{id}', [AdminController::class, 'ViewArchives'])->middleware(['permission:Archive List'])->name('view.archive-list');

});

Route::get('/admin/dashboard', function () {
    $uploadedArchive = Archive::orderBy('created_at', 'desc')->paginate(5);

    return view('admin.index')->with('archives', $uploadedArchive);
})->middleware(['auth:admin', 'custom_verify'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
