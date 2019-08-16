<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();


Route::group(['middleware' => ['auth', 'role-permission']], function () {
    // Route::group(['middleware' => ['auth']], function () {
    /* all routes in this route group require auth */
    /* home page routes */
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/user_home', 'UserHomeController@index')->name('user_home');

    /* config */
    Route::get('/config', 'ConfigController@edit')->name('config.edit');
    Route::post('/config', 'ConfigController@update')->name('config.update');

    /* roles */
    Route::get('/roles/{role}/edit_permissions', 'RoleController@editPermissions')->name('role.edit_permissions');
    Route::post('/roles/{role}/update_permissions', 'RoleController@updatePermissions')->name('role.update_permissions');
    Route::resource('roles', 'RoleController');

    /* permissions */
    Route::resource('permissions', 'PermissionController');

    /* users */
    Route::get('/profile', 'UserController@showProfile')->name('user.show_profile');
    Route::put('/profile', 'UserController@updateProfile')->name('user.update_profile');
    // display profile page for non-admin role
    Route::get('/user_profile', 'UserController@showUserProfile')->name('user.show_user_profile');
    Route::resource('users', 'UserController');

    /* projects */
    Route::resource('projects', 'ProjectController');

    /* WO module */
    Route::get('/wo/{project}', 'WOController@index')->name('wo.index');
    Route::get('/wo/{project}/create', 'WOController@create')->name('wo.create');
    Route::post('/wo/{project}/store', 'WOController@store')->name('wo.store');
    Route::get('/wo/{project}/{wo}', 'WOController@show')->name('wo.show');
    Route::get('/wo/{project}/{wo}/edit', 'WOController@edit')->name('wo.edit');
    Route::put('/wo/{project}/{wo}/update', 'WOController@update')->name('wo.update');
    Route::delete('/wo/{project}/{wo}/destroy', 'WOController@destroy')->name('wo.destroy');

    /* setups for bore holes */
    Route::resource('nationalities', 'NationalityController');
    Route::resource('drillers', 'DrillerController');
    Route::resource('casings', 'CasingController');
    Route::resource('drilling_companies', 'DrillingCompanyController');
    Route::resource('drilling_rigs', 'DrillingRigController');
    Route::resource('drilling_methods', 'DrillingMethodController');
    Route::resource('spt_methods', 'SPTMethodController');
    Route::resource('coring_methods', 'CoringMethodController');
    Route::resource('drilling_fluids', 'DrillingFluidController');

    /* bore holes */
    // Route::resource('bore_holes', 'BoreHoleController');
    Route::get('/bore_holes/{project}/{wo}', 'BoreHoleController@index')->name('bore_holes.index');
    Route::get('/bore_holes/{project}/{wo}/create', 'BoreHoleController@create')->name('bore_holes.create');
    Route::post('/bore_holes/{project}/{wo}/store', 'BoreHoleController@store')->name('bore_holes.store');
    Route::get('/bore_holes/{project}/{wo}/{bore_hole}', 'BoreHoleController@show')->name('bore_holes.show');
    Route::get('/bore_holes/{project}/{wo}/{bore_hole}/edit', 'BoreHoleController@edit')->name('bore_holes.edit');
    Route::put('/bore_holes/{project}/{wo}/{bore_hole}/update', 'BoreHoleController@update')->name('bore_holes.update');
    Route::delete('/bore_holes/{project}/{wo}/{bore_hole}/destroy', 'BoreHoleController@destroy')->name('bore_holes.destroy');

    /* BH module */
});

//test pdf
Route::get('pdf_test', 'TestController@tcpdfTest')->name('pdf.test');
Route::get('signature_test', 'TestController@createSignatureTest')->name('signature.create');
Route::post('signature_save', 'TestController@saveSignatureTest')->name('signature.save');
