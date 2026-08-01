<?php

namespace Tests\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PaymentMethodRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected PaymentMethodRepository $paymentMethodRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paymentMethodRepo = app(PaymentMethodRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->make()->toArray();

        $createdPaymentMethod = $this->paymentMethodRepo->create($paymentMethod);

        $createdPaymentMethod = $createdPaymentMethod->toArray();
        $this->assertArrayHasKey('id', $createdPaymentMethod);
        $this->assertNotNull($createdPaymentMethod['id'], 'Created PaymentMethod must have id specified');
        $this->assertNotNull(PaymentMethod::find($createdPaymentMethod['id']), 'PaymentMethod with given id must be in DB');
        $this->assertModelData($paymentMethod, $createdPaymentMethod);
    }

    /**
     * @test read
     */
    public function test_read_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $dbPaymentMethod = $this->paymentMethodRepo->find($paymentMethod->id);

        $dbPaymentMethod = $dbPaymentMethod->toArray();
        $this->assertModelData($paymentMethod->toArray(), $dbPaymentMethod);
    }

    /**
     * @test update
     */
    public function test_update_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $fakePaymentMethod = PaymentMethod::factory()->make()->toArray();

        $updatedPaymentMethod = $this->paymentMethodRepo->update($fakePaymentMethod, $paymentMethod->id);

        $this->assertModelData($fakePaymentMethod, $updatedPaymentMethod->toArray());
        $dbPaymentMethod = $this->paymentMethodRepo->find($paymentMethod->id);
        $this->assertModelData($fakePaymentMethod, $dbPaymentMethod->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $resp = $this->paymentMethodRepo->delete($paymentMethod->id);

        $this->assertTrue($resp);
        $this->assertNull(PaymentMethod::find($paymentMethod->id), 'PaymentMethod should not exist in DB');
    }
}
