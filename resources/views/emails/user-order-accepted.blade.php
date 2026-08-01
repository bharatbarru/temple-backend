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
                <table cellpadding="0" cellspacing="0" border="0" width="600" align="center" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); border-top: solid 10px #ea2735;">
                    <!-- Header -->
                     <tr>
                        <td align="center"><img style="line-height: 1px; margin: 0; padding: 0;" width="250px" height="105px" src="https://artofindiancuisine.com/images/site-images/artblackLogo_779grh7t1.png" /></td>
                     </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <h1 style="font-family: Arial, sans-serif; font-size: 24px; color: #333333;">Hello {{ $order->customer ? $order->customer->name : $order->guest_name }}</h1>
                            <p style="font-family: Arial, sans-serif; font-size: 18px; color: #333333; margin: 0; padding: 0;">We have accepted your order <b>Order Id : {{ $order->orderid }}</b>,</p>
                            <p style="font-family: Arial, sans-serif; font-size: 18px; color: #333333; margin: 0; padding: 0;">and our team will contact you shortly.</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="text-align: center; padding: 20px; background-color: #ea2735;">
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #ffffff;">© {{ date('Y') }} Art of Indian Cuisine. All rights reserved.</p>
                          
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>