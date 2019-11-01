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
    <tr><td>Dear Admin,</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>I am {{ $name }}!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>I have some enquiries to know!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>The Enquiry Details is given Below:</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><strong>Name:</strong> {{ $name }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><strong>Email:</strong> {{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><strong>Phone:</strong> {{ $phone }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><strong>Message:</strong> {{ $comment }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards,</td></tr>
    <tr><td>DailyDeals E-commerce</td></tr>
</table>

</body>
</html>