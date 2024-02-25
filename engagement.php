<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start of your PHP script
$message = ""; // Initialize message variable

require_once('header.php');

$userId = $_SESSION['user'];
// User authentication check
if (!isset($_SESSION['user'])) {
    header('Location: signin.php'); // Redirect to login page if not authenticated
    exit();
}

$userId = $_SESSION['user']['user_id']; // Make sure 'user_id' exists in the session array.

// Initialize $joinedEvents to ensure it is always set.
$joinedEvents = [];

// If the session user is set, fetch the events they've joined.
if (isset($userId)) {
    $joinedEvents = get_user_joined_events($userId); // Fetch joined events for the user
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

// Handle leaving an event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['leaveEvent'])) {
    $eventId = $_POST['eventId'];
    $userId = $_SESSION['user']['user_id']; // Correctly retrieve the user ID

    leave_event($userId, $eventId);
    $joinedEvents = get_user_joined_events($userId); // Refresh the joined events list.

    $message = "Event left successfully."; // Set the success message.
}

?>

<style>
    .form-container {
        max-width: 500px; /* Adjust as necessary */
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9; /* Light gray background */
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* subtle shadow */
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Darken on hover */
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 0.9rem; /* Adjust the font size to make text smaller */
    }

    th, td {
        border: 1px solid black;
        padding: 6px 10px; /* Reduce padding to decrease row height */
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<div class="form-container">
    <h3>Engagement</h3>
    <p>To Engage with Team Members, Please, Create or Join an Event</p>

    <form action="engagement.php" method="post">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" required placeholder="Enter event name">

        <label for="eventDesc">Description:</label>
        <textarea id="eventDesc" name="eventDesc" required placeholder="Describe the event"></textarea>

        <label for="eventLocation">Location:</label>
        <input type="text" id="eventLocation" name="eventLocation" required placeholder="Event location">

        <label for="eventDate">Date:</label>
        <input type="date" id="eventDate" name="eventDate" required>

        <input type="submit" name="createEvent" value="Create Event">
    </form>
</div>

<h5>Upcoming Events</h5>
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
    if (empty($events)) {
        echo "<tr><td colspan='5'>No upcoming events yet.</td></tr>";
    }
    ?>
</table>

<!-- Display the Events in a Table -->
<div>
    <h5>Events You Have Joined</h5>
    <table>
        <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($joinedEvents as $event): ?>
            <tr>
                <td><?= htmlspecialchars($event['name']) ?></td>
                <td><?= htmlspecialchars($event['description']) ?></td>
                <td><?= htmlspecialchars($event['location']) ?></td>
                <td><?= htmlspecialchars($event['event_date']) ?></td>
                <td>
                    <form action="engagement.php" method="post">
                        <input type="hidden" name="eventId" value="<?= $event['id'] ?>">
                        <input type="submit" name="leaveEvent" value="Leave Event">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($joinedEvents)): ?>
            <tr><td colspan="5">You have not joined any events yet.</td></tr>
        <?php endif; ?>
    </table>
    <!-- Display the success message here -->
    <?php if (!empty($message)): ?>
        <div class="alert alert-success" role="alert" style="margin-top: 20px;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once('footer.php'); ?>
