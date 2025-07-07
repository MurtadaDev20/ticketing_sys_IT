<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Report Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; background-color: #1e88e5; color: #ffffff; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2>📄 New Report Created</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,</p>
                <p>A new report has been created. Here are the details:</p>

                <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px;">
                    <tr>
                        <td><strong>Report Name:</strong></td>
                        <td>{{ $reportName }}</td>
                    </tr>
                    <tr>
                        <td><strong>Header:</strong></td>
                        <td>{{ $reportHeader }}</td>
                    </tr>
                    <tr>
                        <td><strong>Type/Date Type:</strong></td>
                        @if ( $reportTypeDate == "1")
                            <td>Cumulative</td>
                        @elseif ( $reportTypeDate == "2")
                            <td>specificDate</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Reason for Request:</strong></td>
                        @if ( $reportReasonRequest == "1")
                            <td>Internal</td>
                        @elseif ( $reportReasonRequest == "2")
                            <td>Central_Bank</td>
                        @elseif ( $reportReasonRequest == "3")
                            <td>Board</td>
                        @else
                            <td>Regulatory</td>
                        @endif
                    </tr>
                   
                    <tr>
                        <td><strong>Date From:</strong></td>
                        <td>{{ $reportDateFrom ?? "- empty -" }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date To:</strong></td>
                        <td>{{ $reportDateTo ?? "- empty -" }}</td>
                    </tr>
                    <tr>
                        <td><strong>Report Date:</strong></td>
                        <td>{{ $reportDate ?? "- empty -"}}</td>
                    </tr>
                </table>

                <hr style="margin: 20px 0;">

                <h4>📌 Created By</h4>
                <p>
                    Name: {{ $reportCreator }}<br>
                    Email: {{ $reportCreatorEmail }}<br>
                </p>

                <p style="margin-top: 30px;">Best regards,<br><strong>Ticketing System</strong></p>
            </td>
        </tr>
        <tr>
            <td style="padding: 15px; text-align: center; font-size: 12px; color: #777; background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>