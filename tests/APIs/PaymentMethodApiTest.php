<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PaymentMethod;

class PaymentMethodApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/paymentMethods',
            $paymentMethod
        );

        $this->assertApiResponse($paymentMethod);
    }

    /**
     * @test
     */
    public function test_read_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/paymentMethods/' . $paymentMethod->id
        );

        $this->assertApiResponse($paymentMethod->toArray());
    }

    /**
     * @test
     */
    public function test_update_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $editedPaymentMethod = PaymentMethod::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/paymentMethods/' . $paymentMethod->id,
            $editedPaymentMethod
        );

        $this->assertApiResponse($editedPaymentMethod);
    }

    /**
     * @test
     */
    public function test_delete_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/paymentMethods/' . $paymentMethod->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/paymentMethods/' . $paymentMethod->id
        );

        $this->response->assertStatus(404);
    }
}
