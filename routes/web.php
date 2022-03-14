<?php

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
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('about', function (){
    return view('about');
});

Route::get('sejarah', function (){
    return view('sejarah');

});

Route::get('visi-misi', function(){
    return view('visi-misi');
});

Route::get('berita acara', function(){
    return view('berita acara');
});

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

//require __DIR__ . '/auth.php';
//require __DIR__ . '/etc/etc.php';
