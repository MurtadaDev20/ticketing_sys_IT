<!DOCTYPE html>
<html>
<head>
    <title>New Ticket Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
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
        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .marg {
            margin: 10px;
        }
        img {
            max-width: 150px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div class="marg">
        <div class="image-container">
            Al-Mansour Bank
        </div>
        <div class="email-container">
            <h1>New Ticket Created by {{ $ticketUser }} - Kindly Review for Approval</h1>
            <p><span class="highlight">Title:</span> {{ $ticketTitle }}</p>
            <p><span class="highlight">Description:</span> {{ $ticketDescription }}</p>
            <p><span class="highlight">Category:</span> {{ $ticketCategory }}</p>
            <p><span class="highlight">Sub Category:</span> {{ $ticketSubCategory }}</p>
            <p><span class="highlight">Created At:</span> {{ $created_at }}</p>
            <p>You have a new ticket from <span class="highlight">{{ $ticketUser }}</span></p>

            <div class="footer">
                <p>Thank you for using our support service.</p>
            </div>
            <a href="{{URL(route('user.AllTickets'))}}">Go Now</a>
        </div>
    </div>
</body>
</html>
