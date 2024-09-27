<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket Closed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Support Ticket Closed</h1>
    <p>Hello {{ $ticket->creator->name }},</p>

    <p>We wanted to inform you that your support ticket has been successfully closed.</p>

    <p><strong>Ticket Details:</strong></p>
    <ul>
        <li><strong>Issue:</strong> {{ $ticket->issue_details }}</li>
        <li><strong>Closed At:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</li>
    </ul>

    <p>If you have any further questions or issues, feel free to open another ticket.</p>

    <p>Thank you for using our support service!</p>

    <div class="footer">
        <p>Best Regards,<br>Your Support Team</p>
        <p>Need further assistance? <a href="#">Contact us</a>.</p>
    </div>
</div>
</body>
</html>
