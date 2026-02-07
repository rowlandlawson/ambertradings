<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Code</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>You requested a password reset. Your reset code is: <strong>{{ $code }}</strong></p>
    <p>This code will expire in 15 minutes.</p>
    <p>If you did not request this, please ignore this email.</p>
    <p>Thank you,<br>Amber Tradings Team</p>
</body>
</html>
