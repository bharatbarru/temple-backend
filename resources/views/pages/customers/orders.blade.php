@extends('frontend.app')

@section('content')
    <section class="pt-5">
        <div class="container">
            <div class="pt-6">
                <h2 class="text-center text-primary text-uppercase mb-5">Orders</h2>

                <div class="hide-mobile">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th class="text-light" scope="col">#</th>
                                    <th class="text-light" scope="col">Order ID</th>
                                    <th class="text-light" scope="col">Order Type</th>
                                    <th class="text-light" scope="col">Payment Method</th>
                                    <th class="text-light" scope="col">Total Amount</th>
                                    <th class="text-light" scope="col">Payment Status</th>
                                    <th class="text-light" scope="col">Order Status</th>
                                    <th class="text-light" scope="col">Order Date</th>
                                    <th class="text-light" scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                    @foreach ($orders as $i => $order)
                                        <tr>
                                            <th scope="row">{{ $i + 1 }}</th>
                                            <td>{{ $order->orderid }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td>{{ $order->paymentMethod->display_name ?? 'Paid Through Wallet' }}</td>
                                            <td>{{ formatAmount($order->total_amount) }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>{{ formatDate($order->created_at) }}</td>
                                            <td><a href="{{ url('view-order/' . $order->id) }}" class="btn-sm btn-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="9" class="text-center">No data found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection