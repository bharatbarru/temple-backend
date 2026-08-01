<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CustomerHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers');
    }

    public function profile(){
        $user = auth()->guard('customers')->user();
        return view('pages.customers.profile', compact('user'));
    }

    public function orders(){
        $customerId = auth()->guard('customers')->user()->id;

        $orders = Order::where('customer_id', $customerId)->latest()->get();
        return view('pages.customers.orders', compact('orders'));
    }

    public function updateProfile(Request $request){
        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->save();

        Flash::success('Profile updated successfully');
        return redirect()->back();
    }

    public function viewOrder($id){
        $order = Order::find($id);

        return view('pages.customers.view-order', compact('order'));
    }
}
