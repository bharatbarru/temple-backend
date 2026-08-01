<div class="col-md-12">
    <div>
        <ul class="list-group mb-5">
            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span> Order ID</span> :
            {{ $order->orderid }}
            </li>

            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span > Order Type </span>: 
            {{ ucfirst($order->order_type) }}
            </li>

            @if ($order->order_type == 'home-delivery')
                <li class="list-group-item d-flex justify-content-start align-items-center">
                    <span > Delivery Address </span>:
                {{ $order->delivery_address }}
                </li>
            @endif

            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span > Payment Method </span>: 
            {{ $order->paymentMethod->display_name ?? 'Paid Through Wallet' }}
            </li>

            @if ($order->paymentMethod && $order->paymentMethod->slug == 'stripe')
                <li class="list-group-item d-flex justify-content-start align-items-center">
                    <span > Transaction ID </span>:
                {{ $order->transaction_id }}
                </li>
            @endif

            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span > Payment Status </span>: 
            {{ $order->payment_status }}
            </li>

            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span > Order Status </span>: 
            {{ $order->order_status }}
            </li>

            @if ($order->order_status == 'declined')
                <li class="list-group-item d-flex justify-content-start align-items-center">
                    <span > Reason for Cancellation </span>:
                {{ $order->reason_for_cancellation }}
                </li>
            @endif
            
            <li class="list-group-item d-flex justify-content-start align-items-center">
                <span >  <b>Total Amount</b></span>
                <b>   :  {{ formatAmount($order->total_amount) }}</b>
            </li>
        </ul>
    </div>

    <h4 class="mt-5">Order Summary</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderProducts as $orderProduct)
                <tr>
                    <td>{{ $orderProduct->product->title }}</td>
                    <td>{{ $orderProduct->quantity }}</td>
                    <td>{{ formatAmount($orderProduct->price) }}</td>
                    <td>{{ formatAmount(($orderProduct->quantity*$orderProduct->price)) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Sub Total</th>
                <th>{{ formatAmount($order->subtotal_amount) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Tax ({{ applicationSettings('tax') }}%)</th>
                <th>{{ formatAmount($order->tax_amount) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Delivery Charges</th>
                <th>{{ formatAmount($order->delivery_charge) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Coupon Discount</th>
                <th>{{ formatAmount($order->coupon_discount) }}</th>
            </tr>
            @if($order->royalty_points_amount)
                <tr>
                    <th colspan="3" class="text-right">Royalty Points Discount</th>
                    <th>{{ formatAmount($order->royalty_points_amount) }}</th>
                </tr>
            @endif
            <tr>
                <th colspan="3" class="text-right">Final Amount</th>
                <th>{{ formatAmount($order->total_amount) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
