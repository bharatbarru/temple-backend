<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 20px; ">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="600" align="center"
                    style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); border-top: solid 10px #980406;">
                    <!-- Header -->
                    <tr>
                        <td align="center"><?php echo $__env->make('emails.partials.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <h1 style="font-family: Arial, sans-serif; font-size: 24px; color: #980406;">New Hall Order Request</h1>
                            <p
                                style="font-family: Arial, sans-serif; font-size: 13px; line-height: 20px; color: #000000;">
                                Dear Admin
                                We have received your hall Request,
                                Please find details of your request below:</p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 0 20px 20px 20px; ">
                            <p
                                style="font-family: Arial, sans-serif; font-size: 20px; line-height: 22px; margin: 0; padding: 0; color: #980406; font-weight: bold;">
                                Request Details</p>


                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top: 0px;">

                                <tr>
                                    <td>
                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px;">
                                            Request ID: <span
                                                style="color:#980406; font-weight: bold;"><?php echo e($hallOrder->hall_request_id); ?></span>
                                        </p>
                                    </td>
                                    <td align="right">


                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Request Status: <span style="color:#980406; font-weight: bold;"><?php echo e($hallOrder->getLatestStatus()); ?></span>
                                        </p>

                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Total Amount: <span style="color:#980406; font-weight: bold;">$ <?php echo e($hallOrder->total_amount); ?></span>
                                        </p>

                                    </td>

                                </tr>

                            </table>

                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding: 0; color: #000000; font-weight: bold;">
                                USER INFO</p>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
                                style="margin-top: 10px;">
                                <?php if($hallOrder->type_of_event == 'community'): ?>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Community  Name:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        
                                            <?php echo e($hallOrder->user->community_name); ?>

                                        
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Individual  Name:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        
                                            <?php echo e($hallOrder->user->first_name . ' ' . $hallOrder->user->last_name); ?>

                                        
                                    </td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Address:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php echo e($hallOrder->user->address); ?>,<?php echo e($hallOrder->user->city); ?>,<?php echo e($hallOrder->user->state); ?>,<?php echo e($hallOrder->user->zip_code); ?></td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Contact No:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="tel:<?php echo e($hallOrder->user->mobile); ?>"
                                            style="text-decoration: none; color: #980406; font-weight:bold;"><?php echo e($hallOrder->user->mobile); ?></a>
                                    </td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Email
                                    </td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="mailto:<?php echo e($hallOrder->user->email); ?>"
                                            style="text-decoration: none; color: #980406; font-weight:bold;">
                                            <?php echo e($hallOrder->user->email); ?></a>
                                    </td>
                                </tr>
                            </table>





                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding:15px 0 0 0; color: #000000; font-weight: bold;">
                                EVENT INFO</p>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
                                style="margin-top: 10px;">
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Date of Event:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php echo e(formatDate($hallOrder->date_of_event)); ?>

                                    </td>
                                </tr>

                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Event Start Time</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php echo e(formatTime($hallOrder->start_time)); ?></td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Type of Event:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php echo e($hallOrder->type_of_event); ?></td>
                                </tr>
                                <?php if($hallOrder->type_of_event == 'community'): ?>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Event Duration</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php if($hallOrder->event_duration == 'multiple-days'): ?>
                                        <?php echo e($hallOrder->number_of_days); ?> Day Event
                                        <?php else: ?>
                                            1 Day Event
                                        <?php endif; ?></td>
                                </tr>
                                <?php else: ?>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Duration of Event:
                                    </td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <?php echo e($hallOrder->duration); ?> 
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>

                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding:15px 0 0 0; color: #000000; font-weight: bold;">
                                HALL INFO</p>

                                <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%" style="margin-top: 20px;">
                                    <tr>
                                        <th style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                            Hall Name
                                        </th>
                                        <th style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                            Charge Amount
                                        </th>
                                    </tr>
                                
                                    <?php $total = 0; ?>
                                
                                    <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr <?php if($loop->even): ?> bgColor="#f1f1f1" <?php endif; ?>>
                                            <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                <strong><?php echo e($hall->name); ?> <?php if($hall->no_of_hours): ?> (For <?php echo e($hall->no_of_hours); ?> hours) <?php endif; ?></strong>
                                            </td>
                                            <td align="right" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                <span style="text-decoration: none; font-weight:bold;">$ <?php echo e(number_format($hall->hall_cost, 2)); ?></span>
                                            </td>
                                        </tr>
                                        <?php $total += $hall->hall_cost; ?>
                                
                                        <?php if($hall->addons->isNotEmpty()): ?>
                                            <?php $__currentLoopData = $hall->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr <?php if($loop->even): ?> bgColor="#f9f9f9" <?php endif; ?>>
                                                    <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px 10px; border-bottom: 1px solid #eeeeee;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;→ <?php echo e($addon->name); ?> <?php if($addon->no_of_hours): ?> (For <?php echo e($addon->no_of_hours); ?> hours) <?php endif; ?>
                                                    </td>
                                                    <td align="right" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                        <span style="text-decoration: none; font-weight:bold;">$ <?php echo e(number_format($addon->addon_cost, 2)); ?></span>
                                                    </td>
                                                </tr>
                                                <?php $total += $addon->addon_cost; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                    <tr bgColor="#b40b0d">
                                        <td align="right" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 17px; color: #ffffff; padding: 5px; border-bottom: 1px solid #eeeeee; font-weight: bold;">
                                            Total
                                        </td>
                                        <td align="right" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 17px; color: #ffffff; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                            <span style="color:#ffffff; text-decoration: none; font-weight:bold;">$ <?php echo e(number_format($total, 2)); ?></span>
                                        </td>
                                    </tr>
                                </table>









                                <p
                                style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 1.5; margin-top: 20px; text-align: center;">
                                If you have any questions, feel free to reply to this <a href="mailto:<?php echo applicationSettings('secondary-email'); ?>"
                                style="text-decoration: none; color: #980406; font-weight:bold;">
                                <?php echo applicationSettings('secondary-email'); ?></a>, and our team will get back
                                to you as soon as possible. 
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="text-align: center; padding: 20px; background-color: #980406;">
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #ffffff;">&copy; <?php echo e(date('Y')); ?> <?php echo e(emailCopyrightText()); ?></p>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html><?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\emails\admin_hall_request.blade.php ENDPATH**/ ?>