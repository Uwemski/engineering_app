<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Notification</title>
</head>
<body>
    <h1>New user Registered</h1>

    <p>Hello Admin,</p>
    <p>A new user just Registrered, Details:</p>
    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Date: {{$user->created_at}}</li>
    </ul>

    <p>Best regards, DONPASS Company Ltd</p>
</body>
</html>