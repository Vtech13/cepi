<?php

use App\Http\Controllers\Admincms\AdviceFilesController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
//
//Route::get('/login', 'LoginController@index')->name('login');
//Route::post('/login', 'LoginController@login')->name('login');
//Route::post('/logout', 'LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('office.dashboard');

    Route::get('/logout', [LogoutController::class, 'index'])->name('office.logout');

    Route::prefix('posts')->group(function () {
        Route::get('/', 'PostsController@index')->name('office.posts.index');
        Route::get('/create', 'PostsController@create')->name('office.posts.create');
        Route::post('/', 'PostsController@store')->name('office.posts.store');
        Route::get('/{post}/edit', 'PostsController@edit')->name('office.posts.edit');
        Route::put('/{post}', 'PostsController@update')->name('office.posts.update');
        Route::delete('/{post}', 'PostsController@destroy')->name('office.posts.destroy');
        Route::delete('/{post}/destroy-attachment', 'PostsController@destroyAttachment')->name('office.posts.destroy-attachment');
    });

    Route::prefix('posts-categories')->group(function () {
        Route::get('/', 'PostCategoriesController@index')->name('office.posts-categories.index');
        Route::get('/create', 'PostCategoriesController@create')->name('office.posts-categories.create');
        Route::post('/', 'PostCategoriesController@store')->name('office.posts-categories.store');
        Route::get('/{postCategory}/edit', 'PostCategoriesController@edit')->name('office.posts-categories.edit');
        Route::put('/{postCategory}', 'PostCategoriesController@update')->name('office.posts-categories.update');
        Route::delete('/{postCategory}', 'PostCategoriesController@destroy')->name('office.posts-categories.destroy');
    });

    Route::prefix('pages')->group(function () {
        Route::get('/', 'PagesController@index')->name('office.pages.index');
        Route::get('/{page}', 'PagesController@edit')->name('office.pages.edit');

        Route::post('/add-block', 'BlocksController@store')->name('office.blocks.store');
        Route::put('/{block}/edit-block', 'BlocksController@update')->name('office.blocks.update');
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/', 'ContactsController@index')->name('office.contacts.index');
        Route::get('/{contact}', 'ContactsController@show')->name('office.contacts.show');
        Route::get('/{contact}/show-file/{file}', 'ContactsController@showFile')->name('office.contacts.show-file');
    });

    Route::prefix('advice-files')->group(function () {
        Route::get('/', [AdviceFilesController::class, 'index'])->name('office.advice-files.index');
        Route::get('/create', [AdviceFilesController::class, 'create'])->name('office.advice-files.create');
        Route::post('/', [AdviceFilesController::class, 'store'])->name('office.advice-files.store');
        Route::get('/{adviceFile}/edit', [AdviceFilesController::class, 'edit'])->name('office.advice-files.edit');
        Route::put('/{adviceFile}', [AdviceFilesController::class, 'update'])->name('office.advice-files.update');
        Route::delete('/{adviceFile}', [AdviceFilesController::class, 'destroy'])->name('office.advice-files.destroy');
    });

    Route::delete('/attachments/{attachment}', 'AttachmentsController@destroy')->name('office.attachments.destroy');
});
