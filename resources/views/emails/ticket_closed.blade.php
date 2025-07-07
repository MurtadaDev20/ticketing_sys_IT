<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Closed</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #e53935; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>✅ Ticket Closed</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>Your ticket titled <strong>{{ $ticketTitle }}</strong> has been closed.</p>

                <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px; margin-top: 10px;">
                    <tr>
                        <td><strong>Closed By:</strong></td>
                        <td>{{ $CloseTicketBy }}</td>
                    </tr>
                    <tr>
                        <td><strong>Comment:</strong></td>
                        <td>{{ $comment }}</td>
                    </tr>
                </table>

                <hr style="margin: 20px 0;">

                <p>If you have any further issues, feel free to open a new ticket at any time.</p>

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
