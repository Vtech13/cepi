<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/cabinet-dentaire', [PagesController::class, 'cabinet'])->name('cabinet');
Route::get('/conseils-patients', [PagesController::class, 'conseilsPatients'])->name('conseils-patients');
Route::get('/espaces-praticiens', [PagesController::class, 'espacesPraticiens'])->name('espaces-praticiens');
Route::get('/videos-utiles', [PagesController::class, 'videosUtiles'])->name('videos-utiles');
Route::get('/mentions-legales', [PagesController::class, 'mentionsLegales'])->name('mentions-legales');

/**
 * -----------------
 * -- SOINS
 * -----------------
 */
Route::get('/chirurgie-buccale', [PagesController::class, 'chirurgieBuccale'])->name('chirurgie-buccale');
Route::get('/esthetique-dentaire', [PagesController::class, 'esthetiqueDentaire'])->name('esthetique-dentaire');
Route::get('/endodontie', [PagesController::class, 'endodontie'])->name('endodontie');
Route::get('/parodontologie', [PagesController::class, 'parodontologie'])->name('parodontologie');
Route::get('/implantologie', [PagesController::class, 'implantologie'])->name('implantologie');


Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactsController::class, 'store'])->name('contact.store');

//Route::get('/actualites', [PostsController::class, 'index'])->name('posts.index');
Route::redirect('/actualites', '/conseils-patients');
Route::get('/actualites/{slug}', [PostsController::class, 'view'])->name('posts.view');
Route::get('/actualites/categorie/{slug}', [PostsController::class, 'viewCategory'])->name('posts.view-category');




Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/recover-password', RecoverPasswordController::class)->name('auth.recover-password');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('auth.reset-password');
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'store'])->name('auth.reset-password.store');

Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::post('pusher/auth', 'App\Http\Controllers\PusherController@authenticate');
