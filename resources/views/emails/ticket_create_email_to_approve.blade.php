<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Ticket Created for Approval</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #2196F3; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>📩 New Ticket Created</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>A new ticket has been submitted by <strong>{{ $ticketUser }}</strong>. Please review the details for approval:</p>

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
                        <td><strong>Sub Category:</strong></td>
                        <td>{{ $ticketSubCategory }}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At:</strong></td>
                        <td>{{ $created_at }}</td>
                    </tr>
                </table>

                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ URL(route('user.AllTickets')) }}" style="background-color: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        🔍 View Ticket
                    </a>
                </div>

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
