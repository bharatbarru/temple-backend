<div class="card callout-success-bg puja-card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    Puja Info
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
            <h5 class="col-md-4 text-primary">Puja Request ID:</h5>
            <h5 class="col-md-8 text-primary" style="font-weight:bold">{{ $pujaOrder->puja_request_id }}</h5>
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
                    @foreach ($pujaOrder->orderStatuses as $status)
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
            <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->user->first_name . ' ' . $pujaOrder->user->last_name }}</p>

            <p class="col-md-4">Address: </p>
            <p class="col-md-8 font-weight-bold">
                {{ implode(', ', array_filter([
                    $pujaOrder->user->address,
                    $pujaOrder->user->city,
                    $pujaOrder->user->state,
                    $pujaOrder->user->pincode,
                    $pujaOrder->user->country
                ], fn($value) => !is_null($value) && $value !== '')) }}
            </p>

            <p class="col-md-4">Contact No</p>
            <p class="col-md-8 font-weight-bold">{{ $pujaOrder->user->mobile }}</p>

            <p class="col-md-4">Email</p>
            <p class="col-md-8 font-weight-bold">{{ $pujaOrder->user->email }}</p>


        </div>
    </div>
    <!-- /.card-body -->
</div>

@php
    $statuses = $pujaOrder->orderStatuses->pluck('status')->toArray();
@endphp

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Requested Puja Info
                </h1>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">
                Date Of Puja:
                @if(in_array(RESCHEDULE_REQUEST, $statuses))
                    <span class="badge badge-primary">Rescheduled</span>
                @endif
            </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ formatDate($pujaOrder->date_of_puja) }}</p>

            <p class="col-md-4">
                Time Of Puja:
                @if(in_array(RESCHEDULE_REQUEST, $statuses))
                    <span class="badge badge-primary">Rescheduled</span>
                @endif
            </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->time_of_puja }}</p>


            <p class="col-md-4">Alternate Date Of Puja1: </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ formatDate($pujaOrder->alternate_date_of_puja1) }}</p>

            <p class="col-md-4">Alternate Time Of Puja1: </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->alternate_time_of_puja2 }}</p>

            <p class="col-md-4">Comment/Special Instruction: </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->comments }}</p>
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
                <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->changed_by }}</p>

                <p class="col-md-4">Changed Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->changed_comments }}</p>
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
                <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->cancelled_by }}</p>

                <p class="col-md-4">Cancelled Comments: </p>
                <p class="col-md-8 " style="font-weight:bold"> {{ $pujaOrder->cancelled_comments }}</p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endif

<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Puja / Service
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
                        @foreach ($pujaOrder->pujaOrderLists as $pujaOrderList)
                            <tr>
                                <td>{{ $pujaOrderList->puja->name }}</td>
                                <td>{{ formatAmount($pujaOrderList->puja_cost) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Amount:</strong></td>
                            <td><strong>{{ formatAmount($pujaOrder->total_amount) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
