<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Ticket Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #4CAF50; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>🆕 New Ticket Submitted</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>A new ticket has been created by <strong>{{ $ticketUser }}</strong>. Below are the ticket details:</p>

                <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px;">
                    <tr>
                        <td><strong>Title:</strong></td>
                        <td>{{ $ticketTitle }}</td>
                    </tr>
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{ $ticketDescription }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        <td>{{ $ticketCategory }}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At:</strong></td>
                        <td>{{ $created_at }}</td>
                    </tr>
                    <tr>
                        <td><strong>Submitted By:</strong></td>
                        <td>{{ $ticketUser }}</td>
                    </tr>
                </table>

                <p style="margin-top: 30px;">Please log in to your dashboard to review and process the ticket.</p>

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
