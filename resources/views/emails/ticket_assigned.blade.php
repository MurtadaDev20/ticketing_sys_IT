<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Assigned to You</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #4CAF50; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>🎯 A Ticket Has Been Assigned to You</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>A ticket has been assigned to you. Here are the details:</p>

                <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px;">
                    <tr>
                        <td><strong>Assigned By:</strong></td>
                        <td>{{ $ticket->admin->name }}</td>
                    </tr>
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
                        <td><strong>Requested By:</strong></td>
                        <td>{{ $ticketUser }}</td>
                    </tr>
                </table>

                <hr style="margin: 20px 0;">

                <p>Please log in to your support dashboard to view or respond to the ticket.</p>

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
