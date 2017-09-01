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
    Route::any('/forbidden', ['uses' => 'HomeController@forbidden'])->name('forbidden');

    // Explorer routes
    Route::post('/upload', ['uses' => 'FileController@uploadFile'])->name('file.upload');
    Route::post('/explorer/files', ['uses' => 'FileController@getUserFiles'])->name('explorer.files');
    Route::post('/explorer/folders', ['uses' => 'FolderController@getUserFolders'])->name('explorer.folders');
    Route::post('/explorer/folders/parent', ['uses' => 'FolderController@getParentFolderId'])->name('explorer.folder.parent');
    Route::get('/explorer/files/download/{id?}', ['uses' => 'FileController@downloadFile'])->name('explorer.download');
    Route::get('/explorer/files/delete/{id?}', ['uses' => 'FileController@deleteFile'])->name('explorer.delete');
    Route::post('/explorer/folders/create', ['uses' => 'FolderController@createFolder'])->name('explorer.folder.create');
    Route::post('/explorer/files/rename', ['uses' => 'FileController@renameFile'])->name('explorer.file.rename');
    Route::post('/explorer/folders/rename', ['uses' => 'FolderController@renameFolder'])->name('explorer.folder.rename');
    Route::post('/explorer/files/move', ['uses' => 'FileController@moveFile'])->name('explorer.file.move');
    Route::post('/explorer/folders/get-breadcrumb', ['uses' => 'FolderController@getFolderBreadcrumb'])->name('explorer.folder.getBreadcrumb');

    // Profile routes
    Route::get('/profile', ['uses' => 'UserController@index'])->name('profile');
    Route::post('/profile/update', ['uses' => 'UserController@updateProfile'])->name('profile.update');

    // User routes
    Route::any('/user/get-quota', ['uses' => 'UserController@getUserDiskQuota'])->name('user.getQuota');

    Route::prefix('admin')->middleware(['adminCheck'])->group(function() {
       Route::get('settings', ['uses' => 'Admin\SettingsController@index'])->name('admin.settings');
       Route::post('settings/save', ['uses' => 'Admin\SettingsController@saveSettings'])->name('admin.settings.save');
    });
});
