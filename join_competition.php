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
    <title>Join Competition</title>
</head>
<body>
    <h2>Join Competition</h2>
    <p>This is where you can join competitions.</p>
    <!-- Add form to join competition -->
    <form action="join_competition_handler.php" method="post">
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <button type="submit">Join</button>
    </form>
</body>
<?php require_once('footer.php'); ?>
</html>