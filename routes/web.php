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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth', 'namespace' => 'Account', 'prefix' => 'account'], function () {
    Route::get('', 'AccountController@index')->name('account');

    Route::get('email', 'EmailController@show')->name('account.email');
    Route::post('email/{user}', 'EmailController@store')->name('account.email.store');
    
    Route::get('username', 'UsernameController@show')->name('account.username');
    Route::post('username/{user}', 'UsernameController@store')->name('account.username.store');

    Route::get('avatar', 'AvatarController@show')->name('account.avatar');
    Route::post('avatar/{user}', 'AvatarController@store')->name('account.avatar.store');

    Route::get('password', 'PasswordController@show')->name('account.password');
    Route::post('password/{user}', 'PasswordController@store')->name('account.password.store');
});


Route::group(['namespace' => 'Auth'], function () {
   Route::get('register', 'RegistersController@create')->name('register');
   Route::post('register', 'RegistersController@store');
   Route::get('login', 'LoginsController@create')->name('login');
   Route::post('login', 'LoginsController@store');
   Route::post('signin', 'LoginsController@signin');
Route::get('logout', 'LoginsController@destroy')->name('logout');
Route::get('validation/{user}/{token}', 'LoginsController@validation');

Route::get('forget', 'ForgetController@create')->name('forget');
Route::post('forget', 'ForgetController@store');
Route::get('forget/{user}/{reset}', 'ForgetController@edit');
Route::put('forget/{user}/{reset}', 'ForgetController@update');

Route::get('confirmation', 'ConfirmationController@create')->name('confirmation');
Route::post('confirmation', 'ConfirmationController@store');
});


Route::group(['namespace' => 'Users'], function () {
   Route::get('users', 'UsersController@index')->name('users');
   Route::get('@{user}', 'ProfilesController@show')->name('profile');
});

;Route::group(['namespace' => 'Tutorials'], function () {
   Route::get('tutorials', 'TutorialsController@index')->name('tutorials');
});

Route::group(['namespace' => 'Posts', 'prefix' => 'blog'], function () {
   Route::get('', 'PostsController@index')->name('blog');
   Route::get('create', 'PostsController@create')->name('post.create');
   Route::post('store', 'PostsController@store')->name('post.store');
   Route::get('{category}', 'PostsController@index');
   Route::get('{category}/{post}', 'PostsController@show')->name('post');
   Route::get('{category}/{post}/edit', 'PostsController@edit');
   Route::put('{category}/{post}', 'PostsController@update');
   Route::delete('{category}/{post}', 'PostsController@destroy');


   Route::post('{category}/{post}/likes', 'PostLikesController@store');
   Route::delete('{category}/{post}/likes', 'PostLikesController@destroy');

    Route::post('{category}/{post}/subscribe', 'PostSubscribesController@store');
    Route::delete('{category}/{post}/subscribe', 'PostSubscribesController@destroy');


    // Comments
   Route::get('{category}/{post}/comments', 'CommentsController@index');
   Route::post('{category}/{post}/comments', 'CommentsController@store');
   Route::put('{category}/{post}/{comment}', 'CommentsController@update');
   Route::delete('{category}/{post}/{comment}', 'CommentsController@destroy');


});

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
