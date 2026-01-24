<?php
use Illuminate\Support\Facades\Route;

// Controller Namespaces
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Backend\Settings\{
    GeneralSettingsController,
    CompanySettingsController,
    EmailSettingsController,
    PermissionController,
    RoleController
};
use App\Http\Controllers\Backend\Profile\{
    GeneralController as ProfileGeneralController,
    SettingController as ProfileSettingController,
    SocialController as ProfileSocialController
};
use App\Http\Controllers\Backend\Users\UsersController;
use App\Http\Controllers\Backend\Blog\{
    Category\BlogCategoryController,
    AllBlog\BlogController
};
use App\Http\Controllers\Backend\News\{
    NewsCategoryController,
    NewsController
};
use App\Http\Controllers\Backend\Evenets\{
    EventCategoryController,
    EventController
};
use App\Http\Controllers\Backend\Banner\BannerController;
use App\Http\Controllers\Backend\Galleries\GalleryController;
use App\Http\Controllers\Backend\About\AboutController;
use App\Http\Controllers\Backend\AdsImage\AdsController;
use App\Http\Controllers\Backend\Contact\ContactController;
use App\Http\Controllers\Backend\Airdrops\AirDropsController;
use App\Http\Controllers\Backend\ICO\ICOController;

// Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('/', ['as' => 'login', 'uses' => AuthController::class.'@login']);
    Route::post('/', ['as' => 'login_validate', 'uses' => AuthController::class.'@login_validate']);
    Route::get('/locked', ['as' => 'locked', 'uses' => AuthController::class.'@locked']);
    Route::post('/lockedOut', ['as' => 'lockedOut', 'uses' => AuthController::class.'@lockedOut']);
    Route::get('/lockedLogout', ['as' => 'lockedLogout', 'uses' => AuthController::class.'@lockedLogout']);
    Route::get('/logout', ['as' => 'logout', 'uses' => AuthController::class.'@logout']);
    Route::get('/forgot', ['as' => 'forgot', 'uses' => AuthController::class.'@forgot']);
    Route::post('/forgot_post', ['as' => 'forgot_post', 'uses' => AuthController::class.'@forgot_post']);
    Route::get('/resetPassword/{id}', ['as' => 'resetPassword', 'uses' => AuthController::class.'@resetPassword']);
    Route::post('/saveResetPassword/{id}', ['as' => 'saveResetPassword', 'uses' => AuthController::class.'@saveResetPassword']);
});

// Control Panel Routes
Route::group(['prefix' => 'control', 'middleware' => ['web', 'permission:access-panel']], function () {
    Route::get('checkIdle', ['as' => 'checkIdle', function() { return 1; }]);
    Route::get('', ['as' => 'baseURL', function() { return 1; }]);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => DashboardController::class.'@dashboard']);

    // Settings Routes
    Route::prefix('settings')->group(function () {
        // General Settings
        Route::get('/general', ['as' => 'generalSetting', 'middleware' =>
        ['web', 'permission:view-general-setting'], 'uses' => GeneralSettingsController::class.'@index']);
        Route::post('/general/{id}', ['as' => 'saveGeneralSetting', 'middleware' =>
        ['web', 'permission:update-general-setting'], 'uses' => GeneralSettingsController::class.'@saveGeneralSetting']);

        // Company Settings
        Route::get('/company', ['as' => 'companySetting', 'middleware' =>
        ['web', 'permission:view-company-setting'], 'uses' => CompanySettingsController::class.'@index']);
        Route::post('/company/{id}', ['as' => 'saveCompanySetting', 'middleware' =>
        ['web', 'permission:update-company-setting'], 'uses' => CompanySettingsController::class.'@saveCompanySetting']);

        // Email Settings
        Route::get('/email', ['as' => 'emailSetting', 'middleware' =>
        ['web', 'permission:view-email-setting'], 'uses' => EmailSettingsController::class.'@index']);
        Route::post('/email/{id}', ['as' => 'saveEmailSetting', 'middleware' =>
        ['web', 'permission:update-email-setting'], 'uses' => EmailSettingsController::class.'@saveEmailSetting']);

        // Permission Management
        Route::get('/permission', ['as' => 'permission', 'middleware' =>
        ['web', 'permission:view-permission'], 'uses' => PermissionController::class.'@index']);

        Route::post('/savePermission', ['as' => 'savePermission', 'middleware' =>
        ['web', 'permission:add-permission'], 'uses' => PermissionController::class.'@savePermission']);

        Route::get('/editPermission/{id}', ['as' => 'editPermission', 'middleware' =>
        ['web', 'permission:view-permission'], 'uses' => PermissionController::class.'@editPermission']);

        Route::post('/updatePermission/{id}', ['as' => 'updatePermission', 'middleware' =>
        ['web', 'permission:update-permission'], 'uses' => PermissionController::class.'@updatePermission']);

        Route::get('/deletePermission/{id}', ['as' => 'deletePermission', 'middleware' =>
        ['web', 'permission:delete-permission'], 'uses' => PermissionController::class.'@deletePermission']);

        // Roles Setting
        Route::get('/role', ['as' => 'role', 'middleware' =>
        ['web', 'permission:view-role'], 'uses' => RoleController::class.'@index']);

        Route::post('/saveRole', ['as' => 'saveRole', 'middleware' =>
        ['web', 'permission:add-role'], 'uses' => RoleController::class.'@saveRole']);

        Route::get('/editRole/{id}', ['as' => 'editRole', 'middleware' =>
        ['web', 'permission:view-role'], 'uses' => RoleController::class.'@editRole']);

        Route::post('/updateRole/{id}', ['as' => 'updateRole', 'middleware' =>
        ['web', 'permission:update-role'], 'uses' => RoleController::class.'@updateRole']);

        Route::get('/deleteRole/{id}', ['as' => 'deleteRole', 'middleware' =>
        ['web', 'permission:delete-role'], 'uses' => RoleController::class.'@deleteRole']);

    });

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::post('/changeProfileImage', ['as' => 'changeProfileImage', 'uses' =>
        ProfileGeneralController::class.'@changeProfileImage']);
        Route::get('/general', ['as' => 'generalProfile', 'uses' => ProfileGeneralController::class.'@index']);
        Route::post('/general', ['as' => 'saveGeneralProfile', 'uses' => ProfileGeneralController::class.'@save']);
        Route::get('/account', ['as' => 'accountSettingProfile', 'uses' => ProfileSettingController::class.'@index']);
        Route::post('/account', ['as' => 'saveAccountSettingProfile', 'uses' => ProfileSettingController::class.'@save']);
        Route::get('/social', ['as' => 'socialLink', 'middleware' => ['web', 'permission:view-social-link'], 'uses' =>
        ProfileSocialController::class.'@index']);
        Route::post('/social', ['as' => 'saveSocialLink', 'middleware' => ['web', 'permission:update-social-link'], 'uses' =>
        ProfileSocialController::class.'@save']);
    });

    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/all', ['as' => 'allUsers', 'middleware' =>
        ['web', 'permission:view-user'], 'uses' => UsersController::class.'@index']);

        Route::get('/allUsersDatatable', ['as' => 'allUsersDatatable', 'middleware' =>
        ['web', 'permission:view-user'], 'uses' => UsersController::class.'@datatable']);

        Route::get('/add', ['as' => 'addUser', 'middleware' =>
        ['web', 'permission:add-user'], 'uses' => UsersController::class.'@add']);

        Route::post('/save', ['as' => 'saveUser', 'middleware' =>
        ['web', 'permission:add-user'], 'uses' => UsersController::class.'@save']);

        Route::get('/edit/{id}', ['as' => 'editUser', 'middleware' =>
        ['web', 'permission:view-user'], 'uses' => UsersController::class.'@edit']);

        Route::post('save/{id}', ['as' => 'updateUser', 'middleware' =>
        ['web', 'permission:update-user'], 'uses' => UsersController::class.'@update']);

        Route::get('delete/{id}', ['as' => 'deleteUser', 'middleware' =>
        ['web', 'permission:delete-user'], 'uses' => UsersController::class.'@delete']);

    });

    // Blog Management
    Route::prefix('blog')->group(function () {
        // Category
        Route::get('/allCat', ['as' => 'allBlogCat', 'uses' => BlogCategoryController::class.'@allBlogCat']);
        Route::get('/allCatDatabase', ['as' => 'allCatDatabase', 'uses' => BlogCategoryController::class.'@allCatDatabase']);
        Route::get('/addCat', ['as' => 'addCat', 'uses' => BlogCategoryController::class.'@addCat']);
        Route::post('/saveCat/', ['as' => 'saveCat', 'uses' => BlogCategoryController::class.'@saveCat']);
        Route::get('/editCat/{id?}', ['as' => 'editCat', 'uses' => BlogCategoryController::class.'@editCat']);
        Route::post('updateCat/{id?}', ['as' => 'updateCat', 'uses' => BlogCategoryController::class.'@updateCat']);
        Route::get('deleteCat/{id?}', ['as' => 'deleteCat', 'uses' => BlogCategoryController::class.'@deleteCat']);

        // Blog
        Route::get('/allBlog', ['as' => 'allBlog', 'uses' => BlogController::class.'@allBlog']);
        Route::get('/allBlogDatabase', ['as' => 'allBlogDatabase', 'uses' => BlogController::class.'@allBlogDatabase']);
        Route::get('/addBlog', ['as' => 'addBlog', 'uses' => BlogController::class.'@addBlog']);
        Route::post('/saveBlog/', ['as' => 'saveBlog', 'uses' => BlogController::class.'@saveBlog']);
        Route::get('/editBlog/{id?}', ['as' => 'editBlog', 'uses' => BlogController::class.'@editBlog']);
        Route::post('updateBlog/{id?}', ['as' => 'updateBlog', 'uses' => BlogController::class.'@updateBlog']);
        Route::get('deleteBlog/{id?}', ['as' => 'deleteBlog', 'uses' => BlogController::class.'@deleteBlog']);
    });

    // News Management
    Route::prefix('news')->group(function () {
        // Category
        Route::get('/allNewsCat', ['as' => 'allNewsCat', 'uses' => NewsCategoryController::class.'@allBlogCat']);
        Route::get('/allNewsCatDatabase', ['as' => 'allNewsCatDatabase', 'uses' => NewsCategoryController::class.'@allCatDatabase']);
        Route::get('/addNewsCat', ['as' => 'addNewsCat', 'uses' => NewsCategoryController::class.'@addCat']);
        Route::post('/saveNewsCat/', ['as' => 'saveNewsCat', 'uses' => NewsCategoryController::class.'@saveCat']);
        Route::get('/editNewsCat/{id?}', ['as' => 'editNewsCat', 'uses' => NewsCategoryController::class.'@editCat']);
        Route::post('updateNewsCat/{id?}', ['as' => 'updateNewsCat', 'uses' => NewsCategoryController::class.'@updateCat']);
        Route::get('deleteNewsCat/{id?}', ['as' => 'deleteNewsCat', 'uses' => NewsCategoryController::class.'@deleteCat']);

        // News
        Route::get('/allNews', ['as' => 'allNews', 'uses' => NewsController::class.'@all']);
        Route::get('/allNewsDatabase', ['as' => 'allNewsDatabase', 'uses' => NewsController::class.'@allNewsDatabase']);
        Route::get('/addNews', ['as' => 'addNews', 'uses' => NewsController::class.'@add']);
        Route::post('/saveNews', ['as' => 'saveNews', 'uses' => NewsController::class.'@saveNews']);
        Route::get('/editNews/{id?}', ['as' => 'editNews', 'uses' => NewsController::class.'@editNews']);
        Route::post('updateNews/{id?}', ['as' => 'updateNews', 'uses' => NewsController::class.'@updateNews']);
        Route::get('deleteNews/{id?}', ['as' => 'deleteNews', 'uses' => NewsController::class.'@deleteNews']);
    });

    // Events Management
    Route::prefix('events')->group(function () {
        // Category
        Route::get('/allEventsCat', ['as' => 'allEventsCat', 'uses' => EventCategoryController::class.'@allBlogCat']);
        Route::get('/allEventsCatDatabase', ['as' => 'allEventsCatDatabase', 'uses' => EventCategoryController::class.'@allCatDatabase']);
        Route::get('/addEventsCat', ['as' => 'addEventsCat', 'uses' => EventCategoryController::class.'@addCat']);
        Route::post('/saveEventsCat/', ['as' => 'saveEventsCat', 'uses' => EventCategoryController::class.'@saveCat']);
        Route::get('/editEventsCat/{id?}', ['as' => 'editEventsCat', 'uses' => EventCategoryController::class.'@editCat']);
        Route::post('updateEventsCat/{id?}', ['as' => 'updateEventsCat', 'uses' => EventCategoryController::class.'@updateCat']);
        Route::get('deleteEventsCat/{id?}', ['as' => 'deleteEventsCat', 'uses' => EventCategoryController::class.'@deleteCat']);

        // Events
        Route::get('/allEvent', ['as' => 'allEvent', 'uses' => EventController::class.'@allEvents']);
        Route::get('/allEventDatatable', ['as' => 'allEventDatatable', 'uses' => EventController::class.'@allEventsDatabase']);
        Route::get('/addEvent', ['as' => 'addEvent', 'uses' => EventController::class.'@addEvents']);
        Route::post('/saveEvent/', ['as' => 'saveEvent', 'uses' => EventController::class.'@saveEvents']);
        Route::get('/editEvent/{id?}', ['as' => 'editEvent', 'uses' => EventController::class.'@editEvents']);
        Route::post('updateEvent/{id?}', ['as' => 'updateEvent', 'uses' => EventController::class.'@updateEvents']);
        Route::get('deleteEvent/{id?}', ['as' => 'deleteEvent', 'uses' => EventController::class.'@deleteEvents']);
        Route::get('deleteGalleryImage/{id?}', ['as' => 'deleteGalleryImage', 'uses' => EventController::class.'@deleteGalleryImage']);
        Route::get('/{id}/status', ['as' => 'statusEvent', 'uses' => EventController::class.'@statusEvent']);
    });

    // Banner Management
    Route::prefix('banners')->middleware(['role:admin'])->group(function () {
        Route::get('/', ['as' => 'allBanner', 'uses' => BannerController::class.'@index']);
        Route::get('/datatable', ['as' => 'allBannerDatatable', 'uses' => BannerController::class.'@datatable']);
        Route::get('/create', ['as' => 'addBanner', 'uses' => BannerController::class.'@add']);
        Route::post('/', ['as' => 'saveBanner', 'uses' => BannerController::class.'@save']);
        Route::get('/{id}/edit', ['as' => 'editBanner', 'uses' => BannerController::class.'@edit']);
        Route::post('/{id}', ['as' => 'updateBanner', 'uses' => BannerController::class.'@update']);
        Route::get('/{id}/status', ['as' => 'statusBanner', 'uses' => BannerController::class.'@status_banner']);
        Route::get('/{id}', ['as' => 'deleteBanner', 'uses' => BannerController::class.'@delete']);
    });

    // Gallery Management
    Route::prefix('galleries')->middleware(['role:admin'])->group(function () {
        Route::get('/', ['as' => 'allGallery', 'uses' => GalleryController::class.'@index']);
        Route::get('/datatable', ['as' => 'allGalleryDatatable', 'uses' => GalleryController::class.'@datatable']);
        Route::get('/create', ['as' => 'addGallery', 'uses' => GalleryController::class.'@add']);
        Route::post('/', ['as' => 'saveGallery', 'uses' => GalleryController::class.'@save']);
        Route::get('/{id}/edit', ['as' => 'editGallery', 'uses' => GalleryController::class.'@edit']);
        Route::post('/{id}', ['as' => 'updateGallery', 'uses' => GalleryController::class.'@update']);
        Route::get('/{id}/status', ['as' => 'statusGallery', 'uses' => GalleryController::class.'@status_banner']);
        Route::get('/{id}', ['as' => 'deleteGallery', 'uses' => GalleryController::class.'@delete']);
    });

    // About Management
    Route::prefix('about')->group(function () {
        Route::get('/allAbout', ['as' => 'allAbout', 'uses' => AboutController::class.'@allAbout']);
        Route::post('/saveAbout', ['as' => 'saveAbout', 'uses' => AboutController::class.'@saveOrUpdateAbout']);
        Route::post('/updateAbout/{id?}', ['as' => 'updateAbout', 'uses' => AboutController::class.'@saveOrUpdateAbout']);

        // Keep these for backward compatibility
        Route::get('/addAbout', ['as' => 'addAbout', 'uses' => AboutController::class.'@addAbout']);
        Route::get('/editAbout/{id?}', ['as' => 'editAbout', 'uses' => AboutController::class.'@editAbout']);
        Route::get('/deleteAbout/{id?}', ['as' => 'deleteAbout', 'uses' => AboutController::class.'@deleteAbout']);
    });

    // Ads Image Management
    Route::prefix('addsImage')->group(function () {
        Route::get('/all-ads-image', ['as' => 'allAddsImage', 'uses' => AdsController::class.'@addImage']);
        Route::post('/save-ads-image', ['as' => 'saveAddsImage', 'uses' => AdsController::class.'@save']);
        Route::post('/update-ads-image/{id}', ['as' => 'updateAddsImage', 'uses' => AdsController::class.'@update']);
    });

    // Contact Management
    Route::prefix('contact')->group(function () {
        Route::get('/allContact', ['as' => 'allContact', 'uses' => ContactController::class.'@allContact']);
        Route::get('/allContactDatabase', ['as' => 'allContactDatabase', 'uses' => ContactController::class.'@allContactDatabase']);
        Route::get('/viewContact/{id?}', ['as' => 'viewContact', 'uses' => ContactController::class.'@viewContact']);
        Route::get('deleteContact/{id?}', ['as' => 'deleteContact', 'uses' => ContactController::class.'@deleteContact']);
    });

    // Airdrops Management
    Route::prefix('airdrops')->group(function () {
        Route::get('/all', ['as' => 'allairdrops', 'uses' => AirDropsController::class.'@all']);
        Route::get('/datatable', ['as' => 'allairdropsDatabase', 'uses' => AirDropsController::class.'@datatable']);
        Route::get('/add', ['as' => 'addAirdrop', 'uses' => AirDropsController::class.'@add']);
        Route::post('/save', ['as' => 'saveAirdrop', 'uses' => AirDropsController::class.'@save']);
        Route::get('/edit/{id?}', ['as' => 'editAirDrop', 'uses' => AirDropsController::class.'@edit']);
        Route::post('/update/{id?}', ['as' => 'updateAirDrop', 'uses' => AirDropsController::class.'@update']);
        Route::get('delete/{id?}', ['as' => 'deleteairdrops', 'uses' => AirDropsController::class.'@delete']);
    });

    // ICO Management
    Route::prefix('ico')->group(function () {
        Route::get('/all', ['as' => 'allICO', 'uses' => ICOController::class.'@all']);
        Route::get('/datatable', ['as' => 'allICODatatable', 'uses' => ICOController::class.'@datatable']);
        Route::get('/add', ['as' => 'addICO', 'uses' => ICOController::class.'@add']);
        Route::post('/save', ['as' => 'saveICO', 'uses' => ICOController::class.'@save']);
        Route::get('/edit/{id?}', ['as' => 'editICO', 'uses' => ICOController::class.'@edit']);
        Route::post('/update/{id?}', ['as' => 'updateICO', 'uses' => ICOController::class.'@update']);
        Route::get('/delete/{id?}', ['as' => 'deleteICO', 'uses' => ICOController::class.'@delete']);
        Route::get('/{id}/status', ['as' => 'statusICO', 'uses' => ICOController::class.'@statusICO']);
    });
});
