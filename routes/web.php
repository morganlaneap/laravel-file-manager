<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::any('/', ['uses' => 'HomeController@index'])->name('home');
    Route::post('/upload', ['uses' => 'FileController@uploadFile'])->name('file.upload');
    Route::get('/profile', ['uses' => 'UserController@index'])->name('profile');
    Route::post('/explorer/files', ['uses' => 'FileController@getUserFiles'])->name('explorer.files');
    Route::any('/explorer/folders', ['uses' => 'FolderController@getUserFolders'])->name('explorer.folders');
    Route::get('/explorer/files/download/{id?}', ['uses' => 'FileController@downloadFile'])->name('explorer.download');
    Route::get('/explorer/files/delete/{id?}', ['uses' => 'FileController@deleteFile'])->name('explorer.delete');
    Route::post('/explorer/folders/create', ['uses' => 'FolderController@createFolder'])->name('folder.create');
});
