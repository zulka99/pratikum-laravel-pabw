<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cobacontroller;
use App\Http\Controllers\DataController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\LaporBanjirController;
use App\Http\Controllers\InvestorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home.page');

Route::get('/coba', [cobacontroller::class, 'index']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::get('/hello', function () {
    return 'Hello, nama saya Zulka Ridho Mahmudi Ganteng & Nonchalant';
});

Route::get('/user/{name}', function ($name) {
    return "Nama Saya $name";
});

Route::get('/great/{name}', function ($name = 'Guest') {
    return "Halo, $name";
});

Route::get('/About', function () {
    return view ('About', ['name' => 'Zulka Ridho Mahmudi']);
});

Route::get('/Profile/{name}', function ($name = 'Guest') {
    return "Nama saya adalah $name";
});

Route::get('/form', [DataController::class, 'form']);
Route::post('proses', [DataController::class, 'proses']);

Route::get('/FormMahasiswa', [MahasiswaController::class, 'FormMahasiswa']);
Route::post('/PostMahasiswa', [MahasiswaController::class, 'PostMahasiswa']);

Route::get('/laporbanjir', [LaporBanjirController::class, 'form']);
Route::post('/laporbanjir/proses', [LaporBanjirController::class, 'proses']);

Route::get('/investor', [InvestorController::class, 'form'])
    ->name('forminvestor');

Route::post('/investor/proses', [InvestorController::class, 'proses'])
    ->name('prosesinvestor');