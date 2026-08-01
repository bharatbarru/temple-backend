<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Login URL */

Route::post('login', [App\Http\Controllers\API\AuthAPIController::class, 'login']);

Route::middleware(['auth.token'])->group(function () {
    /* Logout URL */
    Route::post('/logout', [App\Http\Controllers\API\AuthAPIController::class, 'logout']);

    /* User Management */
    Route::resource('permissions', App\Http\Controllers\API\UserManagement\PermissionAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('roles', App\Http\Controllers\API\UserManagement\RoleAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('users', App\Http\Controllers\API\UserManagement\UserAPIController::class)
        ->except(['create', 'edit']);

    /* Application Settings */
    Route::resource('applicationSettingTypes', App\Http\Controllers\API\ApplicationSettings\ApplicationSettingTypeAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('applicationSettingCategories', App\Http\Controllers\API\ApplicationSettings\ApplicationSettingCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('applicationSettings', App\Http\Controllers\API\ApplicationSettings\ApplicationSettingAPIController::class)
        ->except(['create', 'edit', 'index']);

    /* Slider */
    Route::resource('sliders', App\Http\Controllers\API\SliderAPIController::class)
        ->except(['create', 'edit', 'index']);

    /* CMS */
    Route::resource('cms', App\Http\Controllers\API\CmsAPIController::class)
        ->except(['create', 'edit', 'index', 'show']);

    /* Services */
    Route::resource('serviceCategories', App\Http\Controllers\API\ServiceCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('services', App\Http\Controllers\API\ServiceAPIController::class)
        ->except(['create', 'edit', 'show']);

    Route::resource('clienteleCategories', App\Http\Controllers\API\ClienteleCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('clienteles', App\Http\Controllers\API\ClienteleAPIController::class)
        ->except(['create', 'edit', 'show']);

    Route::resource('blog-categories', App\Http\Controllers\API\BlogCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('blog-posts', App\Http\Controllers\API\BlogPostAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('testimonial-categories', App\Http\Controllers\API\TestimonialCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('testimonials', App\Http\Controllers\API\TestimonialAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('statistics', App\Http\Controllers\API\StatisticsAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('product-categories', App\Http\Controllers\API\ProductCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('products', App\Http\Controllers\API\ProductAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('team-categories', App\Http\Controllers\API\TeamCategoryAPIController::class)
        ->except(['create', 'edit', 'index']);

    Route::resource('teams', App\Http\Controllers\API\TeamAPIController::class)
        ->except(['create', 'edit', 'show']);

    Route::resource('faq-categories', App\Http\Controllers\API\FaqCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('faqs', App\Http\Controllers\API\FaqAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('photo-gallery-categories', App\Http\Controllers\API\PhotoGalleryCategoryAPIController::class)
        ->except(['create', 'edit', 'index']);

    Route::resource('photo-galleries', App\Http\Controllers\API\PhotoGalleryAPIController::class)
        ->except(['create', 'edit', 'index', 'show']);

    Route::resource('service-types', App\Http\Controllers\API\ServiceTypeAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('news-categories', App\Http\Controllers\API\newsCategoryAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('news', App\Http\Controllers\API\newsAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('paymentMethods', App\Http\Controllers\API\PaymentMethodAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('customers', App\Http\Controllers\API\CustomerAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('customers', App\Http\Controllers\API\CustomerAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('coupons', App\Http\Controllers\API\CouponAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class)
        ->except(['create', 'edit']);

    /* Event Management */
    Route::resource('eventCategories', App\Http\Controllers\API\EventCategoryAPIController::class)
        ->except(['create', 'edit', 'index']);

    Route::resource('events', App\Http\Controllers\API\EventAPIController::class)
        ->except(['create', 'edit', 'index']);

    /* Frontend Users */
    Route::resource('frontendUsers', App\Http\Controllers\API\FrontendUserAPIController::class)
        ->except(['create', 'edit']);

    /* Puja Management */
    Route::resource('pujas', App\Http\Controllers\API\PujaAPIController::class)
        ->except(['create', 'edit']);

    Route::resource('pujaOrders', App\Http\Controllers\API\PujaOrderAPIController::class)
        ->except(['create', 'edit', 'store']);
    
    /* Hall Management */
    Route::resource('halls', App\Http\Controllers\API\HallAPIController::class)
        ->except(['create', 'edit', 'index']);

    Route::resource('hallAddons', App\Http\Controllers\API\HallAddonAPIController::class)
        ->except(['create', 'edit']);
        
    Route::resource('hallEventTypes', App\Http\Controllers\API\HallEventTypeAPIController::class)
        ->except(['create', 'edit']);
        
    Route::resource('hallOrders', App\Http\Controllers\API\HallOrderAPIController::class)
        ->except(['create', 'edit', 'store']);

    /* Temple Tour Manager */    
    Route::resource('templeTours', App\Http\Controllers\API\TempleTourAPIController::class)
        ->except(['create', 'edit', 'store']);
});

/* Frontend API */
Route::get('cms', [App\Http\Controllers\API\CmsAPIController::class, 'index']);
Route::get('cms/{slug}', [App\Http\Controllers\API\CmsAPIController::class, 'show']);

Route::get('applicationSettings', [App\Http\Controllers\API\ApplicationSettings\ApplicationSettingAPIController::class, 'index']);
Route::get('sliders', [App\Http\Controllers\API\SliderAPIController::class, 'index']);

Route::get('photo-galleries', [App\Http\Controllers\API\PhotoGalleryAPIController::class, 'index']);
Route::get('photo-galleries/{id}', [App\Http\Controllers\API\PhotoGalleryAPIController::class, 'show']);

Route::get('photo-gallery-categories', [App\Http\Controllers\API\PhotoGalleryCategoryAPIController::class, 'index']);

Route::get('team-categories', [App\Http\Controllers\API\TeamCategoryAPIController::class, 'index']);
Route::get('teams/{id}', [App\Http\Controllers\API\TeamAPIController::class, 'show']);

Route::get('clienteles/{slug}', [App\Http\Controllers\API\ClienteleAPIController::class, 'show']);
Route::get('services/{slug}', [App\Http\Controllers\API\ServiceAPIController::class, 'show']);

Route::get('event-categories', [App\Http\Controllers\API\EventCategoryAPIController::class, 'index']);
Route::get('events', [App\Http\Controllers\API\EventAPIController::class, 'index']);

Route::get('pujas', [App\Http\Controllers\API\PujaAPIController::class, 'index']);
Route::get('public/pujas', [App\Http\Controllers\API\PujaAPIController::class, 'publicIndex']);

Route::post('templeTours', [App\Http\Controllers\API\TempleTourAPIController::class, 'store']);
Route::post('pujaOrders', [App\Http\Controllers\API\PujaOrderAPIController::class, 'store']);
Route::post('public/puja-orders', [App\Http\Controllers\API\PujaOrderAPIController::class, 'storePublic']);
Route::post('public/puja-orders/paypal-success', [App\Http\Controllers\API\PujaOrderAPIController::class, 'paypalSuccess']);
Route::post('check-puja-order', [App\Http\Controllers\API\PujaOrderAPIController::class, 'check']);
Route::post('change-puja-order', [App\Http\Controllers\API\PujaOrderAPIController::class, 'change']);
Route::post('cancel-puja-order', [App\Http\Controllers\API\PujaOrderAPIController::class, 'cancel']);




Route::get('halls', [App\Http\Controllers\API\HallAPIController::class, 'index']);
Route::get('hallEventTypes', [App\Http\Controllers\API\HallEventTypeAPIController::class, 'index']);
Route::post('hallOrders', [App\Http\Controllers\API\HallOrderAPIController::class, 'store']);
Route::post('check-hall-order', [App\Http\Controllers\API\HallOrderAPIController::class, 'check']);
Route::post('change-hall-order', [App\Http\Controllers\API\HallOrderAPIController::class, 'change']);
Route::post('cancel-hall-order', [App\Http\Controllers\API\HallOrderAPIController::class, 'cancel']);
