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
                            <h1 style="font-family: Arial, sans-serif; font-size: 24px; color: #980406;">Hall Change Request Received</h1>
                            <p
                                style="font-family: Arial, sans-serif; font-size: 13px; line-height: 20px; color: #000000;">
                                Dear {{ $hallOrder->user->first_name . ' ' . $hallOrder->user->last_name }},
                                Your hall change request has been received.
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
                                                style="color:#980406; font-weight: bold;">{{ $hallOrder->hall_request_id }}</span>
                                        </p>
                                    </td>
                                    <td align="right">


                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Request Status: <span style="color:#980406; font-weight: bold;">{{ $hallOrder->getLatestStatus() }}</span>
                                        </p>

                                        <p
                                            style="font-family: Arial, sans-serif; font-size: 14px; color: #666666; line-height: 16px; margin-bottom: 0; padding-bottom: 0;">
                                            Total Amount: <span style="color:#980406; font-weight: bold;">$ {{ $hallOrder->total_amount }}</span>
                                        </p>

                                    </td>

                                </tr>

                            </table>

                            <p
                                style="font-family: Arial, sans-serif; font-size: 16px; line-height: 18px; margin: 0; padding: 0; color: #000000; font-weight: bold;">
                                USER INFO</p>

                            <table cellpadding="0" cellspacing="0" border="1" borderColor="#eeeeee" width="100%"
                                style="margin-top: 10px;">
                                @if($hallOrder->type_of_event == 'community')
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Community  Name:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        
                                            {{ $hallOrder->user->community_name }}
                                        
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Individual  Name:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        
                                            {{ $hallOrder->user->first_name . ' ' . $hallOrder->user->last_name }}
                                        
                                    </td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Address:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $hallOrder->user->address }},{{ $hallOrder->user->city }},{{ $hallOrder->user->state }},{{ $hallOrder->user->zip_code }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Contact No:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="tel:{{ $hallOrder->user->mobile }}"
                                            style="text-decoration: none; color: #980406; font-weight:bold;">{{ $hallOrder->user->mobile }}</a>
                                    </td>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Email
                                    </td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        <a href="mailto:{{ $hallOrder->user->email }}"
                                            style="text-decoration: none; color: #980406; font-weight:bold;">
                                            {{ $hallOrder->user->email }}</a>
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
                                        Type of Event:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $hallOrder->type_of_event }}</td>
                                        <span style="color:#980406; font-weight: bold; display: block;"></span>
                                </tr>
                                @if($hallOrder->type_of_event == 'community')
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Event Duration</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        @if($hallOrder->event_duration == 'multiple-days')
                                        {{$hallOrder->number_of_days}} Day Event
                                        @else
                                            1 Day Event
                                        @endif</td>
                                        <span style="color:#980406; font-weight: bold; display: block;"></span>
                                </tr>
                                @endif
                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Date of Event:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ formatDate($hallOrder->date_of_event) }}</td>
                                        <span style="color:#980406; font-weight: bold; display: block;">( Rescheduled
                                            )</span>
                                    
                                </tr>

                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Event Start Time</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ formatTime($hallOrder->start_time) }}</td>
                                        <span style="color:#980406; font-weight: bold; display: block;">( Rescheduled
                                            )</span>
                                </tr>

                                <tr>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Duration</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $hallOrder->duration }} Hours</td>
                                        <span style="color:#980406; font-weight: bold; display: block;"></span>
                                </tr>
                                <tr bgColor="#f1f1f1">
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        Comments:</td>
                                    <td
                                        style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                        {{ $hallOrder->changed_comments }}</td>
                                        <span style="color:#980406; font-weight: bold; display: block;"></span>
                                </tr>
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
                                
                                    @php $total = 0; @endphp
                                
                                    @foreach($halls as $hall)
                                        <tr @if($loop->even) bgColor="#f1f1f1" @endif>
                                            <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                <strong>{{ $hall->name }} @if($hall->no_of_hours) (For {{ $hall->no_of_hours }} hours) @endif</strong>
                                            </td>
                                            <td align="right" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                <span style="text-decoration: none; font-weight:bold;">$ {{ number_format($hall->hall_cost, 2) }}</span>
                                            </td>
                                        </tr>
                                        @php $total += $hall->hall_cost; @endphp
                                
                                        @if($hall->addons->isNotEmpty())
                                            @foreach($hall->addons as $addon)
                                                <tr @if($loop->even) bgColor="#f9f9f9" @endif>
                                                    <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px 10px; border-bottom: 1px solid #eeeeee;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;→ {{ $addon->name }} @if($addon->no_of_hours) (For {{ $addon->no_of_hours }} hours) @endif
                                                    </td>
                                                    <td align="right" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 17px; color: #333333; padding: 5px; border-bottom: 1px solid #eeeeee;">
                                                        <span style="text-decoration: none; font-weight:bold;">$ {{ number_format($addon->addon_cost, 2) }}</span>
                                                    </td>
                                                </tr>
                                                @php $total += $addon->addon_cost; @endphp
                                            @endforeach
                                        @endif
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