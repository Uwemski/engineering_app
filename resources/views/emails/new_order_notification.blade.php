<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Notification</title>
</head>
<body>
    <h1>New Order Created</h1>

    <p>Hello Admin,</p>
    <p>A new order has been created, Details:</p>
    <ul>
        <li>amount: {{$order->total_amount}}</li>
        <li>Payment Status: {{$order->payment_status}}</li>
        <li>Date: {{$order->created_at}}</li>
    </ul>

    <p>Please do the necessary, thank you</p>
    <p>Best regards, DONPASS Company Ltd</p>
</body>
</html>