<!DOCTYPE html>
<html>
<head>
    <title>Your Ticket Has Been Closed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Ticket Has Been Closed</h1>
        {{-- <p><strong>Title:</strong> {{ $ticket->ticket_title }}</p>
        <p><strong>Description:</strong> {{ $ticket->ticket_desc }}</p>
        <p><strong>Closed At:</strong> {{ $ticket->close_ticket_at }}</p>
        <p><strong>Final Degree:</strong> {{ $ticket->degree }}</p> --}}
        <p>Thank you for using our support service. If you have any further issues, please feel free to open a new ticket.</p>

        <div class="footer">
            <p>Thank you for choosing our service!</p>
        </div>
    </div>
</body>
</html>
