<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\ApplicationSettings\ApplicationSettingController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\Auth\SocialLoginController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Controllers\OldDataController;
use App\Http\Controllers\OldHallController;
use App\Http\Controllers\OldTempleTourController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});
// Route::get('/', [App\Http\Controllers\PagesController::class, 'index']);
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/admin/style-guide', 'style-guide');
Auth::routes(['register' => false]);

// Customer routes
Route::controller(CustomerLoginController::class)->group(function () {
    // login route
    Route::get('user-login', 'login');
    Route::post('user-login', 'submit');
    Route::post('user-logout', 'logout');
});
Route::get('/login/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

Route::post('/contact-form-submission', [App\Http\Controllers\PagesController::class, 'contactSubmission'])->middleware(ProtectAgainstSpam::class);
Route::post('/booking-form-submission', [App\Http\Controllers\PagesController::class, 'bookingSubmission'])->middleware(ProtectAgainstSpam::class);

Route::middleware(['auth'])->controller(UserHomeController::class)->group(function () {
    Route::get('profile', 'profile');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    /* CK Editor Image Upload */
    Route::post(
        '/ckeditor-file-upload',
        [App\Http\Controllers\HomeController::class, 'ckeditorFileUpload']
    )->name('ckeditor-file-upload');
    Route::view('/browse', 'browse');
    /* Media Routes */
    Route::controller(MediaController::class)->group(function () {
        Route::get('media', 'media');
        Route::post('upload-media', 'uploadMedia');
        Route::get('remove-media/{img}', 'removeMedia');
    });
    /* Activity Log */
    Route::get('activity-log', [App\Http\Controllers\HomeController::class, 'activityLog']);
    /* User Management Routes */
    Route::resource('permissions', App\Http\Controllers\UserManagement\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\UserManagement\RoleController::class);
    Route::controller(UserController::class)->group(function () {
        Route::resource('users', UserController::class);
        Route::get('users/reset/{id}', 'reset');
        Route::post('users/reset', 'resetPassword');
    });
    /* Application Settings */
    Route::resource(
        'applicationSettingTypes',
        App\Http\Controllers\ApplicationSettings\ApplicationSettingTypeController::class
    );
    Route::resource(
        'applicationSettingCategories',
        App\Http\Controllers\ApplicationSettings\ApplicationSettingCategoryController::class
    );
    Route::controller(ApplicationSettingController::class)->group(function () {
        Route::resource('applicationSettings', ApplicationSettingController::class);
        Route::get('settings', 'settingsView');
        Route::post('update-application-settings', 'updateSettings');
        Route::get('remove-multiple-image-item/{id}/{key}', 'removeGalleryItem');
    });
    /* Slider */
    Route::resource('sliders', App\Http\Controllers\SliderController::class);
    /* CMS */
    Route::resource('cms', App\Http\Controllers\CmsController::class);
    /* Services */
    Route::resource('serviceCategories', App\Http\Controllers\ServiceCategoryController::class);
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    Route::get('remove-multiple-service-image-item/{id}/{key}', [App\Http\Controllers\ServiceController::class, 'removeGalleryItem']);
    Route::resource('clienteleCategories', App\Http\Controllers\ClienteleCategoryController::class);
    Route::resource('clienteles', App\Http\Controllers\ClienteleController::class);
    Route::resource('blogCategories', App\Http\Controllers\BlogCategoryController::class);
    Route::resource('blogPosts', App\Http\Controllers\BlogPostController::class);
    Route::get('remove-multiple-blogPosts-image-item/{id}/{key}', [App\Http\Controllers\BlogPostController::class, 'removeGalleryItem']);
    Route::resource('testimonialCategories', App\Http\Controllers\TestimonialCategoryController::class);
    Route::resource('testimonials', App\Http\Controllers\TestimonialController::class);
    Route::resource('statistics', App\Http\Controllers\StatisticsController::class);
    Route::resource('productCategories', App\Http\Controllers\ProductCategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::get('remove-multiple-products-image-item/{id}/{key}', [App\Http\Controllers\ProductController::class, 'removeGalleryItem']);
    Route::resource('teamCategories', App\Http\Controllers\TeamCategoryController::class);
    Route::resource('teams', App\Http\Controllers\TeamController::class);
    Route::resource('faqCategories', App\Http\Controllers\FaqCategoryController::class);
    Route::post('get-page-names-list', [App\Http\Controllers\FaqCategoryController::class, 'getPageNamesList']);
    Route::resource('faqs', App\Http\Controllers\FaqController::class);
    Route::resource('photoGalleryCategories', App\Http\Controllers\PhotoGalleryCategoryController::class);
    Route::resource('photoGalleries', App\Http\Controllers\PhotoGalleryController::class);
    Route::get('/remove-multiple-photoGallery-image-item/{id}/{key}', [App\Http\Controllers\PhotoGalleryController::class, 'removeGalleryItem']);
    Route::resource('serviceTypes', App\Http\Controllers\ServiceTypeController::class);
    Route::resource('newsCategories', App\Http\Controllers\newsCategoryController::class);
    Route::resource('news', App\Http\Controllers\newsController::class);
    Route::get('/remove-multiple-news-image-item/{id}/{key}', [App\Http\Controllers\newsController::class, 'removeGalleryItem']);

    Route::resource('paymentMethods', App\Http\Controllers\PaymentMethodController::class);
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('coupons', App\Http\Controllers\CouponController::class);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::get('/accept-order/{id}', [App\Http\Controllers\OrderController::class, 'acceptOrder']);
    Route::get('/decline-order/{id}', [App\Http\Controllers\OrderController::class, 'declineOrder']);
    Route::post('/decline-order', [App\Http\Controllers\OrderController::class, 'declineOrderSubmission'])->name('order.decline');
    Route::get('/complete-order/{id}', [App\Http\Controllers\OrderController::class, 'completeOrder']);

    /* Event Management */
    Route::resource('eventCategories', App\Http\Controllers\EventCategoryController::class);
    Route::resource('events', App\Http\Controllers\EventController::class);

    /* Frontend Users */
    Route::resource('frontendUsers', App\Http\Controllers\FrontendUserController::class);

    /* Puja Management */
    Route::resource('pujas', App\Http\Controllers\PujaController::class);
    Route::resource('pujaOrders', App\Http\Controllers\PujaOrderController::class);

    /* Hall Management */
    Route::resource('halls', App\Http\Controllers\HallController::class);
    Route::resource('hallAddons', App\Http\Controllers\HallAddonController::class);
    Route::resource('hallEventTypes', App\Http\Controllers\HallEventTypeController::class);
    Route::resource('hallOrders', App\Http\Controllers\HallOrderController::class);

    /* Temple Tour Manager */
    Route::resource('templeTours', App\Http\Controllers\TempleTourController::class);

    /**
     * Old Data Management
     */
    Route::get('/old-puja-requests', [OldDataController::class, 'index'])->name('old.puja.requests');
    Route::get('/old-puja-requests/{id}', [OldDataController::class, 'show'])->name('old.puja.requests.show');
    Route::get('/old-tour-requests', [OldTempleTourController::class, 'index'])->name('old.tour.requests');
    Route::get('/old-tour-requests/{id}', [OldTempleTourController::class, 'show'])->name('old_templetours.show');
    Route::get('/old-hall-requests', [OldHallController::class, 'index'])->name('old.hall.requests');
    Route::get('/old-hall-requests/{id}', [OldHallController::class, 'show'])->name('old_hallrequest.show');
});

/* Old Site Links Redirection */
Route::get('/index.html', function () {
    return Redirect::to('/', 301);
});

Route::middleware(['auth:customers'])->controller(CustomerHomeController::class)->group(function () {
    Route::get('/profile', 'profile');
    Route::get('/orders', 'orders');
    Route::post('/update-profile', 'updateProfile');
    Route::get('view-order/{id}', 'viewOrder');
});

Route::controller(PagesController::class)->group(function () {
    Route::get('/blog', 'blog');
    Route::get('/blog/{slug}', 'blogDetails');
    Route::get('/news', 'news');
    Route::get('/news/{slug}', 'newsDetails');
    Route::get('/our-team', 'ourTeam');
    Route::get('/services', 'ourServices');
    Route::get('/menu', 'product');

    Route::get('/services/{name}', 'serviceDetails');
    Route::get('/our-dentists/{name}', 'teamDetails');
    Route::get('/blogs/{name}', 'categoryBlog');

    Route::get('/testimonials/{name}', 'testimonialCategory');
    Route::get('/testimonials', 'testimonials');
    Route::get('/contact', 'contact');

    Route::get('/order--pickup', 'orderPickup');
    Route::get('/products/{name}', 'productDetails');
    Route::get('/search-results', 'searchResults');

    Route::get('/online-order', 'onlineOrder');
    Route::post('/add-to-cart', 'addToCart');
    Route::post('/remove-from-cart', 'removeFromCart');
    Route::get('/cart', 'cart');
    Route::get('/cart-count', function () {
        $cart = session()->get('cart', []);
        $distinctItemCount = count($cart);
        Log::info('cart', [$cart]);
        return response()->json(['count' => $distinctItemCount]);
    })->name('cart.count');
    Route::get('/checkout', 'checkout');
    Route::post('/checkout', 'proceedCheckout');
    Route::get('/checkoutsuccess', 'handleCheckoutSuccess');
    Route::get('/order-confirmation', 'orderConfirmation')
        ->name('order.confirmation');

    Route::get('/{slug}', 'innerPageView');
});
