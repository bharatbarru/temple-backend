<div class="card callout callout-success puja-card mt-5">
    <div class="card-header">
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
        <div class="clearfix">
            @if (!empty($hall->image))
                <img class="attachment-img" src="{{ asset(HALL_IMAGE_PATH . $hall->image) }}" alt="Attachment Image">
            @endif
            {{ $hall->image_alt_text }}
            <div class="attachment-pushed">
                <h4 class="attachment-heading">{{ $hall->name }}</h4>
                <div class="attachment-text">
                    {{ $hall->description }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<div class="card callout callout-danger puja-card">
    <div class="card-header border-0">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Hall Dates & Costs:
                </h1>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="custom-table-new">
            <table border="1" width="100%">
                <thead>
                    <tr bgColor="#eee">
                        <th>Day</th>
                        <th>1-Day Cost</th>
                        <th>3-Day Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    @endphp
                    @foreach ($days as $day)
                        <tr>
                            <td>{{ ucfirst($day) }}</td>
                            <td>{{ $hall->{$day . '_cost'} > 0 ? formatAmount($hall->{$day . '_cost'}) : '-' }}</td>
                            <td>{{ $hall->{$day . '_three_day_cost'} > 0 ? formatAmount($hall->{$day . '_three_day_cost'}) : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
