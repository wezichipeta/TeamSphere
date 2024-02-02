<?php
require_once('config.php');

function get_db_connection() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";port=" . DB_PORT, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage());
        throw $e;
    }
}

function get_all_departments() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM departments ORDER BY departmentname");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function get_all_messages() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT messages.id, messages.body, messages.sent_ts, users.fullname FROM messages left join users on messages.sent_by=users.id ORDER BY sent_ts DESC;");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function post_messsge(string $userEmail, string $userMessage): string {
    if (strlen($userEmail) < 1) {
        return 'User email required';
    }
    if (strlen($userMessage) < 1) {
        return 'Message cannot be empty';
    }

    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT users.id FROM users where email = :userEmail");
    $stmt->bindParam('userEmail', $userEmail);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /**
    * @var int
    */
    if (!$result) {
        $conn = null;
        return 'Unknown user email';
    }

    $userId = current($result)['id'];
    $timestamp = time();
    $stmt = $conn->prepare("INSERT INTO messages (body, sent_ts, sent_by) VALUES (:userMessage, :sentTimestamp, :userId)");
    $stmt->bindParam('userMessage', $userMessage);
    $stmt->bindParam('sentTimestamp', $timestamp);
    $stmt->bindParam('userId', $userId);
    $stmt->execute();
    $conn = null;
    return 'Message posted!';
}

// This portion contacins functions specifically for handling event-related operations. 
//These functions will interact with your database to create, retrieve, and manage eventss
//create_event: This function will handle the creation of a new event.
function create_event($eventName, $eventDesc, $eventLocation, $eventDate, $createdBy) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO events (name, description, location, event_date, created_by) VALUES (:eventName, :eventDesc, :eventLocation, :eventDate, :createdBy)");
    $stmt->bindParam(':eventName', $eventName);
    $stmt->bindParam(':eventDesc', $eventDesc);
    $stmt->bindParam(':eventLocation', $eventLocation);
    $stmt->bindParam(':eventDate', $eventDate);
    $stmt->bindParam(':createdBy', $createdBy);
    $stmt->execute();
    $conn = null;
}
//get_all_events: Retrieves a list of all upcoming events.
function get_all_events() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

// join_event: Allows a user to join an event.
function join_event($userId, $eventId) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO event_participants (user_id, event_id) VALUES (:userId, :eventId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':eventId', $eventId);
    $stmt->execute();
    $conn = null;
}

//get_event_details: Retrieves details for a specific event.
function get_event_details($eventId) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = :eventId");
    $stmt->bindParam(':eventId', $eventId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function create_new_user(array $user_data) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, `location`, department, birthday, `password`) VALUES (:fullname, :email, :location, :department, :birthday, :password)");
    $stmt->execute($user_data);
    $conn = null;
}

function authenticate_user($email, $password) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email AND `password`=:password LIMIT 1");
    $user_data = [
        'email' => $email,
        'password' => $password
    ];
    $stmt->execute($user_data);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

