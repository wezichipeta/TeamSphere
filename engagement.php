
<?php
require_once('header.php');
require_once('config.php'); // Make sure this file exists and correctly sets up the database connection
require_once('functions.php'); // This should contain your event-related functions

// User authentication check
session_start();
if (!isset($_SESSION['user_id'])) {
   header('Location: login.php'); // Redirect to login page if not authenticated
    exit();
}

// Handle event creation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createEvent'])) {
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventLocation = $_POST['eventLocation'];
    $eventDate = $_POST['eventDate'];
    $createdBy = $_SESSION['user_id']; // Assuming user ID is stored in the session

    create_event($eventName, $eventDesc, $eventLocation, $eventDate, $createdBy); // Function to create an event
}

// Handle joining an event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['joinEvent'])) {
    $eventId = $_POST['eventId'];
    $userId = $_SESSION['user_id'];

    join_event($userId, $eventId); // Function to join an event
}

?>

<h1>Engagement</h1>

<!-- Event Creation Form -->
<form action="engagement.php" method="post">
    <label for="eventName">Event Name:</label>
    <input type="text" id="eventName" name="eventName" required><br>

    <label for="eventDesc">Description:</label>
    <textarea id="eventDesc" name="eventDesc" required></textarea><br>

    <label for="eventLocation">Location:</label>
    <input type="text" id="eventLocation" name="eventLocation" required><br>

    <label for="eventDate">Date:</label>
    <input type="date" id="eventDate" name="eventDate" required><br>

    <input type="submit" name="createEvent" value="Create Event">
</form>

<!-- Display Events -->
<div>
    <h2>Upcoming Events</h2>
    <?php
    $events = get_all_events(); // Function to get all events
    foreach ($events as $event) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($event['name']) . "</h3>";
        echo "<p>" . htmlspecialchars($event['description']) . "</p>";
        // ... Display other event details
        echo '<form action="engagement.php" method="post">';
        echo '<input type="hidden" name="eventId" value="' . $event['id'] . '">';
        echo '<input type="submit" name="joinEvent" value="Join Event">';
        echo '</form>';
        echo "</div>";
    }
    ?>
</div>

<?php require_once('footer.php'); ?>
