<?php
require_once('header.php');

// User authentication check
if (!isset($_SESSION['user'])) {
    header('Location: signin.php'); // Redirect to login page if not authenticated
    exit();
}

$userId = $_SESSION['user']['user_id']; // Make sure 'user_id' exists in the session array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Wishes</title>
</head>
<body>
    <h3>Send Wishes</h3>
    <p>This is where you can send birthday wishes to your colleagues.</p>
    <!-- Add form to send wishes -->
    <form action="send_wishes_handler.php" method="post">
        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>
<?php require_once('footer.php'); ?>
</html>