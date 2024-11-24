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

    Route::group(['prefix' => 'news'], function () {
        // Category
        Route::get('/allNewsCat',['as' => 'allNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@allBlogCat']);
        Route::get('/allNewsCatDatabase',['as' => 'allNewsCatDatabase', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@allCatDatabase']);
        Route::get('/addNewsCat',['as' => 'addNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@addCat']);
        Route::post('/saveNewsCat/',['as' => 'saveNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@saveCat']);
        Route::get('/editNewsCat/{id?}',['as' => 'editNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@editCat']);
        Route::post('updateNewsCat/{id?}',['as' => 'updateNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@updateCat']);
        Route::get('deleteNewsCat/{id?}',['as' => 'deleteNewsCat', 'uses' => 'App\Http\Controllers\Backend\News\NewsCategoryController@deleteCat']);
    
        //News
        Route::get('/allNews',['as' => 'allNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@all']);
        Route::get('/allNewsDatabase',['as' => 'allNewsDatabase', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@allNewsDatabase']);
        Route::get('/addNews',['as' => 'addNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@add']);
        Route::post('/saveNews',['as' => 'saveNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@saveNews']);
        Route::get('/editNews/{id?}',['as' => 'editNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@editNews']);
        Route::post('updateNews/{id?}',['as' => 'updateNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@updateNews']);
        Route::get('deleteNews/{id?}',['as' => 'deleteNews', 'uses' => 'App\Http\Controllers\Backend\News\NewsController@deleteNews']);
    
       
    });



    Route::group(['prefix' => 'events'], function () {


        // Category 
        Route::get('/allEventsCat',['as' => 'allEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@allBlogCat']);
        Route::get('/allEventsCatDatabase',['as' => 'allEventsCatDatabase', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@allCatDatabase']);
        Route::get('/addEventsCat',['as' => 'addEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryControllerr@addCat']);
        Route::post('/saveEventsCat/',['as' => 'saveEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@saveCat']);
        Route::get('/editEventsCat/{id?}',['as' => 'editEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@editCat']);
        Route::post('updateEventsCat/{id?}',['as' => 'updateEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@updateCat']);
        Route::get('deleteEventsCat/{id?}',['as' => 'deleteEventsCat', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventCategoryController@deleteCat']);





     //Events
     Route::get('/allEvent',['as' => 'allEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@allEvents']);
     Route::get('/allEventDatatable',['as' => 'allEventDatatable', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@allEventsDatabase']);
     Route::get('/addEvent',['as' => 'addEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@addEvents']);
     Route::post('/saveEvent/',['as' => 'saveEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@saveEvents']);
     Route::get('/editEvent/{id?}',['as' => 'editEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@editEvents']);
     Route::post('updateEvent/{id?}',['as' => 'updateEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@updateEvents']);
     Route::get('deleteEvent/{id?}',['as' => 'deleteEvent', 'uses' => 'App\Http\Controllers\Backend\Evenets\EventController@deleteEvents']);
 

    });


        //Banner
    Route::group(['prefix' => 'Banner','middleware' => ['role:admin']], function () {
        Route::get('/all',['as' => 'allBanner',  'uses' =>'App\Http\Controllers\Backend\Banner\BannerController@index']);
        Route::get('/allBannerDatatable',['as' => 'allBannerDatatable', 'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@datatable']);
        Route::get('/add',['as' => 'addBanner', 'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@add']);
        Route::post('/save',['as' => 'saveBanner',  'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@save']);
        Route::get('/edit/{id}',['as' => 'editBanner', 'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@edit']);
        Route::post('/update/{id}',['as' => 'updateBanner',  'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@update']);
        Route::get('/status/{id?}',['as' => 'statusBanner', 'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@status_banner']);
        Route::get('/delete/{id}',['as' => 'deleteBanner',  'uses' => 'App\Http\Controllers\Backend\Banner\BannerController@delete']);
    });
    Route::group(['prefix' => 'Gallery','middleware' => ['role:admin']], function () {
        Route::get('/all',['as' => 'allGallery',  'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@index']);
        Route::get('/allGalleryDatatable',['as' => 'allGalleryDatatable', 'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@datatable']);
        Route::get('/add',['as' => 'addGallery', 'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@add']);
        Route::post('/save',['as' => 'saveGallery',  'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@save']);
        Route::get('/edit/{id}',['as' => 'editGallery', 'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@edit']);
        Route::post('/update/{id}',['as' => 'updateGallery',  'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@update']);
        Route::get('/status/{id?}',['as' => 'statusGallery', 'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@status_banner']);
        Route::get('/delete/{id}',['as' => 'deleteGallery',  'uses' => 'App\Http\Controllers\Backend\Galleries\GalleryController@delete']);
    });

    Route::group(['prefix' => 'about'], function () {
        // About US
        Route::get('/allAbout',['as' => 'allAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@allAbout']);
        Route::get('/allAboutDatabase',['as' => 'allAboutDatabase', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@allAboutDatabase']);
        Route::get('/addAbout',['as' => 'addAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@addAbout']);
        Route::post('/saveAbout/{id?}',['as' => 'saveAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@saveAbout']);
        Route::get('/editAbout/{id?}',['as' => 'editAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@editAbout']);
        Route::post('updateAbout/{id?}',['as' => 'updateAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@updateAbout']);
        Route::get('deleteAbout/{id?}',['as' => 'deleteAbout', 'uses' => 'App\Http\Controllers\Backend\About\AboutController@deleteAbout']);
    });



    Route::group(['prefix' => 'addsImage'], function () {
        // About U
        Route::get('/allAddsImage',['as' => 'allAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@index']);
        Route::get('/allAddsImageDatabase',['as' => 'allAddsImageDatabase', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@allAdsDatabase']);
        Route::get('/addAddsImage',['as' => 'addAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@addImage']);
        Route::post('/saveAddsImage/{id?}',['as' => 'saveAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@save']);
        Route::get('/editAddsImage/{id?}',['as' => 'editAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@edit']);
        Route::post('updateAddsImage/{id?}',['as' => 'updateAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@update']);
        // Route::get('deleteAddsImage/{id?}',['as' => 'deleteAddsImage', 'uses' => 'App\Http\Controllers\Backend\AdsImage\AdsController@deleteAbout']);
    });




    Route::group(['prefix' => 'contact'], function () {
        // About US
        Route::get('/allContact',['as' => 'allContact', 'uses' => 'App\Http\Controllers\Backend\Contact\ContactController@allContact']);
        Route::get('/allContactDatabase',['as' => 'allContactDatabase', 'uses' => 'App\Http\Controllers\Backend\Contact\ContactController@allContactDatabase']);
        Route::get('/viewContact/{id?}',['as' => 'viewContact', 'uses' => 'App\Http\Controllers\Backend\Contact\ContactController@viewContact']);
        Route::get('deleteContact/{id?}',['as' => 'deleteContact', 'uses' => 'App\Http\Controllers\Backend\Contact\ContactController@deleteContact']);
    });

});
