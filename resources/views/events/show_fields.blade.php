<div class="card callout callout-success puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size:24px">
                    
                    Event Info
                </h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger float-right" style="color: #fff; text-decoration:none"
                    href="{{ route('events.index') }}">
                    Back
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            
        <p class="col-md-4">Event Category: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $event->eventCategory->name ?? '' }}</p>


            <p class="col-md-4">Title: </p>
            <p class="col-md-8 " style="font-weight:bold"> {{ $event->title }}</p>

            <p class="col-md-4">Slug: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $event->slug }}</p>

            <p class="col-md-4">Start Date Time: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ formatDateTime($event->start_date_time) }}</p>


            <p class="col-md-4">End Date Time: </p>
            <p class="col-md-8 " style="font-weight:bold; ">{{ formatDateTime($event->end_date_time) }}</p>

            <p class="col-md-4">Image:</p>
            <div class="col-md-8" style="font-weight:bold">
                @if (!empty($event->image))
                   <img src="{{ asset(EVENT_IMAGE_PATH . $event->image) }}" alt="" height="50">
                @endif
            </div>
            <p class="col-md-4">Image Alt Text: </p>
            <p class="col-md-8 " style="font-weight:bold; ">{{ $event->image_alt_text }}</p>

        </div>
    </div>
    <!-- /.card-body -->
</div>









<div class="card callout callout-info puja-card">
    <div class="card-header ">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="card-title" style="font-size:24px">
                    Event Details
                </h1>
            </div>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <p class="col-md-4">Custom Url: </p>
            <p class="col-md-8 " style="font-weight:bold">{{ $event->custom_url }}</p>
            
            <h6 class="col-md-4" >Short Description: </h6>
            <p class="col-md-8">{!! $event->short_description !!}</p>

            <h6 class="col-md-4 ">Long Description: </h6>
            <p class="col-md-8">{!! $event->description !!}</p>


         

        </div>
    </div>
    <!-- /.card-body -->
</div>

