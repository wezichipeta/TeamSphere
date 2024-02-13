<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Kudos</title>
</head>
<body>
    <h1>Give Kudos</h1>
    <p>This is where you can give kudos to your colleagues.</p>
    <!-- Add form to give kudos -->
    <form action="give_kudos_handler.php" method="post">
        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>