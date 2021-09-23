<?php

//Route::view('/', 'welcome');
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('contact', 'Frontend\FrontController@loadContact')->name('contact');
Route::resource('contact-messages', 'Frontend\FrontController');

Route::get('/rent-cycles', 'Frontend\FrontController@RentCycles')->name('rent-cycles');
Route::get('/cycle-detail/{id}', 'Frontend\FrontController@getCycleDetails')->name('cycle-detail');
Route::get('/rent-trainers', 'Frontend\FrontController@RentTrainers')->name('rent-trainers');
Route::get('/trainer-detail/{id}', 'Frontend\FrontController@getTrainerDetails')->name('trainer-detail');

Route::get('training', 'Frontend\FrontController@loadTraining')->name('training');
Route::get('/offroad', 'Frontend\FrontController@getOffroadPage')->name('offroad');
Route::get('allevents', 'Frontend\FrontController@loadEvents')->name('allevents');
Route::get('/shop', 'Frontend\FrontController@getShopPage')->name('shop');
Route::get('/contact', 'Frontend\FrontController@getContactUsPage')->name('contact');
Route::get('/package', 'Frontend\FrontController@getPackagesPage')->name('package');
Route::get('book-trainer', 'Frontend\FrontController@bookTrainerCafe')->name('bookTrainerCafe');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Cycle
    Route::delete('cycles/destroy', 'CycleController@massDestroy')->name('cycles.massDestroy');
    Route::post('cycles/media', 'CycleController@storeMedia')->name('cycles.storeMedia');
    Route::post('cycles/ckmedia', 'CycleController@storeCKEditorImages')->name('cycles.storeCKEditorImages');
    Route::resource('cycles', 'CycleController');

    // Renting Cycle
    Route::delete('renting-cycles/destroy', 'RentingCycleController@massDestroy')->name('renting-cycles.massDestroy');
    Route::resource('renting-cycles', 'RentingCycleController');

    // Cycle Expenses
    Route::delete('cycle-expenses/destroy', 'CycleExpensesController@massDestroy')->name('cycle-expenses.massDestroy');
    Route::post('cycle-expenses/media', 'CycleExpensesController@storeMedia')->name('cycle-expenses.storeMedia');
    Route::post('cycle-expenses/ckmedia', 'CycleExpensesController@storeCKEditorImages')->name('cycle-expenses.storeCKEditorImages');
    Route::resource('cycle-expenses', 'CycleExpensesController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Tickets
    Route::delete('tickets/destroy', 'TicketsController@massDestroy')->name('tickets.massDestroy');
    Route::post('tickets/media', 'TicketsController@storeMedia')->name('tickets.storeMedia');
    Route::post('tickets/ckmedia', 'TicketsController@storeCKEditorImages')->name('tickets.storeCKEditorImages');
    Route::resource('tickets', 'TicketsController');

    // Event Registration
    Route::delete('event-registrations/destroy', 'EventRegistrationController@massDestroy')->name('event-registrations.massDestroy');
    Route::post('event-registrations/media', 'EventRegistrationController@storeMedia')->name('event-registrations.storeMedia');
    Route::post('event-registrations/ckmedia', 'EventRegistrationController@storeCKEditorImages')->name('event-registrations.storeCKEditorImages');
    Route::resource('event-registrations', 'EventRegistrationController');

    // Trainers
    Route::delete('trainers/destroy', 'TrainersController@massDestroy')->name('trainers.massDestroy');
    Route::post('trainers/media', 'TrainersController@storeMedia')->name('trainers.storeMedia');
    Route::post('trainers/ckmedia', 'TrainersController@storeCKEditorImages')->name('trainers.storeCKEditorImages');
    Route::resource('trainers', 'TrainersController');

    // Renting Trainer
    Route::delete('renting-trainers/destroy', 'RentingTrainerController@massDestroy')->name('renting-trainers.massDestroy');
    Route::resource('renting-trainers', 'RentingTrainerController');

    // Trainer Expenses
    Route::delete('trainer-expenses/destroy', 'TrainerExpensesController@massDestroy')->name('trainer-expenses.massDestroy');
    Route::post('trainer-expenses/media', 'TrainerExpensesController@storeMedia')->name('trainer-expenses.storeMedia');
    Route::post('trainer-expenses/ckmedia', 'TrainerExpensesController@storeCKEditorImages')->name('trainer-expenses.storeCKEditorImages');
    Route::resource('trainer-expenses', 'TrainerExpensesController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

    // Testimonials
    Route::delete('testimonials/destroy', 'TestimonialsController@massDestroy')->name('testimonials.massDestroy');
    Route::post('testimonials/media', 'TestimonialsController@storeMedia')->name('testimonials.storeMedia');
    Route::post('testimonials/ckmedia', 'TestimonialsController@storeCKEditorImages')->name('testimonials.storeCKEditorImages');
    Route::resource('testimonials', 'TestimonialsController');

    // Trainer Setting
    Route::delete('trainer-settings/destroy', 'TrainerSettingController@massDestroy')->name('trainer-settings.massDestroy');
    Route::resource('trainer-settings', 'TrainerSettingController');

    // Cycle Setting
    Route::delete('cycle-settings/destroy', 'CycleSettingController@massDestroy')->name('cycle-settings.massDestroy');
    Route::resource('cycle-settings', 'CycleSettingController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
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
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    //my Account
    Route::get('/account', 'FrontController@myAccountPage')->name('account');
    Route::get('myaccount', 'FrontController@myAccount')->name('myaccount');

    // For Rental Booking Backend
    Route::post('/getRentalBooking','Admin\TrainerBookingRentalController@getRentalBookingData')->name('bookings.getRentalBooking');
    

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});