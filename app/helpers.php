<?php

use App\Models\ApplicationSetting;
use App\Models\ApplicationSettingCategory;
use App\Models\ClienteleCategory;
use App\Models\Cms;
use App\Models\FaqCategory;
use App\Models\news;
use App\Models\PhotoGallery;
use App\Models\PhotoGalleryCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceType;
use App\Models\Statistics;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists("uniqueCode")) {
    function uniqueCode($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
if (!function_exists("getOnlyNameFromImage")) {
    function getOnlyNameFromImage($image)
    {
        $name = $image->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        return str_replace(' ', '-', $filename);
    }
}
if (!function_exists("uploadImage")) {
    function uploadImage($image, $path)
    {
        if ($image != '') {
            $name = getOnlyNameFromImage($image) . '_' . uniqueCode(9) . '.' . $image->extension();
            $image->move(public_path($path), $name);
            return $name;
        }
    }
}
if (!function_exists("uploadMultipleImage")) {
    function uploadMultipleImage($images, $path, $altText, $oldData)
    {
        $data = $oldData != null ? json_decode($oldData, true) : [];
        if ($data != [] && $altText != null) {
            foreach ($altText as $key => $text) {
                $data[$key]['alt_text'] = $text;
            }
        }
        $count = count($data);
        if ($images != null) {
            foreach ($images as $key => $image) {
                $data[$count + $key]['path'] = uploadImage($image, $path);
                $data[$count + $key]['alt_text'] = '';
            }
        }
        return json_encode($data);
    }
}
if (!function_exists("uploadImageAPI")) {
    function uploadImageAPI($image, $path)
    {
        if ($image != '') {
            $fileName = getOnlyNameFromImage($image) . '_' . uniqueCode(9) . "." . pathinfo($image, PATHINFO_EXTENSION);
            $fullPath = $path . $fileName;
            // Copy the file to the public folder
            if (file_exists($image)) {
                copy($image, $fullPath);
            }
            return $fileName;
        }
    }
}
if (!function_exists("uploadMultipleImagesAPI")) {
    function uploadMultipleImagesAPI($images, $path, $data)
    {
        if ($images != '') {
            foreach (json_decode($images) as $key => $image) {
                $data[$key]['path'] = uploadImageAPI($image['path'], $path);
                $data[$key]['alt_text'] = $image['alt_text'];
            }
            return $data;
        }
    }
}
if (!function_exists("removeImage")) {
    function removeImage($image, $path)
    {
        if (!empty($image) && file_exists(public_path($path . $image))) {
            unlink(public_path($path . $image));
        }
    }
}
if (!function_exists("removeMultipleImages")) {
    function removeMultipleImages($images, $path)
    {
        if (!empty($images)) {
            foreach ($images as $image) {
                if (!empty($image) && file_exists(public_path($path . $image))) {
                    unlink(public_path($path . $image));
                }
            }
        }
    }
}
if (!function_exists("formatDate")) {

    function formatDate($date)
    {
        return $date != '' ? date('M d, Y', strtotime($date)) : '';
    }
}

if (!function_exists("formatDateTime")) {

    function formatDateTime($date)
    {
        return $date != '' ? date('M d, Y h:i A', strtotime($date)) : '';
    }
}

if (!function_exists("formatTime")) {

    function formatTime($date)
    {
        return $date != '' ? date('h:i A', strtotime($date)) : '';
    }
}

if (!function_exists("currencySymbol")) {

    function currencySymbol()
    {
        return applicationSettings('currency-symbol');
    }
}


if (!function_exists("formatAmount")) {

    function formatAmount($amount)
    {
        if ($amount > 0) {
            return applicationSettings('currency-symbol') . number_format($amount, 2);
        } else {
            return null;
        }
    }
}

if (!function_exists("applicationSettings")) {
    function applicationSettings($slug)
    {
        $applicationSettings = ApplicationSetting::where('slug', $slug)->first();
        return $applicationSettings != null ? $applicationSettings->value : '';
    }
}
if (!function_exists("applicationSettingsAltText")) {
    function applicationSettingsAltText($slug)
    {
        $applicationSettings = ApplicationSetting::where('slug', $slug)->first();
        return $applicationSettings != null ? $applicationSettings->alt_text : '';
    }
}
if (!function_exists("applicationCategorySettings")) {
    function applicationCategorySettings($categoryName)
    {
        $category = ApplicationSettingCategory::where('name', $categoryName)->first();
        if ($category != null) {
            return ApplicationSetting::where('category_id', $category->id)->get();
        } else {
            return null;
        }
    }
}
if (!function_exists("mainMenu")) {
    function mainMenu()
    {
        return Cms::where('parent', 'root')
            ->where('main_menu', 1)
            ->where('publish', 1)
            ->orderBy('sort')
            ->get();
    }
}
if (!function_exists("getSubMenu")) {
    function getSubMenu($id)
    {
        return Cms::where('parent', $id)
            ->where('publish', 1)
            ->orderBy('sort')
            ->get();
    }
}
if (!function_exists("footerMenu")) {
    function footerMenu()
    {
        return Cms::where('footer_menu', 1)
            ->where('publish', 1)
            ->orderBy('sort')
            ->get();
    }
}
if (!function_exists("topMenu")) {
    function topMenu()
    {
        return Cms::where('parent', 'root')
            ->where('top_menu', 1)
            ->where('publish', 1)
            ->orderBy('sort')
            ->get();
    }
}
if (!function_exists("pageLink")) {
    function pageLink($type, $slug, $customUrl)
    {
        if ($slug === 'home') {
            return url('/');
        } elseif ($type === 'nopage') {
            return '#';
        } else {
            return $customUrl ?: url("/$slug");
        }
    }
}
if (!function_exists("getUsers")) {
    function getUsers()
    {
        $users = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->select('users.id', 'roles.name as role_name', 'users.name as user_name')
            ->where('roles.name', '!=', DEVELOPER_ROLE)
            ->get();
        return $users;
    }
}
if (!function_exists("getUserName")) {
    function getUserName($id)
    {
        $user = User::find($id);
        return $user != '' ? $user->name : '';
    }
}
if (!function_exists("getUserRole")) {
    function getUserRole($id)
    {
        $user = User::find($id);
        return $user->roles->first() != '' ? $user->roles->first()->name : '';
    }
}
if (!function_exists("getLoggedInUserRole")) {
    function getLoggedInUserRole()
    {
        return getUserRole(Auth::user()->id);
    }
}
if (!function_exists("getLoggedInUser")) {
    function getLoggedInUser()
    {
        return User::find(Auth::user()->id);
    }
}
if (!function_exists("getAPIUser")) {
    function getAPIUser()
    {
        $authenticatedUser = auth('api')->user();
        if ($authenticatedUser !== null) {
            return User::find($authenticatedUser->id);
        } else {
            return User::find(1);
        }
    }
}
if (!function_exists("getSTats")) {
    function getStats()
    {
        return Statistics::all();
    }
}
if (!function_exists("getColor")) {
    function getColor()
    {
        $setting = ApplicationSetting::all();
        $color = $setting['4']->value;
        return $color;
    }
}
if (!function_exists("getPageNames")) {
    function getPageNames($pageType, $pageIds)
    {
        if (array_key_exists($pageType, PAGE_TYPES)) {
            if (!empty($pageIds)) {
                $pageNames = PAGE_TYPES[$pageType]->whereIn('id', $pageIds)->pluck('title')->implode(', ');
            } else {
                $pageNames = PAGE_TYPES[$pageType]->where('publish', 1)->pluck('title', 'id');
            }
        } else {
            $pageNames = null;
        }
        return $pageNames;
    }
}
if (!function_exists("getFaqCategory")) {
    function getFaqCategory($type, $id)
    {
        return FaqCategory::where('page_type', $type)->whereJsonContains('page_name', (string) $id)->first();
    }
}
if (!function_exists("getServiceCategory")) {
    function getServiceCategory($slug)
    {
        return ServiceCategory::where('slug', $slug)->first();
    }
}
if (!function_exists("getServices")) {
    function getServices()
    {
        $category = ServiceCategory::where('name', 'Services')->first();
        $services = $category != null ? Service::where('service_category_id', $category->id)->get() : null;
        return $services;
    }
}

if (!function_exists("getServicesCurrentTop")) {
    function getServicesCurrentTop($currentServiceId)
    {
        // Retrieve the category named 'Services'
        $category = ServiceCategory::where('name', 'Services')->first();

        // Retrieve all services under the category if it exists
        $services = $category != null ? Service::where('service_category_id', $category->id)->get() : null;

        // If there are services and the current service ID is provided
        if ($services && $currentServiceId) {
            // Find the index of the current service in the services array
            $currentIndex = $services->search(function ($service) use ($currentServiceId) {
                return $service->id == $currentServiceId;
            });

            // If the current service is found, remove it from the array and place it at the top
            if ($currentIndex !== false) {
                $currentService = $services->pull($currentIndex);
                $services->prepend($currentService);
            }
        }

        return $services;
    }
}

if (!function_exists("getClienteleCategory")) {
    function getClienteleCategory($slug)
    {
        return ClienteleCategory::where('type', $slug)->first();
    }
}

if (!function_exists("getPhotoGalleryByCategory")) {
    function getPhotoGalleryByCategory($slug)
    {
        $category = PhotoGalleryCategory::where('type', $slug)->first();
        $photoGallery = $category != null
            ? PhotoGallery::where('photo_category_id', $category->id)->first()
            : null;
        return $photoGallery ? $photoGallery->image_gallery : null;
    }
}

if (!function_exists("latestNews")) {
    function latestNews()
    {
        return news::orderBy('created_at', 'desc')->limit(3)->get();
    }
}

if (!function_exists("latestServiceTypes")) {
    function latestServiceTypes($slug)
    {
        $serviceType = ServiceType::where('slug', $slug)->first();
        $serviceCategories = $serviceType
            ? ServiceCategory::where('service_type_id', $serviceType->id)->get()->pluck('id')->unique()->toArray()
            : null;
        $services = $serviceCategories
            ? Service::whereIn('service_category_id', $serviceCategories)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            : null;
        return $services;
    }
}

if (!function_exists("serviceTypes")) {
    function serviceTypes($slug)
    {
        $serviceType = ServiceType::where('slug', $slug)->first();
        $serviceCategories = $serviceType
            ? ServiceCategory::where('service_type_id', $serviceType->id)->get()->pluck('id')->unique()->toArray()
            : null;
        $services = $serviceCategories
            ? Service::whereIn('service_category_id', $serviceCategories)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            : null;
        return $services;
    }
}


if (!function_exists("getStripeKey")) {
    function getStripeKey()
    {
        $paymentMethod = DB::table('payment_methods')->where('payment_method_name', 'Stripe')->first();
        $paymentMode  = ApplicationSetting::where('slug', 'payment-mode')->first();
        if ($paymentMethod) {
            $key = $paymentMode->value == 'sandbox' ? $paymentMethod->sandbox_key : $paymentMethod->live_key;
            return $key;
        } else {
            return null;
        }
    }
}
if (!function_exists("getStripeSecret")) {
    function getStripeSecret()
    {
        $paymentMethod = DB::table('payment_methods')->where('payment_method_name', 'Stripe')->first();
        $paymentMode  = ApplicationSetting::where('slug', 'payment-mode')->first();
        if ($paymentMethod) {
            $secret = $paymentMode->value == 'sandbox' ? $paymentMethod->sandbox_secret : $paymentMethod->live_secret;
            return $secret;
        } else {
            return null;
        }
    }
}

if (!function_exists("getClassNameFromStatus")) {
    function getClassNameFromStatus($status) {
        switch ($status) {
            case NEW_REQUEST:
            case PENDING:
                return 'request-new';
            case RESCHEDULE_REQUEST:
            case RESCHEDULE_REQUEST_OLD:
                return 'request-reschedule';
            case CANCEL_REQUEST:
            case CANCEL_REQUEST_OLD:
                return 'request-cancel';
            default:
                return ''; // or a default class if needed
        }
    }
}
