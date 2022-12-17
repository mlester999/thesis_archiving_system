<?php

use Illuminate\Support\Facades\Auth;
use App\Models\ResearchAgenda;
use App\Http\Livewire\Settings;
use App\Http\Livewire\UserList;
use App\Http\Livewire\AccessList;
use App\Http\Livewire\ReportLogs;
use App\Http\Livewire\ArchiveList;
use App\Http\Livewire\StudentList;
use App\Http\Livewire\ActivityLogs;
use App\Http\Livewire\DownloadLogs;
use App\Http\Livewire\CurriculumList;
use App\Http\Livewire\DepartmentList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResearchAgendas;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // Auth::routes();

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
    
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // Auth::routes();

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed:admin', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('settings', Settings::class)->middleware(['permission:Settings'])->name('settings');

    Route::get('user-list', UserList::class)->middleware(['permission:Admin Users List'])->name('user-list');

    Route::get('student-list', StudentList::class)->middleware(['permission:Student List'])->name('student-list');

    Route::get('curriculum-list', CurriculumList::class)->middleware(['permission:Program List'])->name('curriculum-list');

    Route::get('department-list', DepartmentList::class)->middleware(['permission:College List'])->name('department-list');

    Route::get('archive-list', ArchiveList::class)->middleware(['permission:Archive List'])->name('archive-list');

    Route::get('access-list', AccessList::class)->middleware(['permission:Access List'])->name('access-list');

    Route::get('research-agendas', ResearchAgendas::class)->middleware(['permission:Research Agenda List'])->name('research-agendas');

    Route::get('activity-logs', ActivityLogs::class)->middleware(['permission:Activity Logs'])->name('activity-logs');

    Route::get('report-logs', ReportLogs::class)->middleware(['permission:Report Logs'])->name('report-logs');

    Route::get('download-logs', DownloadLogs::class)->middleware(['permission:Download Logs'])->name('download-logs');
});
