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
            <p>Al-Mansour Bank</p>
        </div>
        <div class="email-container">
            <h1>Ticket Rejection Notice: {{ $ticketTitle }}</h1>
            <p><strong>Reason:</strong> {{ $comment }}</p>

            <div class="footer">
                <p>Thank you for using our support service.</p>
            </div>
        </div>
    </div>
</body>
</html>
