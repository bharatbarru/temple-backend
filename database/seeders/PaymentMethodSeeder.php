<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PaymentMethod::where('slug', 'pay-at-restaurant')->first() == null) {
            PaymentMethod::create([
                'payment_method_name' => 'Pay at Restaurant',
                'slug' => 'pay-at-restaurant',
                'display_name' => 'Pay at Restaurant'
            ]);
        }
        if (PaymentMethod::where('slug', 'stripe')->first() == null) {
            PaymentMethod::create([
                'payment_method_name' => 'Stripe',
                'slug' => 'stripe',
                'display_name' => 'Stripe',
                'sandbox_key' => 'pk_test_51IPMCPBqiJrgQEge7dSGsbjbOmZq5eTH3JwOnjWgo1OQPKdKA0xFS62yEli8BTMxz4MoLWIpLkXD0mnyHO1hAMmb00zQrZ84AM',
                'sandbox_secret' => 'sk_test_51IPMCPBqiJrgQEgeCVnM9EkII62a2vhTgo5ruM3z3X3RIUOKOEmIjBUPBy5JHo2ekb1KMk7JUZTohZAhAOiYIYb9005Wmrwjzc'
            ]);
        }
    }
}
