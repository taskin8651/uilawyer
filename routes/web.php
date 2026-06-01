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

    Route::post('notifications/{notification}/read', 'AdminNotificationController@markRead')->name('notifications.markRead');
    Route::resource('notifications', 'AdminNotificationController')->only(['index', 'show', 'destroy']);

    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::resource('tasks', 'TaskController');

    Route::delete('internships/destroy', 'InternshipApplicationController@massDestroy')->name('internships.massDestroy');
    Route::post('internships/{internship}/status', 'InternshipApplicationController@updateStatus')->name('internships.updateStatus');
    Route::resource('internships', 'InternshipApplicationController')->only(['index', 'show', 'destroy']);

    Route::delete('important-links/destroy', 'ImportantLinkController@massDestroy')->name('important-links.massDestroy');
    Route::resource('important-links', 'ImportantLinkController');

    Route::delete('legal-qas/destroy', 'LegalQaController@massDestroy')->name('legal-qas.massDestroy');
    Route::resource('legal-qas', 'LegalQaController')->only(['index', 'store', 'show', 'destroy']);

    Route::delete('awareness-videos/destroy', 'AwarenessVideoController@massDestroy')->name('awareness-videos.massDestroy');
    Route::resource('awareness-videos', 'AwarenessVideoController');

    Route::delete('meta-tags/destroy', 'MetaTagController@massDestroy')->name('meta-tags.massDestroy');
    Route::resource('meta-tags', 'MetaTagController');

     Route::get('about-intro', 'AboutIntroController@index')->name('about-intro.index');
    Route::post('about-intro', 'AboutIntroController@update')->name('about-intro.update');

    Route::get('founder-message', 'FounderMessageController@index')->name('founder-message.index');
    Route::post('founder-message', 'FounderMessageController@update')->name('founder-message.update');

    Route::get('vision-mission', 'VisionMissionController@index')->name('vision-mission.index');
    Route::post('vision-mission', 'VisionMissionController@update')->name('vision-mission.update');

    Route::get('site-settings', 'SiteSettingController@index')->name('site-settings.index');
    Route::post('site-settings', 'SiteSettingController@update')->name('site-settings.update');

      Route::delete('attorneys/destroy', 'AttorneyController@massDestroy')->name('attorneys.massDestroy');
    Route::resource('attorneys', 'AttorneyController');

     Route::delete('article-categories/destroy', 'ArticleCategoryController@massDestroy')->name('article-categories.massDestroy');
    Route::resource('article-categories', 'ArticleCategoryController');

    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::resource('articles', 'ArticleController');

    Route::delete('verdict-judgments/destroy', 'VerdictJudgmentController@massDestroy')->name('verdict-judgments.massDestroy');
    Route::resource('verdict-judgments', 'VerdictJudgmentController');

    Route::delete('practice-areas/destroy', 'PracticeAreaController@massDestroy')->name('practice-areas.massDestroy');
    Route::resource('practice-areas', 'PracticeAreaController');

    Route::delete('practice-area-services/destroy', 'PracticeAreaServiceController@massDestroy')->name('practice-area-services.massDestroy');
    Route::resource('practice-area-services', 'PracticeAreaServiceController');

    Route::delete('legal-enquiries/destroy', 'LegalEnquiryController@massDestroy')->name('legal-enquiries.massDestroy');
    Route::post('legal-enquiries/{legalEnquiry}/status', 'LegalEnquiryController@updateStatus')->name('legal-enquiries.updateStatus');
    Route::resource('legal-enquiries', 'LegalEnquiryController')->only(['index', 'show', 'destroy']);

     Route::delete('career-applications/destroy', 'CareerApplicationController@massDestroy')->name('career-applications.massDestroy');
    Route::post('career-applications/{careerApplication}/status', 'CareerApplicationController@updateStatus')->name('career-applications.updateStatus');
    Route::resource('career-applications', 'CareerApplicationController')->only(['index', 'show', 'destroy']);
    
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::resource('testimonials', 'TestimonialController');
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
Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('frontend.index');
Route::get('/our-team', [App\Http\Controllers\Frontend\TeamController::class, 'index'])->name('frontend.team'); 
Route::get('/join-our-team', [App\Http\Controllers\Frontend\TeamController::class, 'join'])->name('frontend.team.join');
Route::post('/join-our-team', [App\Http\Controllers\Frontend\TeamController::class, 'storeJoin'])->name('frontend.team.join.store');
Route::get('/our-team/{attorney}', [App\Http\Controllers\Frontend\TeamController::class, 'show'])->name('frontend.attorneys.show');
Route::get('/about', [App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('frontend.about'); 
Route::view('/terms', 'frontend.terms')->name('frontend.terms');
Route::view('/refund-policy', 'frontend.refund')->name('frontend.refund');
Route::view('/privacy-policy', 'frontend.privacy')->name('frontend.privacy');
Route::get('/practice-area', [App\Http\Controllers\Frontend\PracticeAreaPageController::class, 'index'])->name('frontend.practice-area.index');
Route::get('/practice-areas/{practiceArea:slug}', [App\Http\Controllers\Frontend\PracticeAreaPageController::class, 'show'])->name('frontend.practice-areas.show');
Route::get('/practice-services/{practiceAreaService:slug}', [App\Http\Controllers\Frontend\PracticeAreaPageController::class, 'showService'])->name('frontend.practice-services.show');

Route::get('/articles', [App\Http\Controllers\Frontend\ArticlePageController::class, 'index'])->name('frontend.articles.index');
Route::get('/articles/submit', [App\Http\Controllers\Frontend\ArticlePageController::class, 'create'])->name('frontend.articles.submit');
Route::post('/articles/submit', [App\Http\Controllers\Frontend\ArticlePageController::class, 'store'])->name('frontend.articles.submit.store');
Route::get('/articles/{article:slug}', [App\Http\Controllers\Frontend\ArticlePageController::class, 'show'])->name('frontend.articles.show');

Route::get('/verdicts-and-judgments', [App\Http\Controllers\Frontend\VerdictJudgmentPageController::class, 'index'])->name('frontend.verdicts.index');
Route::get('/verdicts-and-judgments/{verdictJudgment:slug}', [App\Http\Controllers\Frontend\VerdictJudgmentPageController::class, 'show'])->name('frontend.verdicts.show');

Route::get('/important-links', [App\Http\Controllers\Frontend\ResourceController::class, 'importantLinks'])->name('frontend.important-links.index');
Route::get('/awareness-videos', [App\Http\Controllers\Frontend\ResourceController::class, 'awarenessVideos'])->name('frontend.awareness-videos.index');
Route::get('/legal-qa', [App\Http\Controllers\Frontend\ResourceController::class, 'legalQa'])->name('frontend.legal-qa.index');
Route::post('/legal-qa', [App\Http\Controllers\Frontend\ResourceController::class, 'storeLegalQa'])->name('frontend.legal-qa.store');

Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('frontend.contact.index');
Route::get('/book-consultation', [App\Http\Controllers\Frontend\LegalEnquiryController::class, 'index'])->name('frontend.legal-enquiry.index');
Route::post('/legal-enquiry', [App\Http\Controllers\Frontend\LegalEnquiryController::class, 'store'])->name('frontend.legal-enquiry.store');

Route::get('/career-application', [App\Http\Controllers\Frontend\CareerApplicationController::class, 'index'])->name('frontend.career-application.index');  
Route::post('/career-application', [App\Http\Controllers\Frontend\CareerApplicationController::class, 'store'])->name('frontend.career-application.store');
Route::get('/internship-application', [App\Http\Controllers\Frontend\InternshipApplicationController::class, 'index'])->name('frontend.internship-application.index');
Route::post('/internship-application', [App\Http\Controllers\Frontend\InternshipApplicationController::class, 'store'])->name('frontend.internship-application.store');
