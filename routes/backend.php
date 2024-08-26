<?php
use Illuminate\Support\Facades\Route;

Route::get('/auth',['as' => 'login', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@login']);
Route::post('/auth',['as' => 'login_validate', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@login_validate']);

Route::get('/locked',['as' => 'locked', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@locked']);
Route::post('/lockedOut',['as' => 'lockedOut', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@lockedOut']);

Route::get('/lockedLogout',['as' => 'lockedLogout', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@lockedLogout']);
Route::get('/logout',['as' => 'logout', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@logout']);

Route::get('/forgot',['as' => 'forgot', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@forgot']);
Route::post('/forgot_post',['as' => 'forgot_post', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@forgot_post']);

Route::get('/resetPassword/{id}',['as' => 'resetPassword', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@resetPassword']);
Route::post('/saveResetPassword/{id}',['as' => 'saveResetPassword', 'uses' => 'App\Http\Controllers\Backend\Auth\AuthController@saveResetPassword']);

Route::group(['prefix' => 'control','middleware' => ['web', 'permission:access-panel']], function () {

    Route::get('checkIdle', array('as' => 'checkIdle', function(){return 1;}));
    Route::get('', array('as' => 'baseURL', function(){return 1;}));

    Route::get('/dashboard',['as' => 'dashboard', 'uses' => 'App\Http\Controllers\Backend\Dashboard\DashboardController@dashboard']);


    //Setting
    Route::group(['prefix' => 'settings'], function () {
        //General Setting
        Route::get('/generalSetting', ['as' => 'generalSetting', 'middleware' => ['web', 'permission:view-general-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\GeneralSettingsController@index']);
        Route::post('/saveGeneralSetting/{id}', ['as' => 'saveGeneralSetting', 'middleware' => ['web', 'permission:update-general-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\GeneralSettingsController@saveGeneralSetting']);

        //Company Setting
        Route::get('/companySetting', ['as' => 'companySetting', 'middleware' => ['web', 'permission:view-company-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\CompanySettingsController@index']);
        Route::post('/saveCompanySetting/{id}', ['as' => 'saveCompanySetting', 'middleware' => ['web', 'permission:update-company-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\CompanySettingsController@saveCompanySetting']);

        //Email Setting
        Route::get('/emailSetting', ['as' => 'emailSetting', 'middleware' => ['web', 'permission:view-email-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\EmailSettingsController@index']);
        Route::post('/saveEmailSetting/{id}', ['as' => 'saveEmailSetting', 'middleware' => ['web', 'permission:update-email-setting'], 'uses' => 'App\Http\Controllers\Backend\Settings\EmailSettingsController@saveEmailSetting']);



        //Permission Setting
        Route::get('/permission', ['as' => 'permission', 'middleware' => ['web', 'permission:view-permission'], 'uses' => 'App\Http\Controllers\Backend\Settings\PermissionController@index']);
        Route::post('/savePermission', ['as' => 'savePermission', 'middleware' => ['web', 'permission:add-permission'], 'uses' => 'App\Http\Controllers\Backend\Settings\PermissionController@savePermission']);
        Route::get('/editPermission/{id}', ['as' => 'editPermission', 'middleware' => ['web', 'permission:view-permission'], 'uses' => 'App\Http\Controllers\Backend\Settings\PermissionController@editPermission']);
        Route::post('/updatePermission/{id}', ['as' => 'updatePermission', 'middleware' => ['web', 'permission:update-permission'], 'uses' => 'App\Http\Controllers\Backend\Settings\PermissionController@updatePermission']);
        Route::get('/deletePermission/{id}', ['as' => 'deletePermission', 'middleware' => ['web', 'permission:delete-permission'], 'uses' => 'App\Http\Controllers\Backend\Settings\PermissionController@deletePermission']);

        //Roles Setting
        Route::get('/role', ['as' => 'role', 'middleware' => ['web', 'permission:view-role'], 'uses' => 'App\Http\Controllers\Backend\Settings\RoleController@index']);
        Route::post('/saveRole', ['as' => 'saveRole', 'middleware' => ['web', 'permission:add-role'], 'uses' => 'App\Http\Controllers\Backend\Settings\RoleController@saveRole']);
        Route::get('/editRole/{id}', ['as' => 'editRole', 'middleware' => ['web', 'permission:view-role'], 'uses' => 'App\Http\Controllers\Backend\Settings\RoleController@editRole']);
        Route::post('/updateRole/{id}', ['as' => 'updateRole', 'middleware' => ['web', 'permission:update-role'], 'uses' => 'App\Http\Controllers\Backend\Settings\RoleController@updateRole']);
        Route::get('/deleteRole/{id}', ['as' => 'deleteRole', 'middleware' => ['web', 'permission:delete-role'], 'uses' => 'App\Http\Controllers\Backend\Settings\RoleController@deleteRole']);


    });

    //Profile
    Route::group(['prefix' => 'profile'], function () {
        //General
        Route::post('/changeProfileImage',['as' => 'changeProfileImage', 'uses' => 'App\Http\Controllers\Backend\Profile\GeneralController@changeProfileImage']);
        Route::get('/general',['as' => 'generalProfile', 'uses' => 'App\Http\Controllers\Backend\Profile\GeneralController@index']);
        Route::post('/saveGeneral',['as' => 'saveGeneralProfile', 'uses' => 'App\Http\Controllers\Backend\Profile\GeneralController@save']);
        //Account Setting
        Route::get('/accountSettingProfile',['as' => 'accountSettingProfile', 'uses' => 'App\Http\Controllers\Backend\Profile\SettingController@index']);
        Route::post('/saveAccountSettingProfile',['as' => 'saveAccountSettingProfile', 'uses' => 'App\Http\Controllers\Backend\Profile\SettingController@save']);
        //Social Links
        Route::get('/socialLink',['as' => 'socialLink', 'middleware' => ['web', 'permission:view-social-link'], 'uses' => 'App\Http\Controllers\Backend\Profile\SocialController@index']);
        Route::post('/saveSocialLink',['as' => 'saveSocialLink', 'middleware' => ['web', 'permission:update-social-link'], 'uses' => 'App\Http\Controllers\Backend\Profile\SocialController@save']);
    });

    //Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/all',['as' => 'allUsers', 'middleware' => ['web', 'permission:view-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@index']);
        Route::get('/allUsersDatatable',['as' => 'allUsersDatatable', 'middleware' => ['web', 'permission:view-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@datatable']);
        Route::get('/add',['as' => 'addUser', 'middleware' => ['web', 'permission:add-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@add']);
        Route::post('/save',['as' => 'saveUser', 'middleware' => ['web', 'permission:add-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@save']);
        Route::get('/edit/{id}',['as' => 'editUser', 'middleware' => ['web', 'permission:view-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@edit']);
        Route::post('save/{id}',['as' => 'updateUser', 'middleware' => ['web', 'permission:update-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@update']);
        Route::get('delete/{id}',['as' => 'deleteUser', 'middleware' => ['web', 'permission:delete-user'], 'uses' => 'App\Http\Controllers\Backend\Users\UsersController@delete']);
    });

    //Category
    // Route::group(['prefix' => 'category'], function () {
    //     Route::get('/all',['as' => 'allCategory', 'middleware' => ['web', 'permission:view-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@index']);
    //     Route::get('/allCategoryDatatable',['as' => 'allCategoryDatatable', 'middleware' => ['web', 'permission:view-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@datatable']);
    //     Route::get('/add',['as' => 'addCategory', 'middleware' => ['web', 'permission:add-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@add']);
    //     Route::post('/save',['as' => 'saveCategory', 'middleware' => ['web', 'permission:add-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@save']);
    //     Route::get('/edit/{id}',['as' => 'editCategory', 'middleware' => ['web', 'permission:view-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@edit']);
    //     Route::post('save/{id}',['as' => 'updateCategory', 'middleware' => ['web', 'permission:update-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@update']);
    //     Route::get('delete/{id}',['as' => 'deleteCategory', 'middleware' => ['web', 'permission:delete-category'], 'uses' => 'App\Http\Controllers\Backend\Category\CategoryController@delete']);
    // });




    Route::group(['prefix' => 'blog'], function () {
        // Category
        Route::get('/allCat',['as' => 'allBlogCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@allBlogCat']);
        Route::get('/allCatDatabase',['as' => 'allCatDatabase', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@allCatDatabase']);
        Route::get('/addCat',['as' => 'addCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@addCat']);
        Route::post('/saveCat/',['as' => 'saveCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@saveCat']);
        Route::get('/editCat/{id?}',['as' => 'editCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@editCat']);
        Route::post('updateCat/{id?}',['as' => 'updateCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@updateCat']);
        Route::get('deleteCat/{id?}',['as' => 'deleteCat', 'uses' => 'App\Http\Controllers\Backend\Blog\Category\BlogCategoryController@deleteCat']);
        //Blog
        Route::get('/allBlog',['as' => 'allBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@allBlog']);
        Route::get('/allBlogDatabase',['as' => 'allBlogDatabase', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@allBlogDatabase']);
        Route::get('/addBlog',['as' => 'addBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@addBlog']);
        Route::post('/saveBlog/',['as' => 'saveBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@saveBlog']);
        Route::get('/editBlog/{id?}',['as' => 'editBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@editBlog']);
        Route::post('updateBlog/{id?}',['as' => 'updateBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@updateBlog']);
        Route::get('deleteBlog/{id?}',['as' => 'deleteBlog', 'uses' => 'App\Http\Controllers\Backend\Blog\AllBlog\BlogController@deleteBlog']);
    
       
    
    });

});
