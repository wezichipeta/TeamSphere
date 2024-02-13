<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Wishes</title>
</head>
<body>
    <h1>Send Wishes</h1>
    <p>This is where you can send birthday wishes to your colleagues.</p>
    <!-- Add form to send wishes -->
    <form action="send_wishes_handler.php" method="post">
        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>