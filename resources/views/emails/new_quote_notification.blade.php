<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification for admin</title>
</head>
<body>
    <h1>New Quotation Request</h1>

    <p>Good day, a new quotation has just been created, detail:</p>
    <ul>
        <li>{{$quotation->subject}}</li>
        <li>{{$quotation->description}}</li>
        <li>{{$quotation->created_at->format('d M Y')}}</li>
    </ul>

    <p>KIndly check dashboard to view more information</p>
    <p>Best regards, DONPASS Company Ltd</p>
</body>
</html>