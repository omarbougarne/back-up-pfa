<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
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



// Route::get('/', function () {
//     return view('/base');
// });
// dashboard

    //Users
    Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'softDelete'])->name('admin.users.softDelete');
    Route::post('/users/{user}/restore', [AdminController::class, 'restore'])->name('admin.users.restore');

});


// Registration and Login Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Animes: User List
    // Route::patch('/animes/update_watched/{id}', [AnimeController::class, 'updateWatched'])->name('animes.update_watched');
    Route::get('/animes/add/{id}', [AnimeController::class, 'addToUserList'])->name('animes.addToUserList');
    Route::get('/animes/remove/{id}', [AnimeController::class, 'removeFromUserList']);
    // Route::delete('/animes/{id}', [AnimeController::class, 'removeFromList'])->name('animes.removeFromList');
    Route::get('/animes/my-list', [AnimeController::class, 'userList'])->name('animes.user_list');
    Route::get('/animes/user_list/search', [AnimeController::class, 'searchInUserList'])->name('animes.user_list.search');
    //Animes: Admin Control
    Route::get('/animes/create', [AnimeController::class, 'create'])->name('animes.create');
    Route::post('/animes/store', [AnimeController::class, 'store'])->name('animes.store');
    Route::put('/animes/{id}/update', [AnimeController::class, 'update'])->name('animes.update');
    Route::get('/animes/{id}/edit', [AnimeController::class, 'edit'])->name('animes.edit');
    Route::delete('/animes/{id}/destroy', [AnimeController::class, 'destroy'])->name('animes.destroy');
    //Animes: User
    Route::get('/', [AnimeController::class, 'index'])->name('animes.index');
    Route::get('/animes/{id}', [AnimeController::class, 'show'])->name('animes.show');
    Route::patch('/animes/update_rating/{id}', [AnimeController::class, 'updateRating'])->name('animes.update_rating');
    Route::post('/animes/{anime}/comments', [AnimeController::class, 'storeComment'])->name('animes.comments.store');
    Route::get('/comments/{comment}/edit', [AnimeController::class, 'editComment'])->name('comments.edit');
    Route::patch('/comments/{comment}', [AnimeController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{comment}', [AnimeController::class, 'deleteComment'])->name('comments.delete');
    //Studios: Admin Control
    Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create');
    Route::post('/studios/store', [StudioController::class, 'store'])->name('studios.store');
    Route::put('/studios/{id}/update', [StudioController::class, 'update'])->name('studios.update');
    Route::get('/studios/{id}/edit', [StudioController::class, 'edit'])->name('studios.edit');
    Route::delete('/studios/{id}/destroy', [StudioController::class, 'destroy'])->name('studios.destroy');
    Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
    //Studios: User
    Route::get('/studios/{id}', [StudioController::class, 'show'])->name('studios.show');
    //Episodes: Admin Control
    Route::get('/episodes/create/{anime_id}', [EpisodesController::class, 'create'])->name('episodes.create');
    Route::get('/animes/{anime_id}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/episodes/store/{anime_id}', [EpisodesController::class, 'store'])->name('episodes.store');
    Route::get('/episodes/{id}/edit', [EpisodesController::class, 'edit'])->name('episodes.edit');
    Route::put('/episodes/{id}', [EpisodesController::class, 'update'])->name('episodes.update');
    Route::delete('/episodes/{id}', [EpisodesController::class, 'destroy'])->name('episodes.destroy');

    Route::get('mangas', [MangaController::class, 'index'])->name('mangas.index');
    Route::get('mangas/create', [MangaController::class, 'create'])->name('mangas.create');
    Route::post('mangas', [MangaController::class, 'store'])->name('mangas.store');
    Route::get('mangas/{manga}', [MangaController::class, 'show'])->name('mangas.show');
    Route::get('mangas/{manga}/edit', [MangaController::class, 'edit'])->name('mangas.edit');
    Route::put('mangas/{manga}', [MangaController::class, 'update'])->name('mangas.update');
    Route::patch('mangas/{manga}', [MangaController::class, 'update']);
    Route::delete('mangas/{manga}', [MangaController::class, 'destroy'])->name('mangas.destroy');
    //test
    Route::delete('/animes/user_list/{id}', [AnimeController::class, 'removeFromUserList'])->name('animes.removeFromUserList');
    Route::get('/animes/user_list/{id}/edit', [AnimeController::class, 'editInUserList'])->name('animes.editInUserList');
    // web.php
Route::post('/animes/{anime}/adduserrating', [AnimeController::class, 'addUserRating'])->name('animes.adduserrating');
Route::patch('/animes/{anime}/edituserrating', [AnimeController::class, 'editUserRating'])->name('animes.edituserrating');
Route::delete('/animes/{anime}/deleteuserrating', [AnimeController::class, 'deleteUserRating'])->name('animes.deleteuserrating');
Route::patch('/animes/{anime}/updatestatus', [AnimeController::class, 'updateStatus'])->name('animes.updatestatus');











