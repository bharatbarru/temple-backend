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
                        <td align="center">@include('emails.partials.logo')</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <h1 style="font-family: Arial, sans-serif; font-size: 24px; color: #980406;">New Puja Request Recieved</h1>
                            <p
                                style="font-family: Arial, sans-serif; font-size: 13px; line-height: 20px; color: #000000;">
                                Dear <b> Admin,
                                </b> <br/>
                                You Have Recieved a New Puja Request 
                                <br/>
                                Please find the details of the request below.
                               </p>
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
                                                style="color:#980406; font-weight: bold;">{{ $pujaOrder->puja_request_id }}</span>
                                        </p>
                                    </td>
                                    <td align="right">


                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Request Status: <span style="color:#980406; font-weight: bold;">{{ $pujaOrder->getLatestStatus() }}</span>
                                        </p>

                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Total Amount: <span style="color:#980406; font-weight: bold;">$ {{ $pujaOrder->total_amount }}</span>
                                        </p>

                                    </td>

                                </tr>

                            </table>

                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding: 0; color: #000000; font-weight: bold;">
                                USER INFO</p>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
                                style="margin-top: 10px;">
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Name:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $pujaOrder->user->first_name . ' ' . $pujaOrder->user->last_name }}</td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Address:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $pujaOrder->user->address }},{{ $pujaOrder->user->city }},{{ $pujaOrder->user->state }},{{ $pujaOrder->user->zip_code }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Contact No:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="tel:{{ $pujaOrder->user->mobile }}"
                                            style="text-decoration: none; color: #980406; font-weight:bold;">{{ $pujaOrder->user->mobile }}</a>
                                    </td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Email:
                                    </td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="mailto:{{ $pujaOrder->user->email }}"
                                            style="text-decoration: none; color: #980406; font-weight:bold;">
                                            {{ $pujaOrder->user->email }}</a>
                                    </td>
                                </tr>
                               
                            </table>





                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding:15px 0 0 0; color: #000000; font-weight: bold;">
                                PUJA INFO</p>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
                                style="margin-top: 10px;">
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Date of Puja:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{formatDate($pujaOrder->date_of_puja) }}
                                      
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Puja Timings:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $pujaOrder->time_of_puja }}
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Alternative Date one:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{formatDate($pujaOrder->alternate_date_of_puja1) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Alternative Time 1:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $pujaOrder->alternate_time_of_puja2 }}
                                    </td>
                                </tr>
                               


                            </table>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%" style="margin-top: 20px;">
                                <tr>
                                    <th style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Puja / Service - {{$pujaOrder->puja_location == 'home' ? 'Home' : 'Temple'}}
                                    </th>
                                    <th style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Charge Amount
                                    </th>
                                </tr>
                            
                                @php $total = 0; @endphp
                            
                                @foreach($halls as $hall)
                                    <tr @if($loop->even) bgColor="#f1f1f1" @endif>
                                        <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                            {{ $hall->name }}
                                        </td>
                                        <td align="right" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                            <span style="text-decoration: none; font-weight:bold;">$ {{ number_format($hall->puja_cost, 2) }}</span>
                                        </td>
                                    </tr>
                                    @php $total += $hall->puja_cost; @endphp
                                @endforeach
                            
                                <tr bgColor="#b40b0d">
                                    <td align="right" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 17px; color: #ffffff; padding: 5px; border-bottom: 1px solid #eeeeee; font-weight: bold;">
                                        Total
                                    </td>
                                    <td align="right" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 17px; color: #ffffff; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <span style="color:#ffffff; text-decoration: none; font-weight:bold;">$ {{ number_format($total, 2) }}</span>
                                    </td>
                                </tr>
                            </table>

                            @include('emails.partials.payment-details', ['audience' => 'admin'])
                            <p
                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 1.5; margin-top: 20px; text-align: center;">
                            If you have any questions, feel free to reply to this <a href="mailto:{!! applicationSettings('secondary-email') !!}"
                            style="text-decoration: none; color: #980406; font-weight:bold;">
                            {!! applicationSettings('secondary-email') !!}</a>, and our team will get back
                            to you as soon as possible. 
                        </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="text-align: center; padding: 20px; background-color: #980406;">
                            <p style="font-family: Arial, sans-serif; font-size: 14px; color: #ffffff;">&copy; {{ date('Y') }} {{ emailCopyrightText() }}</p>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>