{{-- Payment / transaction details block.
     $audience = 'admin' -> Transaction ID, Order ID, Capture ID, status and the
                            PayPal account / card details (plus amount).
     $audience = 'user'  -> Order ID, status and the PayPal account / card details. --}}
@php
    $isAdmin = ($audience ?? 'user') === 'admin';

    $paymentTransactions = $pujaOrder->paymentTransactions ?? collect();

    // The user only needs the payment that went through; the admin sees every
    // attempt recorded against the booking.
    $paymentTransactions = $isAdmin
        ? $paymentTransactions->sortBy('id')
        : $paymentTransactions->sortByDesc('id')->take(1);

    $cellStyle = 'font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;';
@endphp

@if ($paymentTransactions->isNotEmpty())
    <p
        style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 20px 0 0 0; color: #000000; font-weight: bold;">
        PAYMENT TRANSACTION DETAILS</p>

    @foreach ($paymentTransactions as $transaction)
        @php
            $isCardPayment = $transaction->card_brand || $transaction->card_last_digits;

            $rows = [];

            if ($isAdmin) {
                $rows['Transaction ID'] = $transaction->reference;
            }

            $rows['Order ID'] = $transaction->paypal_order_id ?: 'N/A';

            if ($isAdmin) {
                $rows['Capture ID'] = $transaction->paypal_capture_id ?: 'N/A';
            }

            $rows['Status'] = $transaction->paypal_status ?: ($transaction->paypal_paid ? 'COMPLETED' : 'N/A');
            $rows['Payment Method'] = $transaction->payment_method_label;

            if ($isCardPayment) {
                $rows['Card'] = $transaction->payment_source_label;

                if ($transaction->card_holder_name) {
                    $rows['Card Holder'] = $transaction->card_holder_name;
                }
            } else {
                $rows['PayPal Account'] = $transaction->paypal_payer_email ?: 'N/A';
            }

            if ($isAdmin) {
                if (!$isCardPayment && $transaction->paypal_payer_id) {
                    $rows['PayPal Payer ID'] = $transaction->paypal_payer_id;
                }

                $rows['Amount Paid'] = '$ ' . number_format((float) ($transaction->paypal_amount ?? 0), 2)
                    . ($transaction->paypal_currency ? ' ' . $transaction->paypal_currency : '');
            }
        @endphp

        <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
            style="margin-top: 10px;">
            @foreach ($rows as $label => $value)
                <tr @if ($loop->index % 2) bgColor="#f1f1f1" @endif>
                    <td width="40%" style="{{ $cellStyle }}">{{ $label }}</td>
                    <td style="{{ $cellStyle }}">{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
@endif
