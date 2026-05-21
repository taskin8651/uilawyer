<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
 
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

     Route::get('about-intro', 'AboutIntroController@index')->name('about-intro.index');
    Route::post('about-intro', 'AboutIntroController@update')->name('about-intro.update');

    Route::get('founder-message', 'FounderMessageController@index')->name('founder-message.index');
    Route::post('founder-message', 'FounderMessageController@update')->name('founder-message.update');

    Route::get('vision-mission', 'VisionMissionController@index')->name('vision-mission.index');
    Route::post('vision-mission', 'VisionMissionController@update')->name('vision-mission.update');

      Route::delete('attorneys/destroy', 'AttorneyController@massDestroy')->name('attorneys.massDestroy');
    Route::resource('attorneys', 'AttorneyController');

     Route::delete('article-categories/destroy', 'ArticleCategoryController@massDestroy')->name('article-categories.massDestroy');
    Route::resource('article-categories', 'ArticleCategoryController');

    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::resource('articles', 'ArticleController');

    Route::delete('legal-enquiries/destroy', 'LegalEnquiryController@massDestroy')->name('legal-enquiries.massDestroy');
    Route::post('legal-enquiries/{legalEnquiry}/status', 'LegalEnquiryController@updateStatus')->name('legal-enquiries.updateStatus');
    Route::resource('legal-enquiries', 'LegalEnquiryController')->only(['index', 'show', 'destroy']);
    
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

// Frontend routes

Route::get('/our-team', [App\Http\Controllers\Frontend\TeamController::class, 'index'])->name('frontend.team'); 
Route::get('/our-team/{attorney}', [App\Http\Controllers\Frontend\TeamController::class, 'show'])->name('frontend.attorneys.show');
Route::get('/about', [App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('frontend.about'); 

Route::get('/articles', [App\Http\Controllers\Frontend\ArticlePageController::class, 'index'])->name('frontend.articles.index');

Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('frontend.contact.index');
Route::get('/book-consultation', [App\Http\Controllers\Frontend\LegalEnquiryController::class, 'index'])->name('frontend.legal-enquiry.index');
Route::post('/legal-enquiry', [App\Http\Controllers\Frontend\LegalEnquiryController::class, 'store'])->name('frontend.legal-enquiry.store');