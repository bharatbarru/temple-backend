@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-success float-right" href="{{ route('reports.export', request()->query()) }}">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                {{-- ------------------------------filters------------------------------ --}}
                <div class="form-search-inline column-settings-inline pb-3">
                    <form method="GET" action="{{ route('reports.index') }}" autocomplete="off">
                        <div class="row text-left">
                            <div class="col-md-3 mb-2">
                                <label for="inputType">Report</label>
                                <select class="form-control" id="inputType" name="type">
                                    @foreach ($types as $value => $label)
                                        <option value="{{ $value }}" {{ $report->type() == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label for="inputFrom">From Date</label>
                                <input type="date" name="from" class="form-control" id="inputFrom"
                                    value="{{ $report->filter('from') }}">
                            </div>

                            <div class="col-md-2 mb-2">
                                <label for="inputTo">To Date</label>
                                <input type="date" name="to" class="form-control" id="inputTo"
                                    value="{{ $report->filter('to') }}">
                            </div>

                            @if ($report->supportsSource())
                                <div class="col-md-2 mb-2">
                                    <label for="inputSource">Booked From</label>
                                    <select class="form-control" id="inputSource" name="source">
                                        <option value="">All Sources</option>
                                        @foreach ($sources as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ $report->filter('source') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($report->supportsPaymentStatus())
                                <div class="col-md-2 mb-2">
                                    <label for="inputPaymentStatus">Payment Status</label>
                                    <select class="form-control" id="inputPaymentStatus" name="payment_status">
                                        <option value="">All Statuses</option>
                                        @foreach ($paymentStatuses as $status)
                                            <option value="{{ $status }}"
                                                {{ $report->filter('payment_status') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="col-md-3 mb-2">
                                <label for="inputSearch">Search</label>
                                <input type="text" class="form-control" id="inputSearch" name="search"
                                    placeholder="Request Id, Name, Email, Mobile"
                                    value="{{ $report->filter('search') }}">
                            </div>

                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary mb-2 mr-2">Apply Filters</button>
                                <a href="{{ route('reports.index', ['type' => $report->type()]) }}"
                                    class="btn btn-info mb-2 mr-2">Reset</a>
                                <a href="{{ route('reports.export', request()->query()) }}"
                                    class="btn btn-success mb-2">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>

                @if ($report->notice())
                    <div class="alert alert-info">{{ $report->notice() }}</div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Records</span>
                                <span class="info-box-number">{{ number_format($summary['count']) }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($summary['amount_label'])
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-money-bill-wave"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $summary['amount_label'] }}</span>
                                    <span class="info-box-number">
                                        {{ currencySymbol() }}{{ number_format($summary['amount'], 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <h6>{{ $report->label() }} &mdash; {{ number_format($records->total()) }} Records Found</h6>

                @php
                    $headings = $report->headings();
                    $amountColumns = $report->amountColumns();
                @endphp

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                @foreach ($headings as $heading)
                                    <th style="white-space: nowrap;">{{ $heading }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $index => $record)
                                <tr>
                                    <td>{{ $records->firstItem() + $index }}</td>
                                    @foreach ($report->map($record) as $column => $value)
                                        <td>
                                            @if (in_array($column, $amountColumns) && $value !== null && $value !== '')
                                                {{ currencySymbol() }}{{ number_format($value, 2) }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($headings) + 1 }}">
                                        No records found for the selected filters.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $records->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection
