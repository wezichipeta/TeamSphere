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
    <title>Birthday Celebrations</title>
</head>
<body>
    <h2>Birthday Celebrations</h2>
    <p>This is where you can view and celebrate birthdays.</p>
    
    <!-- Add more buttons for additional functionality -->
    <button onclick="location.href='send_wishes.php';">Send Wishes</button>
    <button onclick="location.href='view_upcoming.php';">View Upcoming Birthdays</button>
</body>
<?php require_once('footer.php'); ?>

</html>
