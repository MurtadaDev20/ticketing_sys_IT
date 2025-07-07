<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Ticket Approved</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #4CAF50; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>🎫 Ticket Approved</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>The ticket titled <strong>{{ $ticketTitle }}</strong> has been <span style="color: #4CAF50; font-weight: bold;">approved</span>.</p>
                <p>Please contact the IT department to complete the process.</p>

                <hr style="margin: 20px 0;">

                <h4>🏢 Al-Mansour Bank</h4>
                <p style="margin-top: 30px;">Best regards,<br><strong>IT Support Team</strong></p>
            </td>
        </tr>
        <tr>
            <td style="padding: 15px; text-align: center; font-size: 12px; color: #777; background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                &copy; {{ date('Y') }} Al-Mansour Bank. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>