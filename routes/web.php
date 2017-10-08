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
Route::get('/', 'Admin\PostsController@all') ;
/*
Route::get('/', function () {
    //return view('welcome');

});*/

// admin hello world 
Route::get('/admin',function(){
    return view('admin.hello-world');
});


/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/users',                                  'Admin\UsersController@index');
    Route::get('/admin/users/create',                           'Admin\UsersController@create');
    Route::post('/admin/users',                                 'Admin\UsersController@store');
    Route::get('/admin/users/{user}/edit',                      'Admin\UsersController@edit')->name('admin/users/edit');
    Route::post('/admin/users/{user}',                          'Admin\UsersController@update')->name('admin/users/update');
    Route::delete('/admin/users/{user}',                        'Admin\UsersController@destroy')->name('admin/users/destroy');
    Route::get('/admin/users/{user}/resend-activation',         'Admin\UsersController@resendActivationEmail')->name('admin/users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/posts',                                  'Admin\PostsController@index');
    Route::get('/admin/posts/create',                           'Admin\PostsController@create');
    Route::post('/admin/posts',                                 'Admin\PostsController@store');
    Route::get('/admin/posts/{post}/edit',                      'Admin\PostsController@edit')->name('admin/posts/edit');
    Route::post('/admin/posts/{post}',                          'Admin\PostsController@update')->name('admin/posts/update');
    Route::delete('/admin/posts/{post}',                        'Admin\PostsController@destroy')->name('admin/posts/destroy');
});