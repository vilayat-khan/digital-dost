<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #222;">
    <h2>New Contact Message</h2>

    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>

    <p><strong>Message:</strong></p>
    <div style="padding:12px; background:#f6f6f6; border-radius:8px;">
        {!! nl2br(e($data['message'])) !!}
    </div>
</body>
</html>