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

if (Auth::check()) {

    Route::get('/', function () {
        return redirect(url('dashboard/admin'));
    });
} else {
    Route::get('/', function () {
        return redirect(url('dashboard/admin/login'));
    });
}
Route::prefix('dashboard')->middleware('guest:admin')->group(function () {
    Route::get('{guard}/login', [App\Http\Controllers\UserAuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('{guard}/login', [App\Http\Controllers\UserAuthController::class, 'login']);
});

Route::prefix('dashboard/admin')->middleware('auth:admin')->group(function () {
    Route::get('logout', [App\Http\Controllers\UserAuthController::class, 'logout'])->name('dashboard.auth.logout');
    Route::get('password/edit', [App\Http\Controllers\UserAuthController::class, 'editPassword'])->name('dashboard.auth.edit-password');
    Route::post('password/update', [App\Http\Controllers\UserAuthController::class, 'updatePassword'])->name('dashboard.auth.update-password');
    Route::get('profile/edit', [App\Http\Controllers\UserAuthController::class, 'editProfile'])->name('dashboard.auth.edit-profile');
    Route::post('profile/update', [App\Http\Controllers\UserAuthController::class, 'updateProfile'])->name('dashboard.auth.update-profile');
    Route::get('/', 'PagesController@index')->name('admin.dashboard');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/sounds', SoundController::class);
    Route::resource('/scrolls', ScrollController::class);
    Route::resource('/milestones', MilestonesController::class);
    Route::resource('/milestone-articals', MilestoneArticleController::class);
    Route::resource('/category-milestones', CategoryMilestoneController::class);
    Route::resource('/type-milestones', MilestoneTypeController::class);

    Route::resource('/books', BookController::class);
    Route::resource('/videos', VideoController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::post('/update-admin/{id}', 'AdminController@update')->name('update-admin');
    Route::get('language_translate', 'DashboardController@show_translate')->name('show_translate');
    Route::post('/languages/key_value_store', 'DashboardController@key_value_store')->name('languages.key_value_store');
    Route::get('/change-lang/{language}', [App\Http\Controllers\DashboardController::class, 'changeLanguage'])->name('dashboard.change-language');
});
Route::get('/migrate', function () {
    Artisan::call('optimize');
    return "migrate is cleared";
});
Route::any('uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info')->middleware('auth:admin');
Route::resource('uploaded-files', 'AizUploadController')->middleware('auth:admin');
Route::post('aiz-uploader', 'AizUploadController@show_uploader')->middleware('auth:admin');
Route::post('aiz-uploader/upload', 'AizUploadController@upload')->middleware('auth:admin');
Route::get('aiz-uploader/get_uploaded_files', 'AizUploadController@get_uploaded_files')->middleware('auth:admin');
Route::post('aiz-uploader/get_file_by_ids', 'AizUploadController@get_preview_files')->middleware('auth:admin');
Route::get('aiz-uploader/download/{id}', 'AizUploadController@attachment_download')->name('download_attachment')->middleware('auth:admin');
// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
