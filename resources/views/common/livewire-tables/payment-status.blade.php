{!! Form::select('payment_status',
    [
        'pending' => 'pending',
        'completed' => 'completed',

    ],
    $value,
    [
        'class' => 'form-control',
        'id' => 'payment_status',
        'wire:change' => 'updatePaymentStatus(' . $id . ', $event.target.value)',
        'placeholder' => 'Select Payment Status'
    ])
!!}