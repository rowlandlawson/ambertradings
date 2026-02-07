<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>Your verification code is: <strong>{{ $code }}</strong></p>
    <p>This code will expire in 15 minutes.</p>
    <p>Thank you,<br>Amber Tradings Team</p>
</body>
</html>
