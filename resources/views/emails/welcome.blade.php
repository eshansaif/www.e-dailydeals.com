<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Email from Daily Deals</title>
</head>
<body>
<table>
    <tr><td>Dear {{ $name }}!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your account has been successfully activated.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your account information is as below:</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email: {{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: ***** (as chosen by you)</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards,</td></tr>
    <tr><td>E-com website</td></tr>
</table>

</body>
</html>