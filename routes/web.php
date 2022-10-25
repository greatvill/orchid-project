<?php

use App\Orchid\Screens\NewsScreen;
use App\Orchid\Screens\RequestsScreen;
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


Route::screen('/', \App\Orchid\Screens\User\UserListScreen::class)->name('platform.email');
Route::screen('news', NewsScreen::class)->name('news');
Route::screen('requests', RequestsScreen::class)->name('requests');
