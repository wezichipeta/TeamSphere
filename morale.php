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
    <title>Morale Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2>Morale </h2>
    </header>
    
    <main>
        <section>
            <h5>Birthday Celebrations</h5>
            <button onclick="location.href='birthday.php';">View Birthday Celebrations</button>
        </section>
        
        <section>
            <h5>Competitions</h5>
            <button onclick="location.href='competitions.php';">View Competitions</button>
        </section>
        
        <section>
            <h5>Kudos Page</h5>
            <button onclick="location.href='kudos.php';">View Kudos</button>
        </section>
    </main>
    
    </body>

<?php require_once('footer.php'); ?>

</html>