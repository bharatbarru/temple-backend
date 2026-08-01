@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Log</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                {{-- ------------------------------search------------------------------ --}}
                <div class="form-search-inline  column-settings-inline">
                    <form class="form-inline form-search" method="GET" action="" autocomplete="off">
                        <div class="row text-left" style="flex-wrap: nowrap;">
                            <div class="col">
                                <label class="sr-only" for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Description, Details" value="{{ request()->get('search') }}">
                            </div>
                            <div class="col">
                                <select class="form-control select2" id="user" name="user">
                                    <option value="">Select Action By</option>
                                    @foreach (getUsers() as $user)
                                        <option value="{{ $user->id }}"
                                            {{ request()->get('user') == $user->id ? 'selected' : '' }}>
                                            {{ $user->user_name . ' - ' . $user->role_name }}</option>
                                    @endforeach
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
                                <a href="{!! url('admin/activity-log') !!}" class="btn btn-info mb-2">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
                {{-- ------------------------------search end------------------------------ --}}
                <div class="log-content table-responsive">
                    <table class="table table-bordered table-striped table-hover  custom-table-styles" aria-describedby="table">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Description</th>
                                <th>Details</th>
                                <th>Action By</th>
                                <th>Action Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($activityLogs as $log)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td class="details-section">
                                        @php($dataArray = $log->properties != '' ? json_decode($log->properties, true) : '')
                                        @if ($dataArray != '')
                                            {{-- @php($reversedArray = array_reverse($dataArray))  Reverse the array --}}
                                            <ul>
                                                @foreach ($dataArray as $key => $value)
                                                    <li>{{ $key }}: {!! str_replace('\\/', '/', json_encode($value)) !!}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>{{ getUserName($log->subject_id) }}</td>
                                    <td>{{ formatDateTime($log->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <p class="record_count">{{ $activityLogs->total() }} Records Found</p>
                    </div>
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', [
                            'records' => $activityLogs->appends(request()->query()),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
