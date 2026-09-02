
<?php
    $isAdmin = ($audience ?? 'user') === 'admin';

    $paymentTransactions = $pujaOrder->paymentTransactions ?? collect();

    // The user only needs the payment that went through; the admin sees every
    // attempt recorded against the booking.
    $paymentTransactions = $isAdmin
        ? $paymentTransactions->sortBy('id')
        : $paymentTransactions->sortByDesc('id')->take(1);

    $cellStyle = 'font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;';
?>

<?php if($paymentTransactions->isNotEmpty()): ?>
    <p
        style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 20px 0 0 0; color: #000000; font-weight: bold;">
        PAYMENT TRANSACTION DETAILS</p>

    <?php $__currentLoopData = $paymentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
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
        ?>

        <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
            style="margin-top: 10px;">
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr <?php if($loop->index % 2): ?> bgColor="#f1f1f1" <?php endif; ?>>
                    <td width="40%" style="<?php echo e($cellStyle); ?>"><?php echo e($label); ?></td>
                    <td style="<?php echo e($cellStyle); ?>"><?php echo e($value); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\emails\partials\payment-details.blade.php ENDPATH**/ ?>