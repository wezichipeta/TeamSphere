<?php
require_once('header.php');

 $userId = $_SESSION['user'];
// User authentication check
if (!isset($_SESSION['user'])) {
header('Location: signin.php'); // Redirect to login page if not authenticated
 exit();
 }

// Handle event creation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createEvent'])) {
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventLocation = $_POST['eventLocation'];
    $eventDate = $_POST['eventDate'];
    $createdBy = $_SESSION['user']; // Assuming user ID is stored in the session

    create_event($eventName, $eventDesc, $eventLocation, $eventDate, $createdBy); // Function to create an event
}

// Handle joining an event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['joinEvent'])) {
    $eventId = $_POST['eventId'];
    $userId = $_SESSION['user'];

    $userId = $_SESSION['user']['user_id']; // Assuming 'user_id' is the key for the user ID in the session array

    join_event($userId, $eventId); // Function to join an event
}

?>

<h3>Engagement</h3>

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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <table>
        <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Date</th>
            <th>Created By</th>
            <th>Action</th>
        </tr>
        <?php
        $events = get_all_events(); // Function to get all events
        foreach ($events as $event) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($event['name']) . "</td>";
            echo "<td>" . htmlspecialchars($event['description']) . "</td>";
            echo "<td>" . htmlspecialchars($event['location']) . "</td>";
            echo "<td>" . htmlspecialchars($event['event_date']) . "</td>";
            echo "<td>" . htmlspecialchars($event['created_by']) . "</td>";
            // ... Display other event details
            echo '<td>';
            echo '<form action="engagement.php" method="post">';
            echo '<input type="hidden" name="eventId" value="' . $event['id'] . '">';
            echo '<input type="submit" name="joinEvent" value="Join Event">';
            echo '</form>';
            echo '</td>';
            echo "</tr>";
        }
        ?>
    </table>
</div>


<?php require_once('footer.php'); ?>
