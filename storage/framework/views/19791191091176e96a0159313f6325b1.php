<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
  </head>

  <body
    style="
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    "
  >
    <table
      cellpadding="0"
      cellspacing="0"
      border="0"
      width="100%"
      style="background-color: #f4f4f4; padding: 20px"
    >
      <tr>
        <td>
          <table
            cellpadding="0"
            cellspacing="0"
            border="0"
            width="600"
            align="center"
            style="
              background-color: #ffffff;
              padding: 20px;
              border-radius: 8px;
              box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
              border-top: solid 10px #980406;
            "
          >
            <!-- Header -->
            <tr>
              <td align="center">
                <?php echo $__env->make('emails.partials.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </td>
            </tr>
            <tr>
              <td style="text-align: center; padding: 20px">
                <h1
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 24px;
                    color: #980406;
                  "
                >
                  Thank you for your tour request.
                </h1>
                <p
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 13px;
                    line-height: 20px;
                    color: #000000;
                  "
                >
                  Please find details of your request:
                </p>
              </td>
            </tr>
            <!-- Content -->
            <tr>
              <td style="padding: 0 20px 20px 20px">
                <p
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 20px;
                    line-height: 22px;
                    margin: 0;
                    padding: 0;
                    color: #980406;
                    font-weight: bold;
                  "
                >
                  Request Details
                </p>

                <table
                  cellpadding="0"
                  cellspacing="0"
                  border="0"
                  width="100%"
                  style="margin-top: 0px"
                >
                  <tr>
                    <td>
                      <p
                        style="
                          font-family: Arial, sans-serif;
                          font-size: 14px;
                          color: #666666;
                          line-height: 16px;
                        "
                      >
                        Request ID:
                        <span style="color: #980406; font-weight: bold"
                          ><?php echo e($templeTour->tour_request_id); ?></span
                        >
                      </p>
                    </td>
                    <td align="right">
                      <p
                        style="
                          font-family: Arial, sans-serif;
                          font-size: 14px;
                          color: #666666;
                          line-height: 16px;
                          margin-bottom: 0;
                          padding-bottom: 0;
                        "
                      >
                        Request Status:
                        <span style="color: #980406; font-weight: bold"
                          ><?php echo e($templeTour->getLatestStatus()); ?>

                        </span>
                      </p>
                    </td>
                  </tr>
                </table>

                <p
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    line-height: 18px;
                    margin: 0;
                    padding: 0;
                    color: #000000;
                    font-weight: bold;
                  "
                >
                  USER INFO
                </p>

                <table
                  cellpadding="0"
                  cellspacing="0"
                  border="1"
                  borderColor="#eeeeee"
                  width="100%"
                  style="margin-top: 10px"
                >
                  <tr>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Name of group/individual:
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e($templeTour->name); ?>

                    </td>
                  </tr>
                  <tr bgcolor="#f1f1f1">
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Primary Phone:
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <a
                        href="tel:<?php echo e($templeTour->mobile); ?>"
                        style="
                          text-decoration: none;
                          color: #980406;
                          font-weight: bold;
                        "
                        ><?php echo e($templeTour->mobile); ?></a
                      >
                    </td>
                  </tr>
                  <tr>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Email :
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <a
                        href="mailto:<?php echo e($templeTour->email); ?>"
                        style="
                          text-decoration: none;
                          color: #980406;
                          font-weight: bold;
                        "
                      >
                        <?php echo e($templeTour->email); ?></a
                      >
                    </td>
                  </tr>
                  <tr bgcolor="#f1f1f1">
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Count of people visiting as part of group
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e($templeTour->total_visitors); ?>

                    </td>
                  </tr>
                  <tr bgcolor="#f1f1f1">
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Age range of group
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e($templeTour->age_range_of_group); ?>

                    </td>
                  </tr>
                </table>

                <p
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    line-height: 18px;
                    margin: 0;
                    padding: 15px 0 0 0;
                    color: #000000;
                    font-weight: bold;
                  "
                >
                  TOUR INFO
                </p>

                <table
                  cellpadding="0"
                  cellspacing="0"
                  border="1"
                  borderColor="#eeeeee"
                  width="100%"
                  style="margin-top: 10px"
                >
                  <tr>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Tour Date / Time:
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e(formatDate($templeTour->tour_date) . ', ' .
                      $templeTour->tour_time); ?>

                    </td>
                  </tr>
                  <tr>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Alternate Tour Date / Time:
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e(formatDate($templeTour->alternate_tour_date) . ', ' .
                      $templeTour->alternate_tour_time); ?>

                    </td>
                  </tr>

                  <tr bgcolor="#f1f1f1">
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      Comment:
                    </td>
                    <td
                      style="
                        font-family: Arial, sans-serif;
                        font-size: 13px;
                        line-height: 17px;
                        color: #333333;
                        padding: 5px;
                        border-bottom: 1px solid #eeeeee;
                      "
                    >
                      <?php echo e($templeTour->comment); ?>

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
              <td
                style="
                  text-align: center;
                  padding: 20px;
                  background-color: #980406;
                "
              >
                <p
                  style="
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    color: #ffffff;
                  "
                >
                  &copy; <?php echo e(date('Y')); ?> <?php echo e(emailCopyrightText()); ?>

                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\emails\user_tour_request.blade.php ENDPATH**/ ?>