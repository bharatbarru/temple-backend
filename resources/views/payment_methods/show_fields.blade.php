<!-- Payment Method Name Field -->
<div class="col-sm-6">



    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('payment_method_name', 'Payment Method Name:') !!} <span class="float-right ">{{ $paymentMethod->payment_method_name }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('display_name', 'Display Name:') !!}<span class="float-right ">{{ $paymentMethod->display_name }}</span>
        </li>
        <li class="nav-item">
            {!! Form::label('slug', 'Slug:') !!}
            <span class="float-right">{{ $paymentMethod->slug }}</span>
        </li>
      
        </ul>

</div>

