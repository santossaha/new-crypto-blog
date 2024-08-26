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

        //Country Setting
        Route::get('/countries', ['as' => 'countries', 'middleware' => ['web', 'permission:view-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@index']);
        Route::get('/countriesDatatable', ['as' => 'countriesDatatable', 'middleware' => ['web', 'permission:view-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@datatable']);
        Route::get('/addCountry', ['as' => 'addCountry', 'middleware' => ['web', 'permission:add-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@add']);
        Route::post('/saveCountry', ['as' => 'saveCountry', 'middleware' => ['web', 'permission:add-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@save']);
        Route::get('/editCountry/{id}', ['as' => 'editCountry', 'middleware' => ['web', 'permission:view-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@edit']);
        Route::post('/updateCountry/{id}', ['as' => 'updateCountry', 'middleware' => ['web', 'permission:update-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@update']);
        Route::get('/deleteCountry/{id}', ['as' => 'deleteCountry', 'middleware' => ['web', 'permission:delete-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@delete']);
        Route::get('/countryOptions', ['as' => 'countryOptions', 'middleware' => ['web', 'permission:view-country'], 'uses' => 'App\Http\Controllers\Backend\Settings\CountryController@countryOptions']);

        //State Setting
        Route::get('/states', ['as' => 'states', 'middleware' => ['web', 'permission:view-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@index']);
        Route::get('/statesDatatable', ['as' => 'statesDatatable', 'middleware' => ['web', 'permission:view-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@datatable']);
        Route::get('/addState', ['as' => 'addState', 'middleware' => ['web', 'permission:add-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@add']);
        Route::post('/saveState', ['as' => 'saveState', 'middleware' => ['web', 'permission:add-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@save']);
        Route::get('/editState/{id}', ['as' => 'editState', 'middleware' => ['web', 'permission:view-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@edit']);
        Route::post('/updateState/{id}', ['as' => 'updateState', 'middleware' => ['web', 'permission:update-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@update']);
        Route::get('/deleteState/{id}', ['as' => 'deleteState', 'middleware' => ['web', 'permission:delete-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@delete']);
        Route::get('/stateOptions', ['as' => 'stateOptions', 'middleware' => ['web', 'permission:view-state'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@stateOptions']);
        Route::get('/countryWiseStateOptions/{CountryID?}', ['as' => 'countrywiseStateOptions', 'middleware' => ['web'], 'uses' => 'App\Http\Controllers\Backend\Settings\StateController@countryWiseStateOptions']);

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

        //Taxes Setting
        Route::get('/tax', ['as' => 'tax', 'middleware' => ['web', 'permission:view-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@index']);
        Route::get('/taxDatatable', ['as' => 'taxDatatable', 'middleware' => ['web', 'permission:view-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@datatable']);
        Route::get('/addTax', ['as' => 'addTax', 'middleware' => ['web', 'permission:add-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@addTax']);
        Route::post('/saveTax', ['as' => 'saveTax', 'middleware' => ['web', 'permission:add-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@saveTax']);
        Route::get('/editTax/{id}', ['as' => 'editTax', 'middleware' => ['web', 'permission:view-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@editTax']);
        Route::post('/updateTax/{id}', ['as' => 'updateTax', 'middleware' => ['web', 'permission:update-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@updateTax']);
        Route::get('/deleteTax/{id}', ['as' => 'deleteTax', 'middleware' => ['web', 'permission:delete-tax'], 'uses' => 'App\Http\Controllers\Backend\Settings\TaxController@deleteTax']);
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

});
