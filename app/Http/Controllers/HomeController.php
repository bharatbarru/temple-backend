<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PhotoGallery;
use App\Models\PhotoGalleryCategory;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\ClienteleCategory;
use App\Models\ServiceCategory;
use App\Models\Cms;
use App\Models\Faq;
use App\Models\Slider;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = BlogPost::count();
        $blogCategories = BlogCategory::count();
        $product = Product::count();
        $productCategories = ProductCategory::count();
        $photos = PhotoGallery::count();
        $photoCategories = PhotoGalleryCategory::count();
        $teams = Team::count();
        $teamCategories = TeamCategory::count();
        $pages = Cms::count();
        $sliders = Slider::count();
        $brands = ClienteleCategory::where('name', 'Our Brands')->first();
        $groupCompines = ClienteleCategory::where('name', 'Group Companies')->first();
        $ourServices = ServiceCategory::where('name', 'Our Services')->first();
        $ourLocations = ServiceCategory::where('name', 'Locations')->first();
        $ourCaterings = ServiceCategory::where('name', 'caterings')->first();
        $faqs = Faq::count();
        return view('home', compact('brands', 'productCategories', 'product', 'pages', 'blogs', 'sliders', 'faqs', 'blogCategories', 'photos', 'photoCategories', 'teams', 'teamCategories', 'groupCompines', 'ourServices', 'ourLocations', 'ourCaterings'));
    }

    public function ckeditorFileUpload(Request $request)
    {
        if ($request->hasfile('upload')) {
            $name = uploadImage($request->file('upload'), CKEDITOR_IMAGE_PATH);
            $url = asset(CKEDITOR_IMAGE_PATH . '/' . $name);
            $response = [
                'uploaded' => true,
                'url' => $url
            ];
            return response()->json($response);
        }
    }

    public function activityLog(Request $request)
    {
        $perPage = $request->per_page ?? 10;

        $query = Activity::query();

        if (!empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'LIKE', '%' . $search . "%")
                    ->orwhere('properties', 'LIKE', '%' . $search . "%");
            });
        }
        if (!empty($request->user)) {
            $query->where('causer_id', $request->user);
        }
        if (!empty($request->from_date)) {
            $query->whereDate('created_at', '>=', date("Y-m-d", strtotime($request->from_date)));
        }
        if (!empty($request->to_date)) {
            $query->whereDate('created_at', '<=', date("Y-m-d", strtotime($request->to_date)));
        }

        $activityLogs = $query->latest()->paginate($perPage);

        return view('log', compact('activityLogs'));
    }
}
