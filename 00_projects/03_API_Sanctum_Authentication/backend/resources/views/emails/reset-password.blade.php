<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forogot Password</title>
</head>
<body style="margin: 100px;">
    <h1>You have requested to reset your password</h1>
    <hr>
    <p>We can't simply send you your old password. A unique link to reset your password has been generated for you. To reset your password, click on the following link and follow the instructions.</p>
    <p style="font: bold; color:red;">Link is valid for 4 minutes.</p>
    <a href="{{$resetUrl}}" target="_blank">
        Click here to Reset Password
    </a>
</body>
</html>
