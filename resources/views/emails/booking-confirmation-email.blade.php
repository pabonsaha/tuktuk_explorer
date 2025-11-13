<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body
    style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f3f4f6;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background-color: #ffffff; max-width: 600px; width: 100%;">

                <!-- Header with Logo -->
                <tr>
                    <td style="background-color: #ffffff; padding: 40px 40px 30px; text-align: center; border-bottom: 1px solid #e5e7eb;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" style="display: inline-block;">
                                        <tr>
                                            <td style="vertical-align: middle; padding-right: 12px;">
                                                <img
                                                    style="width: 50px; height: 50px; background-color: #f97316; border-radius: 6px;"
                                                    src="{{asset('/logo/logo.ico')}}" alt="logo"/>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <span
                                                    style="font-size: 28px; font-weight: bold; color: #111827; letter-spacing: -0.5px;">TukTuk Explorer</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


                <!-- Title and Subtitle -->
                <tr>
                    <td style="padding: 0 40px 40px; text-align: center;">
                        <h1 style="margin: 0 0 16px 0; font-size: 32px; font-weight: bold; color: #111827; line-height: 1.2;">
                            Booking Confirmed!</h1>
                        <p style="margin: 0; font-size: 16px; color: #6b7280; line-height: 1.6;">
                            Thank you for choosing TukTuk Explorer Travel! Your adventure awaits. We're excited to have you join
                            us.
                        </p>
                    </td>
                </tr>

                <!-- Booking Details Card -->
                <tr>
                    <td style="padding: 0 40px 30px;">
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background-color: #f9fafb; border-radius: 12px; overflow: hidden;">
                            <tr>
                                <td style="padding: 24px;">
                                    <h2 style="margin: 0 0 20px 0; font-size: 18px; font-weight: bold; color: #111827;">
                                        Booking Summary</h2>

                                    <!-- Booking Row -->
                                    <table width="100%" cellpadding="8" cellspacing="0"
                                           style="border-bottom: 1px solid #e5e7eb;">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">Booking ID</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600;">
                                                #{{ $data->code }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%" cellpadding="8" cellspacing="0"
                                           style="border-bottom: 1px solid #e5e7eb;">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">Tour Name</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600; max-width: 250px;">{{ $data->title }}</td>
                                        </tr>
                                    </table>


                                    <table width="100%" cellpadding="8" cellspacing="0"
                                           style="border-bottom: 1px solid #e5e7eb;">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">📅 Date</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600;">{{  \Carbon\Carbon::parse($data->tour_date)->format('d F Y') }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%" cellpadding="8" cellspacing="0"
                                           style="border-bottom: 1px solid #e5e7eb;">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">🕐 Time</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600;">{{  $data->tour_time }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%" cellpadding="8" cellspacing="0"
                                           style="border-bottom: 1px solid #e5e7eb;">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">⏱️ Duration</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600;">{{ $data->hour }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%" cellpadding="8" cellspacing="0">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">👥 Guests</td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 600;">{{ $data->passengers }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Price Breakdown -->
                <tr>
                    <td style="padding: 0 40px 30px;">
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background-color: #fff7ed; border: 2px solid #fed7aa; border-radius: 12px; overflow: hidden;">
                            <tr>
                                <td style="padding: 24px;">
                                    <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: bold; color: #111827;">
                                        💰 Payment Summary</h3>

                                    <!-- Tour Price -->
                                    <table width="100%" cellpadding="6" cellspacing="0">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px;">Tour Price
                                                ({{ $data->passengers }} × €{{ $data->per_pessenger_price }})
                                            </td>
                                            <td align="right"
                                                style="color: #111827; font-size: 14px; font-weight: 500;">
                                                €{{ $data->passenger_price }}</td>
                                        </tr>
                                    </table>
                                    @if($data->additionals != [] && !empty($data->additionals))

                                        <!-- Divider -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin: 12px 0;">
                                            <tr>
                                                <td style="border-top: 1px solid #fed7aa; padding-top: 12px;">
                                                    <strong style="font-size: 14px; color: #111827;">Additional
                                                        Services:</strong>
                                                </td>
                                            </tr>
                                        </table>
                                        @foreach(json_decode($data->additionals) as $value)
                                            <!-- Additional Services -->
                                            <table width="100%" cellpadding="6" cellspacing="0">
                                                <tr>
                                                    <td style="color: #6b7280; font-size: 14px;">{{$value->title}} ({{ $value->count }} × €{{ $data->price }})</td>
                                                    <td align="right"
                                                        style="color: #111827; font-size: 14px; font-weight: 500;">
                                                        €{{$value->price*$value->count}}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endforeach

                                    @endif



                                    <!-- Total -->
                                    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 12px;">
                                        <tr>
                                            <td style="color: #111827; font-size: 18px; font-weight: bold; padding: 8px 0;">
                                                Total Amount
                                            </td>
                                            <td align="right"
                                                style="color: #f97316; font-size: 28px; font-weight: bold; padding: 8px 0;">
                                                €{{ $data->total_price }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Contact Card -->
                <tr>
                    <td style="padding: 0 40px 30px;">
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background-color: #fef3c7; border: 2px solid #fde68a; border-radius: 12px;">
                            <tr>
                                <td style="padding: 24px;">
                                    <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; color: #111827;">
                                        📞 Need Help?</h3>
                                    <p style="margin: 0 0 12px 0; color: #6b7280; font-size: 14px; line-height: 1.5;">
                                        Our team is here to assist you 24/7. Contact us anytime:
                                    </p>
                                    <p style="margin: 0; font-size: 14px; line-height: 1.8;">
                                        <strong style="color: #111827;">Phone:</strong> <a href="tel:+11234567890"
                                                                                           style="color: #f97316; text-decoration: none; font-weight: 600;">+351
                                            920 204 443</a><br>
                                        <strong style="color: #111827;">Email:</strong> <a
                                            href="mailto:support@travel.com"
                                            style="color: #f97316; text-decoration: none; font-weight: 600;">tuktuk.lisbon3400@gmail.com</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Important Information -->
                <tr>
                    <td style="padding: 0 40px 40px;">
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background-color: #f9fafb; border-radius: 12px;">
                            <tr>
                                <td style="padding: 24px;">
                                    <h3 style="margin: 0 0 12px 0; font-size: 16px; font-weight: bold; color: #111827;">
                                        ⚠️ Important Reminders</h3>
                                    <ul style="margin: 0; padding-left: 20px; color: #6b7280; font-size: 14px; line-height: 1.8;">
                                        <li style="margin-bottom: 8px;">Please arrive <strong>15 minutes early</strong>
                                            at the meeting point
                                        </li>
                                        <li style="margin-bottom: 8px;">Bring a <strong>valid ID</strong> for
                                            verification purposes
                                        </li>
                                        <li style="margin-bottom: 8px;">Wear comfortable clothing and closed-toe shoes
                                        </li>
                                        <li style="margin-bottom: 8px;">Free cancellation up to <strong>24
                                                hours</strong> before tour date
                                        </li>
                                        <li>Weather conditions may affect tour schedule</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color: #111827; padding: 40px; text-align: center;">
                        <p style="margin: 0 0 8px 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                            © 2025 TukTuk Explorer Travel. All rights reserved.
                        </p>
                        <p style="margin: 0 0 16px 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                            Garagem Manique, LDA Rua da Bombarda, 58-B 1100-100 Lisboa
                        </p>
                        <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.6;">
                            <a href="mailto:tuktuk.lisbon3400@gmail.com" style="color: #f97316; text-decoration: none;">tuktuk.lisbon3400@gmail.com</a>
                            <span style="color: #9ca3af;"> | </span>
                            <a href="tel:+351920204443" style="color: #f97316; text-decoration: none;">+351 920 204
                                443</a>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
