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

## HOME
Route::get('/', ['as'=>'index', 'uses'=>'Website\IndexController@index']);

## ABOUT ME
Route::get('about-me', ['as'=>'about-me', 'uses'=>'Website\AboutMeController@index']);

## CONTACT
Route::get('contact', ['as'=>'contact', 'uses'=>'Website\ContactController@index']);


// AUTHENTICATION
Route::get('admin', function () {
    return redirect(route('login'));
});
Route::get('admin/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('admin/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('admin/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
// PASSWORD RESET LINK REQUEST
Route::get('password/email', ['as' => 'passwordEmail', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', ['as' => 'passwordEmail', 'uses' => 'Auth\PasswordController@postEmail']);
// PASSWORD RESET
Route::get('password/reset/{token}', ['as' => 'passwordReset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'passwordReset', 'uses' => 'Auth\PasswordController@postReset']);

## ADMIN
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    ## HOME
    Route::get('home', ['as' => 'home', 'uses' => 'Admin\HomeController@home']);

    ## ABOUT ME
    Route::get('about-me', ['as' => 'aboutMe', 'uses' => 'Admin\AboutMeController@getIndex']);
    Route::get('about-me/add', ['as' => 'aboutMeAdd', 'uses' => 'Admin\AboutMeController@getAdd']);
    Route::post('about-me/add', ['as' => 'aboutMeAdd', 'uses' => 'Admin\AboutMeController@postAdd']);
    Route::get('about-me/edit/{aboutMeId?}', ['as' => 'aboutMeEdit', 'uses' => 'Admin\AboutMeController@getEdit']);
    Route::put('about-me/edit', ['as' => 'aboutMeEditPut', 'uses' => 'Admin\AboutMeController@putEdit']);
    Route::get('about-me/order', ['as' => 'aboutMeOrder', 'uses' => 'Admin\AboutMeController@getOrder']);
    Route::delete('about-me/delete', ['as' => 'aboutMeDelete', 'uses' => 'Admin\AboutMeController@delete']);

    ## WEBSITE SETTINGS
    Route::get('website-settings', ['as' => 'websiteSettings', 'uses' => 'Admin\WebsiteSettingsController@getIndex']);
    Route::put('website-settings', ['as' => 'websiteSettings', 'uses' => 'Admin\WebsiteSettingsController@putUpdate']);

    ## USERS
    Route::get('admin/register', 'Auth\AuthController@getRegister');
    Route::post('admin/register', 'Auth\AuthController@postRegister');

    ## LOGOUT
    Route::get('admin/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

    ##UPDATE ORDER
    Route::post('update-order', 'Admin\UpdateOrderController@postOrder');

});