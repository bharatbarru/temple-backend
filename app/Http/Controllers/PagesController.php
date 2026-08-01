<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedAdminMail;
use App\Mail\OrderPlacedUserMail;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Cms;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Faq;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\PhotoGalleryCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
use App\Models\Statistics;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\Testimonial;
use App\Models\TestimonialCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function contactSubmission(Request $request)
    {
        $to = applicationSettings('secondary-email');
        Mail::send(
            'emails.contact',
            array(
                'request' => $request,
            ),
            function ($message) use ($to) {
                $message->to($to)->subject('Art of India Cuisine - Contact Form Submission');
            }
        );
        return view('pages.success');
    }
    public function bookingSubmission(Request $request)
    {
        $to = applicationSettings('secondary-email');
        Mail::send(
            'emails.booking',
            array(
                'request' => $request,
            ),
            function ($message) use ($to) {
                $message->to($to)->subject('Sankranti - Booking Form Submission');
            }
        );
        Mail::send(
            'emails.booking',
            array(
                'request' => $request,
            ),
            function ($message) use ($request) {
                $message->to($request->email)->subject('Sankranti - Table booking submission');
            }
        );
        return view('pages.success');
    }
    public function index()
    {
        $page = Cms::where('slug', 'home')->first();
        $sliders = Slider::where('publish', 1)->orderBy('sort')->get();
        $blogPosts = BlogPost::where('publish', 1)->orderBy('post_date', 'asc')->limit(4)->get();
        // $news = News::all();
        // $newsCategories = NewsCategory::all();
        $specialProducts = Product::where('publish', 1)->where('special_product', 1)->orderBy('post_date', 'asc')->get();
        $productCategories = ProductCategory::where('type', 'home')->take(5)->get();
        $testcategory = TestimonialCategory::where('name', 'HomePage')->first();
        $testimonials = $testcategory != null ? Testimonial::where('testimonial_category_id', $testcategory->id)->limit(4)->get() : null;
        $faqCategory = !empty($page)
            ? !empty($page) ? getFaqCategory('pages', $page->id) : null
            : null;
        $teamCategories = TeamCategory::all();
        $teams = Team::all();
        return view('pages.index', compact('page', 'sliders', 'blogPosts', 'testimonials', 'specialProducts', 'faqCategory', 'teamCategories', 'teams', 'productCategories'));
    }
    public function innerPageView($slug)
    {
        $testcategory = TestimonialCategory::where('name', 'HomePage')->first();
        $testimonials = $testcategory != null ? Testimonial::where('testimonial_category_id', $testcategory->id)->limit(4)->get() : null;
        $teamCategories = TeamCategory::all();
        $teams = Team::all();
        $page = Cms::where('slug', $slug)->firstOrFail();
        $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
        $galleryCategories = PhotoGalleryCategory::where('type', 'gallery')->get();
        // $newsCategories = NewsCategory::all();

        return view('pages.inner-page', compact(
            'page',
            'faqCategory',
            'testimonials',
            'testcategory',
            'teamCategories',
            'teams',
            'galleryCategories',

        ));
    }
    public function blog()
    {
        $page = Cms::where('slug', 'blog')->first();
        $blogPosts = BlogPost::where('publish', 1)->orderBy('post_date', 'asc')->paginate(10);
        $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
        return view('pages.blog', compact('blogPosts', 'faqCategory', 'page'));
    }
    public function blogDetails($slug)
    {
        $blogPost = BlogPost::where('slug', $slug)->first();
        if ($blogPost) {
            $blogPosts = BlogPost::where('publish', 1)->orderBy('post_date', 'asc')->get();
            $blogCategories = BlogCategory::all();
            $faqs = Faq::all();
            $faqCategory = getFaqCategory('blogs', $blogPost->id);
            return view('pages.blog-details', compact('blogPost', 'blogCategories', 'blogPosts', 'faqCategory', 'faqs'));
        } else {
            abort(404);
        }
    }
    public function categoryBlog($name)
    {
        $category = BlogCategory::where('name', $name)->first();
        if ($category) {
            $blogPosts = BlogPost::where('blog_category_id', $category->id)->latest()->paginate(10);
            return view('pages.blog', compact('blogPosts', 'category',));
        } else {
            abort(404);
        }
    }
    public function product()
    {
        $page = Cms::where('slug', 'menu')->first();
        $products = Product::where('publish', 1)->orderBy('sort')->paginate(10);
        $productCategories = ProductCategory::orderBy('sort')->get();
        $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
        return view('pages.product', compact('products', 'productCategories', 'faqCategory', 'page'));
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $productCategories = ProductCategory::all();
            $relatedProducts = Product::latest()->take(10)->get();
            $faqCategory = getFaqCategory('products', $product->id);
            return view('pages.product-detail', compact('product', 'productCategories', 'relatedProducts',  'faqCategory'));
        } else {
            abort(404);
        }
    }
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        $page = Cms::where('slug', 'testimonials')->first();
        $stats = Statistics::all();
        return view('pages.testimonials', compact('testimonials', 'stats', 'page'));
    }
    public function contact()
    {
        $page = Cms::where('slug', 'contact')->first();
        $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
        return view('pages.contact', compact('faqCategory', 'page'));
    }


    public function orderPickup()
    {
        $page = Cms::where('slug', 'order--pickup')->first();
        $sliders = Slider::where('publish', 1)->orderBy('sort')->get();

        return view('pages.order-pickup', compact('page', 'sliders'));
    }





    public function testimonialCategory($name)
    {
        $category = TestimonialCategory::where('name', $name)->first();
        if ($category) {
            $testimonials = Testimonial::where('testimonial_category_id', $category->id)->latest()->paginate(10);
            return view('pages.testimonials', compact('testimonials', 'category', 'stats',));
        } else {
            abort(404);
        }
    }
    public function ourServices()
    {
        $page = Cms::where('slug', 'services')->first();
        $testcategory = TestimonialCategory::where('name', 'HomePage')->first();
        $testimonials = $testcategory != null ? Testimonial::where('testimonial_category_id', $testcategory->id)->limit(4)->get() : null;
        return view('pages.our-services', compact('testimonials', 'testcategory', 'testcategory', 'page'));
    }
    public function serviceDetails($slug)
    {
        $testcategory = TestimonialCategory::where('name', 'HomePage')->first();
        $testimonials = $testcategory != null ? Testimonial::where('testimonial_category_id', $testcategory->id)->limit(4)->get() : null;
        $service = Service::where('slug', $slug)->first();
        if ($service) {
            $serviceCategories = ServiceCategory::all();
            return view('pages.service-details', compact('service', 'serviceCategories', 'testimonials', 'testcategory'));
        } else {
            abort(404);
        }
    }
    public function ourTeam()
    {
        $page = Cms::where('slug', 'our-team')->first();
        $teamCategories = TeamCategory::all();
        $teams = Team::all();
        $testimonials = Testimonial::all();
        $faqCategory = !empty($page)
            ? !empty($page) ? getFaqCategory('pages', $page->id) : null
            : null;
        return view('pages.our-team', compact('testimonials', 'faqCategory', 'teamCategories', 'teams', 'page'));
    }
    public function teamDetails($slug)
    {
        $team = Team::where('slug', $slug)->first();
        if ($team) {
            $teamCategories = TeamCategory::all();
            return view('pages.team-details', compact('team', 'teamCategories',));
        } else {
            abort(404);
        }
    }
    //generate search result function for blog and products
    public function searchResults()
    {
        $search = request()->input('search');
        $blogPosts = BlogPost::where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->paginate(10);
        $products = Product::where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->paginate(10);
        return view('pages.search-results', compact('blogPosts', 'products', 'search'));
    }

    public function news()
    {
        $page = Cms::where('slug', 'news')->first();
        $news = News::all();
        $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
        return view('pages.news', compact('news', 'faqCategory', 'page'));
    }
    public function newsDetails($slug)
    {
        $news = News::where('slug', $slug)->first();
        $category = NewsCategory::where('slug', $slug)->first();
        if ($news) {
            $newsCategories = newsCategory::all();
            $faqs = Faq::all();
            // $faqCategory = getFaqCategory('blogs', $blogPost->id);
            return view('pages.news-details', compact('news', 'newsCategories', 'faqs'));
        } elseif ($category) {
            $page = Cms::where('slug', 'news')->first();
            $news = News::where('news_category_id', $category->id)->get();
            $faqCategory = !empty($page) ? getFaqCategory('pages', $page->id) : null;
            return view('pages.news', compact('news', 'faqCategory', 'page'));
        } else {
            abort(404);
        }
    }

    public function onlineOrder()
    {
        $page = Cms::where('slug', 'online-order')->where('publish', 1)->first();

        if ($page == null) {
            abort(404);
        }

        $productCategories = ProductCategory::orderBy('display_name', 'ASC')->get();
        return view('pages.orders.index', compact('page', 'productCategories'));
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        // Retrieve cart from session or create a new one
        $cart = session()->get('cart', []);

        // Add product to cart
        if (isset($cart[$product_id])) {
            // If the product is already in the cart, update the quantity
            $cart[$product_id]['quantity'] = $quantity;
            $message = 'Cart updated successfully';
        } else {
            // Add new product to the cart
            $cart[$product_id] = [
                'quantity' => $quantity,
                'product_id' => $product_id
            ];
            $message = 'Item added to cart';
        }

        // Save cart to session
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$productId])) {
            // Remove the product from the cart
            unset($cart[$productId]);

            // Update the session with the modified cart
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully.',
                'cart' => $cart  // Optional: return updated cart data
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart.'
        ]);
    }

    public function cart()
    {
        return view('pages.orders.cart');
    }

    public function checkout()
    {
        if (session('cart') && count(session('cart')) > 0) {
            $paymentMethods = PaymentMethod::where('publish', 1)->orderBy('sort')->get();

            // Get available coupons
            $coupons = Coupon::where('publish', 1)
                ->where('valid_from', '<=', now())
                ->where('valid_until', '>=', now())
                ->get();

            if (auth('customers')->check()) {
                // If the user is logged in, filter coupons based on usage limit
                $customerId = auth('customers')->user()->id;
                $coupons = $coupons->filter(function ($coupon) use ($customerId) {
                    // Get the count of times this coupon has been used by the customer
                    $usageCount = Order::where('customer_id', $customerId)
                        ->where('coupon_id', $coupon->id)
                        ->count();

                    // Check if the usage limit is greater than the current usage count
                    return $coupon->usage_limit > $usageCount;
                });
            }

            return view('pages.orders.checkout', compact('paymentMethods', 'coupons'));
        } else {
            return redirect(url('/online-order'));
        }
    }


    public function proceedCheckout(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'order_type' => 'required|string|in:takeaway,home-delivery',
            'coupon_applied' => 'nullable|string|max:50',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()  // Return the first validation error
            ], 400);
        }

        // Retrieve the selected payment method
        $paymentMethod = PaymentMethod::find($request->payment_method);

        if (auth()->guard('customers')->check()) {
            $customer = Customer::find(auth()->guard('customers')->user()->id);
            $customer->mobile = $request->phone;
            $customer->save();
        }

        $coupon = null;
        if ($request->coupon) {
            $coupon = Coupon::where('coupon_code', $request->coupon)->first();
        }
        // Example: Create a new Order record (assuming there's an Order model)
        $order = Order::create([
            'orderid' => Order::generateOrderId(),
            'order_type' => $request->order_type,
            'customer_id' => auth()->guard('customers')->user()->id ?? null,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'delivery_address' => $request->order_type == 'home-delivery' ? $request->delivery_address : null,
            'payment_method_id' => $paymentMethod ? $paymentMethod->id : null,
            'subtotal_amount' => $request->sub_total,
            'coupon_discount' => $request->coupon_discount,
            'tax_amount' => $request->tax,
            'delivery_charge' => $request->delivery_charges,
            'royalty_points_amount' => $request->royalty_points,
            'total_amount' => $request->final_total,
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);
        $order->coupon_id = $coupon ? $coupon->id : null;
        $order->save();

        // Save order products (from the session cart)
        $cart = session()->get('cart');
        if (!empty($cart)) {
            foreach ($cart as $productId => $details) {
                $product = Product::find($productId);
                if ($product) {
                    $price = floatval($product->price);
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $details['quantity'],
                        'price' => $price,
                    ]);
                }
            }
        }


        if ($request->final_total > 0 && $paymentMethod->slug == 'stripe') {
            $stripe = new \Stripe\StripeClient(getStripeSecret());

            $checkout_session = $stripe->checkout->sessions->create([
                'mode' => 'payment',
                'ui_mode' => 'embedded',
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Payment'
                            ],
                            'unit_amount' => $request->final_total * 100,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'return_url' => url('/checkoutsuccess?session_id={CHECKOUT_SESSION_ID}'),
            ]);

            $order->transaction_id = $checkout_session->id; // Store the transaction ID from Stripe
            $order->payment_status = 'pending';
            $order->save();

            // Clear the cart after the order is successfully stored
            session()->forget('cart');

            return response()->json([
                'client_secret' => $checkout_session->client_secret
            ]);
        }

        // Clear the cart after the order is successfully stored
        session()->forget('cart');
        session()->put('order_id', $order->id);

        // Send emails
        $this->sendOrderEmails($order, $request->guest_email);

        // After order creation, you can initiate payment processing, etc.
        return response()->json([
            'success' => true,
            'message' => 'Order successfully placed.',
            'order_id' => $order->id
        ]);
    }

    // Calculate the total amount from the session cart
    // private function calculateTotalAmount()
    // {
    //     $cart = session()->get('cart');
    //     $total = 0;

    //     if ($cart) {
    //         foreach ($cart as $productId => $details) {
    //             $product = Product::find($productId);
    //             if ($product) {
    //                 $price = floatval($product->price);
    //                 $total += $price * $details['quantity'];
    //             }
    //         }
    //     }

    //     return $total;
    // }

    public function orderConfirmation()
    {
        $orderId = session()->get('order_id');
        // Fetch the order with its associated products
        $order = Order::with('orderProducts.product', 'paymentMethod')
            ->where('id', $orderId)
            ->firstOrFail();

        session()->forget('order_id');

        return view('pages.orders.confirmation', compact('order'));
    }

    public function handleCheckoutSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        // Retrieve the checkout session
        $stripe = new \Stripe\StripeClient(getStripeSecret()); // Use your secret key
        $checkoutSession = $stripe->checkout->sessions->retrieve($sessionId);

        // Update your order based on the session details
        $order = Order::where('transaction_id', $checkoutSession->id)->first();

        if ($order) {
            // Update the payment status based on the session details
            $paymentIntentId = $checkoutSession->payment_intent;
            $order->transaction_id = $paymentIntentId;
            if ($checkoutSession->payment_status == 'paid') {
                $order->payment_status = 'completed';
                // Send emails
                $this->sendOrderEmails($order, $request->guest_email);
            } else {
                $order->payment_status = 'failed'; // Handle failed payment
            }
            $order->save();

            session()->put('order_id', $order->id);
            // Redirect to a thank you page or wherever you want
            return redirect(url('order-confirmation'));
        }

        return redirect()->route('checkout')->with('error', 'Order not found.');
    }

    protected function sendOrderEmails($order, $guestEmail = null)
    {
        // Check if environment is not localhost
        if (!app()->environment('local')) {
            // Send mail to Admin
            Mail::to(applicationSettings('primary-email'))->send(new OrderPlacedAdminMail($order));

            // Send mail to the User
            if (auth()->guard('customers')->check()) {
                $userEmail = auth()->guard('customers')->user()->email;
                Mail::to($userEmail)->send(new OrderPlacedUserMail($order));
            } elseif (!empty($guestEmail)) {
                // If the order was placed by a guest, send to the guest's email
                Mail::to($guestEmail)->send(new OrderPlacedUserMail($order));
            }
        }
    }
}
