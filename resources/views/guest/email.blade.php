<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry</title>
</head>
<body>
    <h1>New Enquiry</h1>
    <p>Good day, a new enquiry has been submiited, details below:</p>

    <ul>
        <li>Name: {{$enquiry->name}}</li>
        <li>Email: {{$enquiry->email}}</li>
        <li>Subject: {{$enquiry->message}}</li>
    </ul>

    <p>Please respond when necesssary,</p>
    <p>Best regards, DONPASS Company Ltd</p>
</body>
</html>