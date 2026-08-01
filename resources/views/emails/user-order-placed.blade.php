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
                        <td align="center"><img style="line-height: 1px; margin: 0; padding: 0;" width="250px" height="105px" src="https://artofindiancuisine.com/assets/artblackLogo-0445f859.png" /></td>
                     </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <h1 style="font-family: Arial, sans-serif; font-size: 24px; color: #333;">Thank you for your order</h1>
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #666;">Order has been successfully placed</p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 20px;">
                            <p style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">Hello {{ $order->customer ? $order->customer->name : $order->guest_name }},</p>
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #666; line-height: 1.5;">
                                Order Details
                            </p>
                            <table cellpadding="0" cellspacing="0" border="1" width="100%" style="margin-top: 20px;">
                                <tr>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">Order ID:</td>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">{{ $order->orderid }}</td>
                                </tr>
                                <tr>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">Order Type:</td>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">{{ $order->order_type }}</td>
                                </tr>
                                @if($order->order_type == 'home-delivery')
                                <tr>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">Delivery Address:</td>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd;">{{ $order->delivery_address }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd; font-weight: bold;">Total Amount
                                    </td>
                                    <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333; padding: 10px; border-bottom: 1px solid #ddd; font-weight: bold">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
					
					<tr>
                        <td style="padding:0 20px;">
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #666; line-height: 1.5;">
                                Order Summary
                            </p>
                            <table cellpadding="0" cellspacing="0" border="1" width="100%" style="margin-top: 0px; text-align: left;">
                                <thead>
                                    <tr>
                                        <th style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">Product	</th>
                                        <th style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">Quantity	</th>
                                        <th style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">Unit Price	</th>
                                        <th style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">Subtotal </th>
                                    </tr>

                                    @foreach ($order->orderProducts as $orderProduct)
                                        <tr>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">{{ $orderProduct->product->title }}</td>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">{{ $orderProduct->quantity }}</td>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">{{ formatAmount($orderProduct->price) }}</td>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd;">{{ formatAmount(($orderProduct->quantity*$orderProduct->price)) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="3" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Sub Total	</td>
                                        <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->subtotal_amount) }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Tax ({{ applicationSettings('tax') }}%)		</td>
                                        <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->tax_amount) }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Delivery Charges</td>
                                        <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->delivery_charge) }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Coupon Discount</td>
                                        <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->coupon_discount) }}</td>
                                    </tr>

                                    @if($order->royalty_points_amount)
                                        <tr>
                                            <td colspan="3" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Royalty Points Discount</td>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->royalty_points_amount) }}</td>
                                        </tr>
                                    @endif

                                    <tr>       
                                        <td colspan="3" style="font-family: Arial, sans-serif; font-size: 14px; font-weight: bold;  color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; text-align: right;">Final Amount			</td>
                                        <td style="font-family: Arial, sans-serif; font-size: 14px; color: #333333; padding: 8px; border-bottom: 1px solid #dddddd; font-weight: bold;">{{ formatAmount($order->total_amount) }}</td>
                                    </tr>
                                </thead>
                            </table>
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #666; line-height: 1.5; margin-top: 20px; text-align: center;">
                                If you have any questions, feel free to reply to this email, and our team will get back to you as soon as possible.
                            </p>
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
