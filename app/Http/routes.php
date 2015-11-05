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

    ## EXPERIENCE
    Route::get('experience', ['as' => 'experience', 'uses' => 'Admin\ExperienceController@getIndex']);
    Route::get('experience/add', ['as' => 'experienceAdd', 'uses' => 'Admin\ExperienceController@getAdd']);
    Route::post('experience/add', ['as' => 'experienceAdd', 'uses' => 'Admin\ExperienceController@postAdd']);
    Route::get('experience/edit/{experienceId?}', ['as' => 'experienceEdit', 'uses' => 'Admin\ExperienceController@getEdit']);
    Route::put('experience/edit', ['as' => 'experienceEditPut', 'uses' => 'Admin\ExperienceController@putEdit']);
    Route::delete('experience/delete', ['as' => 'experienceDelete', 'uses' => 'Admin\ExperienceController@delete']);

    ## SKILLS
    Route::get('skills', ['as' => 'skills', 'uses' => 'Admin\SkillsController@getIndex']);
    Route::get('skills/add', ['as' => 'skillsAdd', 'uses' => 'Admin\SkillsController@getAdd']);
    Route::post('skills/add', ['as' => 'skillsAdd', 'uses' => 'Admin\SkillsController@postAdd']);
    Route::get('skills/edit/{skillsId?}', ['as' => 'skillsEdit', 'uses' => 'Admin\SkillsController@getEdit']);
    Route::put('skills/edit', ['as' => 'skillsEditPut', 'uses' => 'Admin\SkillsController@putEdit']);
    Route::get('skills/order', ['as' => 'skillsOrder', 'uses' => 'Admin\SkillsController@getOrder']);
    Route::delete('skills/delete', ['as' => 'skillsDelete', 'uses' => 'Admin\SkillsController@delete']);

    ## LANGUAGE
    Route::get('languages', ['as' => 'languages', 'uses' => 'Admin\LanguageController@getIndex']);
    Route::get('languages/add', ['as' => 'languagesAdd', 'uses' => 'Admin\LanguageController@getAdd']);
    Route::post('languages/add', ['as' => 'languagesAdd', 'uses' => 'Admin\LanguageController@postAdd']);
    Route::get('languages/edit/{languageId?}', ['as' => 'languagesEdit', 'uses' => 'Admin\LanguageController@getEdit']);
    Route::put('languages/edit', ['as' => 'languagesEditPut', 'uses' => 'Admin\LanguageController@putEdit']);
    Route::get('languages/order', ['as' => 'languagesOrder', 'uses' => 'Admin\LanguageController@getOrder']);
    Route::delete('languages/delete', ['as' => 'languagesDelete', 'uses' => 'Admin\LanguageController@delete']);

    ## WEBSITE SETTINGS
    Route::get('website-settings', ['as' => 'websiteSettings', 'uses' => 'Admin\WebsiteSettingsController@getIndex']);
    Route::put('website-settings', ['as' => 'websiteSettings', 'uses' => 'Admin\WebsiteSettingsController@putUpdate']);

    ## PROFILE
    Route::get('profile', ['as' => 'profile', 'uses' => 'Admin\ProfileController@getIndex']);
    Route::put('profile/edit', ['as' => 'profilePut', 'uses' => 'Admin\ProfileController@putUpdate']);

    ## USERS
    Route::get('users', ['as' => 'users', 'uses' => 'Admin\UsersController@getIndex']);
    Route::get('users/add', ['as' => 'usersAdd', 'uses' => 'Admin\UsersController@getAdd']);
    Route::post('users/add', ['as' => 'usersAdd', 'uses' => 'Admin\UsersController@postAdd']);
    Route::get('users/edit/{userId?}', ['as' => 'usersEdit', 'uses' => 'Admin\UsersController@getEdit']);
    Route::put('users/edit', ['as' => 'usersEditPut', 'uses' => 'Admin\UsersController@putEdit']);
    Route::get('users/permissions/{userId?}', ['as' => 'usersPermissions', 'uses' => 'Admin\UsersController@getPermissions']);
    Route::post('users/permissions', ['as' => 'usersPermissionsPost', 'uses' => 'Admin\UsersController@postPermissions']);
    Route::delete('users/delete', ['as' => 'usersDelete', 'uses' => 'Admin\UsersController@delete']);

    ## LOGOUT
    Route::get('admin/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

    ##UPDATE ORDER
    Route::post('update-order', 'Admin\UpdateOrderController@postOrder');

});