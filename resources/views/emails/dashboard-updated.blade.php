<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amber Tradings - Dashboard Update</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        .header {
            background: linear-gradient(90deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%);
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #1a1a2e;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
            color: #fff;
        }
        .greeting {
            font-size: 20px;
            margin-bottom: 20px;
            color: #d4af37;
        }
        .message {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
            color: #e0e0e0;
        }
        .update-box {
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
        }
        .update-box h3 {
            color: #d4af37;
            margin-top: 0;
            font-size: 18px;
        }
        .update-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .update-item:last-child {
            border-bottom: none;
        }
        .update-label {
            color: #a0a0a0;
        }
        .update-value {
            color: #4ade80;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #d4af37 0%, #f4d03f 100%);
            color: #1a1a2e;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
        }
        .footer {
            background: rgba(0, 0, 0, 0.3);
            padding: 25px 30px;
            text-align: center;
            color: #888;
            font-size: 13px;
        }
        .footer a {
            color: #d4af37;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <p>Amber Tradings</p>
        </div>
        
        <div class="content">
            <p class="greeting">Hello, {{ $user->name }}!</p>
            
            <p class="message">
                @if($updateType === 'balance_updated')
                    Great news! Your account balance has been updated by our team.
                @elseif($updateType === 'investment_added')
                    A new investment has been added to your portfolio.
                @elseif($updateType === 'investment_updated')
                    One of your investments has been updated.
                @elseif($updateType === 'profit_credited')
                    Congratulations! Profit has been credited to your account.
                @elseif($updateType === 'deposit_approved')
                    Your deposit request has been approved and your balance updated.
                @elseif($updateType === 'deposit_rejected')
                    Your deposit request has been rejected. Please see details below.
                @else
                    Your dashboard has been updated with new information.
                @endif
            </p>
            
            <div class="update-box">
                <h3>📊 Update Details</h3>
                
                @foreach($updateDetails as $label => $value)
                <div class="update-item">
                    <span class="update-label">{{ $label }}: </span>
                    <span class="update-value">{{ $value }} </span>
                </div>
                @endforeach
                
                @if(empty($updateDetails))
                <p style="color: #e0e0e0; margin: 0;">Please login to your dashboard to view the latest updates.</p>
                @endif
            </div>
            
            <p class="message">
                Login to your dashboard to view all the details and manage your investments.
            </p>
            
            <center>
                <a href="{{ url('/dashboard') }}" class="cta-button">View Dashboard</a>
            </center>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }}</p>
            <p>© {{ date('Y') }} Amber Tradings. All rights reserved.</p>
            <p>
                <a href="{{ url('/') }}">Visit Website</a> | 
                <a href="{{ url('/contact') }}">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
