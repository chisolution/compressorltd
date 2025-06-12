<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        /* Base */
        body {
            background-color: #f8fafc;
            color: #2d3748;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            background-color: #f8fafc;
            padding: 40px 20px;
        }
        .email-content {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
            max-width: 600px;
            padding: 30px;
        }
        .header {
            margin-bottom: 30px;
            text-align: center;
        }
        .logo {
            height: auto;
            max-width: 200px;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 0.875rem;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
        }
        .button {
            background-color: #33c4aa;
            border-radius: 4px;
            color: #ffffff;
            display: inline-block;
            font-weight: 600;
            margin: 20px 0;
            padding: 12px 24px;
            text-decoration: none;
        }
        .panel {
            background-color: #f8fafc;
            border-radius: 4px;
            margin: 20px 0;
            padding: 20px;
        }
        .info-row {
            margin: 10px 0;
        }
        .info-label {
            color: #4a5568;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            @yield('content')
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <p>This is an automated message. Please do not reply to this email.</p>
            </div>
        </div>
    </div>
</body>
</html>
