<div class="row justify-content-center statistics text-center bg-secondary-gradient text-light pt-3 pb-2">
    @foreach (getStats() as $stat)
        <div class="col-6 mb-3 col-lg-3 mb-lg-0 block">
            <p >{{ $stat->title }}</p>
            {{-- {{ $stat->prefix }} --}}
            <h4 class=" d-block" data-countup data-start="4567"
                data-end="{{ $stat->number }}" data-suffix=" {!! $stat->suffix !!}" data-prefix="{!! $stat->prefix !!}" data-duration="3" data-grouping="true"> </h4>
            {{-- {{ $stat->suffix }} --}}
           
        </div>
    @endforeach
</div>