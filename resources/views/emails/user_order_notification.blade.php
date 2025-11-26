<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Notification</title>
</head>
<body>
    <h1>New Order Created</h1>

    <p>Hello Customer,</p>
    <p>You have created a new order, Details:</p>
    <ul>
        <li>Name: {{$order->user->name}}</li>
        <li>Email: {{$order->user->email}}</li>
        <li>Product: {{$order->product->name}}</li>
        <li>amount: {{$order->total_amount}}</li>
        <li>Status: {{$order->status}}</li>
        <li>Date: {{$user->created_at}}</li>
    </ul>

    
    <p>Best regards, DONPASS Company Ltd</p>
</body>
</html>