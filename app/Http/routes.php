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
Route::get('about-me', ['as'=>'about-me', 'uses'=>'Website\IndexController@index']);
Route::get('about-me-modal', ['as'=>'about-me-modal', 'uses'=>'Website\AboutMeController@index']);

## CONTACT
Route::get('contact', ['as'=>'contact', 'uses'=>'Website\IndexController@index']);
Route::get('contact-modal', ['as'=>'contact-modal', 'uses'=>'Website\ContactController@index']);
Route::post('contact', ['as'=>'contact', 'uses'=>'Website\ContactController@post']);

## PROJECTS
Route::get('project/{month}/{year}/{slug}', ['as'=>'projectIndex', 'uses'=>'Website\IndexController@index'])->where(['month' => '[0-9]+', 'year' => '[0-9]+']);
Route::get('project/{projectsId}/{slug}', ['as'=>'project', 'uses'=>'Website\ProjectsController@project'])->where(['projectsId' => '[0-9]+']);
//Route::post('projects/pagination', ['as'=>'projectsPagination', 'uses'=>'Website\ProjectsController@pagination']);

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

    ## PROJECTS
    Route::get('projects', ['as' => 'projects', 'uses' => 'Admin\ProjectsController@getIndex']);
    Route::get('projects/add', ['as' => 'projectsAdd', 'uses' => 'Admin\ProjectsController@getAdd']);
    Route::post('projects/add', ['as' => 'projectsAdd', 'uses' => 'Admin\ProjectsController@postAdd']);
    Route::get('projects/edit/{projectsId?}', ['as' => 'projectsEdit', 'uses' => 'Admin\ProjectsController@getEdit']);
    Route::put('projects/edit', ['as' => 'projectsEditPut', 'uses' => 'Admin\ProjectsController@putEdit']);

    Route::get('projects/gallery/{projectsId?}', ['as' => 'projectsGallery', 'uses' => 'Admin\ProjectsController@getGallery']);
    Route::post('projects/gallery', ['as' => 'projectsGalleryAdd', 'uses' => 'Admin\ProjectsController@postGallery']);
    Route::get('projects/{projectsId?}/gallery/edit/{projectsGalleryId?}', ['as' => 'projectsGalleryEdit', 'uses' => 'Admin\ProjectsController@getGalleryEdit']);
    Route::put('projects/gallery/edit', ['as' => 'projectsGalleryEditPut', 'uses' => 'Admin\ProjectsController@putGalleryEdit']);
    Route::get('projects/gallery/order/{projectsId?}', ['as' => 'projectsGalleryOrder', 'uses' => 'Admin\ProjectsController@getGalleryOrder']);
    Route::delete('projects/gallery/delete', ['as' => 'projectsGalleryDelete', 'uses' => 'Admin\ProjectsController@deleteGallery']);

    Route::get('projects/movie/{projectsId?}', ['as' => 'projectsMovie', 'uses' => 'Admin\ProjectsController@getMovie']);
    Route::get('projects/movie/add/{projectsId?}', ['as' => 'projectsMovieAdd', 'uses' => 'Admin\ProjectsController@getMovieAdd']);
    Route::post('projects/movie/add', ['as' => 'projectsMovieAddPost', 'uses' => 'Admin\ProjectsController@postMovieAdd']);
    Route::get('projects/{projectsId}/movie/edit/{projectsMovieId?}', ['as' => 'projectsMovieEdit', 'uses' => 'Admin\ProjectsController@getMovieEdit']);
    Route::put('projects/movie/edit', ['as' => 'projectsMovieEditPut', 'uses' => 'Admin\ProjectsController@putMovieEdit']);
    Route::get('projects/movie/order/{projectsId?}', ['as' => 'projectsMovieOrder', 'uses' => 'Admin\ProjectsController@getMovieOrder']);
    Route::delete('projects/movie/delete', ['as' => 'projectsMovieDelete', 'uses' => 'Admin\ProjectsController@deleteMovie']);

    Route::get('projects/order', ['as' => 'projectsOrder', 'uses' => 'Admin\ProjectsController@getOrder']);
    Route::delete('projects/delete', ['as' => 'projectsDelete', 'uses' => 'Admin\ProjectsController@delete']);

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

    ##CATEGORY
    Route::get('select-category/{modalTitle?}/{modalName?}/{modalDatabaseTable?}', ['as' => 'selectCategory', 'uses' => 'Admin\CategoryModalController@getIndex']);
    Route::post('select-category/add', ['as' => 'selectCategoryAdd', 'uses' => 'Admin\CategoryModalController@postAdd']);
    Route::put('select-category/edit', ['as' => 'selectCategoryEdit', 'uses' => 'Admin\CategoryModalController@putEdit']);
    Route::delete('select-category/delete', ['as' => 'selectCategoryDelete', 'uses' => 'Admin\CategoryModalController@delete']);
    Route::post('select-category/refresh', ['as' => 'selectCategoryRefresh', 'uses' => 'Admin\CategoryModalController@postRefresh']);

});