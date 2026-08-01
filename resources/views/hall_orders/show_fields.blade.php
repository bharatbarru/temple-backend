<div class="card callout-success-bg puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Hall Info
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
            <h5 class="col-md-4 text-primary">Hall Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold">{{ $hallOrder->hall_request_id }}</h5>
        </div>

        <div class="color-pallate">
            <div class="mb-5">
                <span class="color-code-span">Color Code:</span> <span>
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
                <ul>
                    @foreach ($hallOrder->orderStatuses as $status)
                        <li class="{{ 
                            $status->status == 'NEW REQUEST' ? 'new-request' : 
                            ($status->status == 'RESCHEDULE REQUEST' ? 'reschedule-request' : 
                            ($status->status == 'CANCEL REQUEST' ? 'cancellation-request' : '')) 
                        }}">{{ $status->status }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card callout callout-info puja-card">  
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    User Info
                </h1>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Name: </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ $hallOrder->user->first_name . ' ' . $hallOrder->user->last_name }}</p>

            <p class="col-md-4">Address: </p>
            <p class="col-md-8 font-weight-bold">
                {{ implode(', ', array_filter([
                    $hallOrder->user->address,
                    $hallOrder->user->city,
                    $hallOrder->user->state,
                    $hallOrder->user->pincode,
                    $hallOrder->user->country
                ], fn($value) => !is_null($value) && $value !== '')) }}
            </p>

            <p class="col-md-4">Contact No</p>
            <p class="col-md-8 font-weight-bold">{{ $hallOrder->user->mobile }}</p>

            <p class="col-md-4">Email</p>
            <p class="col-md-8 font-weight-bold">{{ $hallOrder->user->email }}</p>


        </div>
    </div>
    <!-- /.card-body -->
</div>

@php
    $statuses = $hallOrder->orderStatuses->pluck('status')->toArray();
@endphp

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Requested Hall Booking Info
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Type Of Event: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $hallOrder->type_of_event }}</p>

            @if($hallOrder->type_of_event == 'community')
                <p class="col-md-4">Event Duration: </p>
                <p class="col-md-8 " style="font-weight:bold">
                    @if($hallOrder->event_duration == 'multiple-days')
                        {{$hallOrder->number_of_days}} Day Event
                    @else
                        1 Day Event
                    @endif
                </p>
            @endif

            <p class="col-md-4">Hall Event Type: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $hallOrder->hallEventType->name ?? '' }}</p>

            @if($hallOrder->hallEventType && $hallOrder->hallEventType->name == 'Other')
                <p class="col-md-4">Other Event Type: </p>
                <p class="col-md-8 " style="font-weight:bold">{{ $hallOrder->other_event_type }}</p>
            @endif

            <p class="col-md-4">Date of Event: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ formatDate($hallOrder->date_of_event) }}</p>

            @if($hallOrder->event_duration == 'multiple-days')
                <p class="col-md-4">End Date of Event: </p>
                <p class="col-md-8 " style="font-weight:bold">
                    @if($hallOrder->event_duration == 'multiple-days')
                        {{ formatDate(\Carbon\Carbon::parse($hallOrder->date_of_event)->addDays($hallOrder->number_of_days - 1 )) }}
                    @endif
                </p>
            @endif

            <p class="col-md-4">
                Start Time:
                @if(in_array(RESCHEDULE_REQUEST, $statuses))
                    <span class="badge badge-primary">Rescheduled</span>
                @endif
            </p>
            <p class="col-md-8 " style="font-weight:bold">{{ formatTime($hallOrder->start_time) }}</p>

            <p class="col-md-4">Duration: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $hallOrder->duration }} hours</p>

            <p class="col-md-4">Alternate Date Of Event: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ formatDate($hallOrder->alternate_date_of_event) }}</p>

            <p class="col-md-4">Comments: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $hallOrder->comments }}</p>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@if(in_array(RESCHEDULE_REQUEST, $statuses))
    <div class="card callout callout-warning puja-card">
        <div class="card-header ">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="card-title" style="font-size:24px">
                        Rescheduled Info
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Changed By: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $hallOrder->changed_by }}</p>

                <p class="col-md-4">Changed Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $hallOrder->changed_comments }}</p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endif

@if(in_array(CANCEL_REQUEST, $statuses))
    <div class="card callout callout-danger puja-card">
        <div class="card-header ">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="card-title" style="font-size:24px">
                        Cancelled Info
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <p class="col-md-4">Cancelled By: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $hallOrder->cancelled_by }}</p>

                <p class="col-md-4">Cancelled Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $hallOrder->cancelled_comments }}</p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endif

<div class="card callout callout-danger puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Halls / Addons
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Charge Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hallOrder->hallOrderLists as $hallOrderList)
                            <tr>
                                <td>{{ $hallOrderList->hall->name ?? 'N/A' }} @if($hallOrderList->no_of_hours) (For {{ $hallOrderList->no_of_hours }} hours)@endif</td>
                                <td>${{ $hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallOrderList->hall_cost, 2) }}</td>
                            </tr>
                            @php
                                $hallAddonLists = $hallOrder->hallOrderAddonsLists->where('hall_id', $hallOrderList->hall_id);
                            @endphp
                            @foreach ($hallAddonLists as $hallAddonList)
                                <tr>
                                    <td>&nbsp;&nbsp;<i class="nav-icon fas fa-check"></i> {{ $hallAddonList->hallAddon->name }} @if($hallAddonList->no_of_hours) (For {{ $hallAddonList->no_of_hours }} hours)@endif</td>
                                    <td>${{ $hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallAddonList->addon_cost, 2) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Amount:</strong></td>
                            <td><strong>${{ $hallOrder->type_of_event == 'hindu_temple' ? '0.00' : number_format($hallOrder->total_amount, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
