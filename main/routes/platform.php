<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Platform\Admin\ConfreresController;
use App\Http\Controllers\Platform\Admin\DashboardController;
use App\Http\Controllers\Platform\Admin\FilesController;
use App\Http\Controllers\Platform\User\PatientsController;
use App\Http\Controllers\Platform\Admin\PatientsController as PatientsAdminController;
use App\Http\Controllers\Platform\User\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\User\MessageController;
use App\Http\Controllers\Platform\User\GroupController;
use App\Http\Controllers\Platform\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Platform\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Platform\PusherAuthController;

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

    Route::namespace('User')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('user.users');

        Route::prefix('patients')->group(function () {
            Route::get('/', [PatientsController::class, 'index'])->name('user.patients.index');
            Route::get('/create', [PatientsController::class, 'create'])->name('user.patients.create');
            Route::post('/', [PatientsController::class, 'store'])->name('user.patients.store');
            Route::get('/{patient}/edit', [PatientsController::class, 'edit'])->name('user.patients.edit');
            Route::put('/{patient}', [PatientsController::class, 'update'])->name('user.patients.update');
            Route::delete('/{patient}', [PatientsController::class, 'destroy'])->name('user.patients.destroy');
        });

        Route::prefix('files')->group(function () {
            Route::get('/{attachment}', [FilesController::class, 'show'])->name('user.files.show');
            Route::delete('/{attachment}', [FilesController::class, 'destroy'])->name('user.files.destroy');
//            Route::post('/{patient}/download-all', [FilesController::class, 'downloadAll'])->name('admin.files.download-all');
            Route::post('/{attachment}/download-one', [FilesController::class, 'downloadOne'])->name('user.files.download-one');
        });

            Route::get('/messages', [MessageController::class, 'index'])->name('user.messages.index');
            Route::get('/messages/{group}', [MessageController::class, 'show'])->name('user.messages.show');
            Route::post('/messages/{group}', [MessageController::class, 'store'])->name('user.messages.store');
            Route::post('/groups', [GroupController::class, 'store'])->name('user.groups.store');

});

Route::middleware(['auth', 'checkRolePlatform'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::namespace('Admin')->prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

//        Route::prefix('users')->group(function () {
//            Route::get('/', [UsersController::class, 'index'])->name('admin.users');
//        });

        Route::prefix('patients')->group(function () {
            Route::get('/', [PatientsAdminController::class, 'index'])->name('admin.patients.index');
            Route::get('/create', [PatientsAdminController::class, 'create'])->name('admin.patients.create');
            Route::get('/{patient}/edit', [PatientsAdminController::class, 'edit'])->name('admin.patients.edit');
            Route::put('/{patient}', [PatientsAdminController::class, 'update'])->name('admin.patients.update');
            Route::post('/', [PatientsAdminController::class, 'store'])->name('admin.patients.store');
            Route::delete('/{patient}', [PatientsAdminController::class, 'destroy'])->name('admin.patients.destroy');
        });

        Route::prefix('confreres')->group(function () {
            Route::get('/', [ConfreresController::class, 'index'])->name('admin.confreres');
            Route::get('/create', [ConfreresController::class, 'create'])->name('admin.confreres.create');
            Route::post('/', [ConfreresController::class, 'store'])->name('admin.confreres.store');
            Route::get('/{confrere}/edit', [ConfreresController::class, 'edit'])->name('admin.confreres.edit');
            Route::put('/{confrere}', [ConfreresController::class, 'update'])->name('admin.confreres.update');
            Route::delete('/{confrere}', [ConfreresController::class, 'destroy'])->name('admin.confreres.destroy');

            Route::get('/{confrere}/sent-login-link', [ConfreresController::class, 'reSentLoginLink'])
                ->name('admin.confreres.sent-login-link');
        });

//        Route::prefix('categories')->group(function () {
//            Route::post('/', [CategoriesController::class, 'store'])->name('admin.categories.store');
//            Route::put('/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
//            Route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
//        });

        Route::prefix('files')->group(function () {
            Route::get('/{attachment}', [FilesController::class, 'show'])->name('admin.files.show');
            Route::delete('/{attachment}', [FilesController::class, 'destroy'])->name('admin.files.destroy');
//            Route::post('/{patient}/download-all', [FilesController::class, 'downloadAll'])->name('admin.files.download-all');
            Route::post('/{attachment}/download-one', [FilesController::class, 'downloadOne'])->name('admin.files.download-one');
        });

        Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
        Route::get('/messages/{group}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
        Route::post('/messages', [AdminMessageController::class, 'store'])->name('admin.messages.store');
        Route::post('/groups', [AdminGroupController::class, 'store'])->name('admin.groups.store');

    });
});

    Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate'])->name('pusher.auth');
});