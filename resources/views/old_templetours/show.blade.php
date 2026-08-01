@extends('layouts.app')

@section('content')
   <div class="card callout-success-bg puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Temple Tour Info
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                    href="javascript:history.back()">
                    Back
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <h5 class="col-md-4 text-primary">Temple Tour Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold">{{ $order->tour_request_id }}</h5>
        </div>

        <div class="color-pallate">
            <div class="mb-5">
                <span class="color-code-span">Color Code:</span>
                <span>
                    <badge class="new-request">&nbsp;</badge> New Request
                </span>
                <span>
                    <badge class="reschedule-request">&nbsp;</badge> Reschedule Request
                </span>
                <span>
                    <badge class="cancellation-request">&nbsp;</badge> Cancellation Request
                </span>
            </div>

            <div class="order-status">
                <h3>Order Status</h3>
                @php
                    $statusClass = '';
                    $statusText = '';

                    switch ($order->request_status) {
                        case 'PENDING':
                            $statusClass = 'new-request';
                            $statusText = 'New Request';
                            break;
                        case 'SCHEDULED':
                            $statusClass = 'reschedule-request';
                            $statusText = 'SCHEDULED';
                            break;
                        case 'CANCEL_REQUEST':
                            $statusClass = 'cancellation-request';
                            $statusText = 'Cancellation Request';
                            break;
                        default:
                            $statusText = $order->request_status;
                    }
                @endphp

                <span class="status-label {{ $statusClass }}">{{ $statusText }}</span>
            </div>
        </div>
    </div> 
</div> 

    <!-- User Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">USER INFO</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Name of group/individual</p>
                <p class="col-md-8 font-weight-bold">{{ $order->name ?? 'N/A' }}</p>

                <p class="col-md-4">Email</p>
                <p class="col-md-8 font-weight-bold">{{ $order->email ?? 'N/A' }}</p>

                <p class="col-md-4">Primary No</p>
                <p class="col-md-8 font-weight-bold">{{ $order->primary_phone ?? 'N/A' }}</p>

                <p class="col-md-4">Total Visitor</p>
                <p class="col-md-8 font-weight-bold">{{ $order->total_visitor ?? 'N/A' }}</p>

                <p class="col-md-4">Age range of group</p>
                <p class="col-md-8 font-weight-bold">{{ $order->age_range_of_group ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Requested Puja Info Card -->
    <div class="card callout callout-info puja-card m-4">
        <div class="card-header">
            <h1 class="card-title" style="font-size: 24px;">REQUESTED TOUR INFO</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Tour Date / Time</p>
                <p class="col-md-8 font-weight-bold">
                    {{ formatDate($order->tour_date) }}<br>
                    {{ formatTime($order->tour_time) }}
                </p>

                <p class="col-md-4">Alternate Tour Date / Time</p>
                <p class="col-md-8 font-weight-bold">
                    {{ formatDate($order->alternate_tour_date) }}<br>
                    {{ formatTime($order->alternate_tour_time) }}
                </p>

                <p class="col-md-4">Comment</p>
                <p class="col-md-8 font-weight-bold">{{ $order->comment ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
@endsection



    