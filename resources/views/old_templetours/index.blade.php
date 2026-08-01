@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Old Temple Tour  Requests</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                {{-- ------------------------------search------------------------------ --}}
                <div class="form-search-inline column-settings-inline pb-3">
                    <form class="form-inline form-search" method="GET" action="{{ route('old.tour.requests') }}" autocomplete="off">
                        <div class="row text-left" style="flex-wrap: nowrap;">
                            <div class="col">
                                <label class="sr-only" for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Request Id, Requestor/Group Name" value="{{ request()->get('search') }}" style="width: 300px;">
                            </div>
                            <div class="col">
                                <select class="form-control select2" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="{{ PENDING }}" {{ request()->get('status') == PENDING ? 'selected' : '' }}>{{ NEW_REQUEST }}</option>
                                    <option value="{{ RESCHEDULE_REQUEST }}" {{ request()->get('status') == RESCHEDULE_REQUEST ? 'selected' : '' }}>{{ RESCHEDULE_REQUEST }}</option>
                                    <option value="{{ CANCEL_REQUEST }}" {{ request()->get('status') == CANCEL_REQUEST ? 'selected' : '' }}>{{ CANCEL_REQUEST }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inputFromDate">From Date</label>
                                <input type="date" name="from_date" class="form-control datepicker date-icon"
                                    id="inputFromDate" placeholder="From Date" value="{{ request()->get('from_date') }}">
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inputToDate">To Date</label>
                                <input type="date" name="to_date" class="form-control datepicker date-icon"
                                    id="inputToDate" placeholder="To Date" value="{{ request()->get('to_date') }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                                <a href="{{ route('old.tour.requests') }}" class="btn btn-info mb-2">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>

                <div class="status-container">
                    @php
                        $statuses = [
                            ['name' => NEW_REQUEST, 'class' => getClassNameFromStatus(NEW_REQUEST)],
                            ['name' => RESCHEDULE_REQUEST, 'class' => getClassNameFromStatus(RESCHEDULE_REQUEST)],
                            ['name' => CANCEL_REQUEST, 'class' => getClassNameFromStatus(CANCEL_REQUEST)],
                        ];
                    @endphp
                    @foreach ($statuses as $status)
                        <div class="status-item">
                            <span class="color-box {{ $status['class'] }}"></span>
                            {{ $status['name'] }}
                        </div>
                    @endforeach
                </div>

                <h6>{{ $orders->total() }} Records Found</h6>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Request Id</th>
                                <th>Date of Request</th>
                                <th>Date / Time of Tour</th>
                                <th>Requestor/Group Name</th>
                                <th>Email / Phone</th>
                                <th>Alternate Date/ Time</th>
                                <th>Request Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="{{ getClassNameFromStatus($order->request_status) }}">
                                <td><a href="{{ route('old_templetours.show', $order->tour_id) }}">{{ $order->tour_request_id }}</a></td>
                                <td>{{ formatDate($order->add_time) }}</td>
                                <td>
                                    {{ formatDate($order->tour_date) }}<br>
                                    {{ formatTime($order->tour_time) }}
                                </td>
                                <td>{{ $order->name }}</td>
                                <td>
                                    {{ $order->email }}<br>
                                    {{ $order->primary_phone }}
                                </td>
                                <td>
                                    {{ formatDate($order->alternate_tour_date) }}<br>
                                    {{ formatTime($order->alternate_tour_time) }}
                                </td>
                                <td>{{ $order->request_status == 'PENDING' ? NEW_REQUEST : $order->request_status }}</td>
                                <td>
                                    <a href="{{ route('old_templetours.show', $order->tour_id) }}" class="btn btn-default btn-xs" contenteditable="false" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">No temple tour requests found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script type="text/javascript">
        $('#inputFromDate').datepicker()
        $('#inputToDate').datepicker()
    </script>
@endpush
