<?php

namespace Tests\Feature;

use App\Http\Livewire\PujaOrdersTable;
use App\Models\PujaOrder;
use Tests\TestCase;

class PujaOrdersTableTest extends TestCase
{
    public function test_it_marks_paid_when_payment_transaction_exists(): void
    {
        $table = new PujaOrdersTable();
        $pujaOrder = PujaOrder::factory()->create();

        $this->assertSame('', $table->getPaymentStatusValue($pujaOrder));

        $pujaOrder->paymentTransactions()->create([
            'frontend_user_id' => $pujaOrder->user_id,
            'puja_request_id' => $pujaOrder->puja_request_id,
            'paypal_order_id' => 'pay-123',
            'paypal_paid' => true,
            'paypal_status' => 'COMPLETED',
        ]);

        $this->assertSame('Paid', $table->getPaymentStatusValue($pujaOrder->fresh()));
    }
}
