<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Digital Dost</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #222;">
    <h2>Thanks for subscribing to Digital Dost</h2>

    <p>You are now subscribed to our newsletter and will receive updates on tech news, reviews, AI, gadgets, and buying guides.</p>

    <p>We are glad to have you with us.</p>

    <p style="margin-top: 24px;">
        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}">
            Unsubscribe
        </a>
    </p>
</body>
</html>