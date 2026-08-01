<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>
                Decline Order - {{ $order->orderid }}
            </h1>

            {!! Form::open(['route' => 'order.decline']) !!}

            <div class="row">
                <input type="hidden" name="id" value="{{ $order->id }}">

                <div class="form-group col-sm-6">
                    {!! Form::label('reason_for_cancellation', 'Reason For Cancellation:') !!}
                    {!! Form::textarea('reason_for_cancellation', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="popup-buttons">
                {!! Form::submit('Decline Order', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('orders.index') }}" class="btn btn-default"> Cancel </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>