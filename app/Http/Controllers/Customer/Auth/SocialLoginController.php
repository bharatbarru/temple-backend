<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        // Get the previous URL
        $previousUrl = url()->previous();

        // Check if the previous URL is the cart page
        if (substr($previousUrl, -4) == 'cart') {
            // Set intended URL to the checkout page
            session(['url.intended' => url('/checkout')]);
        } else {
            // Set intended URL to the cart page
            session(['url.intended' => url('/')]);
        }

        config([
            'services.' . $provider . '.client_id' => applicationSettings($provider . '-client-id'),
            'services.' . $provider . '.client_secret' => applicationSettings($provider . '-client-secret'),
            'services.' . $provider . '.redirect' => applicationSettings($provider . '-redirect-uri'),
        ]);

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        config([
            'services.' . $provider . '.client_id' => applicationSettings($provider . '-client-id'),
            'services.' . $provider . '.client_secret' => applicationSettings($provider . '-client-secret'),
            'services.' . $provider . '.redirect' => applicationSettings($provider . '-redirect-uri'),
        ]);
        $user = Socialite::driver($provider)->user();

        $authCustomer = $this->findOrCreateUser($user, $provider);
        Auth::guard('customers')->login($authCustomer, true);

        return redirect()->intended('/');
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        $user = Customer::where('provider_id', $socialUser->id)
            ->orWhere('email', $socialUser->email)
            ->first();

        if ($user) {
            return $user;
        }

        return Customer::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider' => $provider,
            'provider_id' => $socialUser->id,
        ]);
    }
}
