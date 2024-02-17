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

function get_all_public_messages() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT messages.id, messages.body, messages.sent_ts, users.fullname FROM messages left join users on messages.sent_by=users.id WHERE is_public = 1 ORDER BY sent_ts DESC;");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function post_messsge(string $userEmail, string $userMessage, bool $isPublic): string {
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
    $chatId = null;
    $isPublic = true;
    $stmt = $conn->prepare("INSERT INTO messages (body, sent_ts, sent_by, chat_id, is_public) VALUES (:userMessage, :sentTimestamp, :userId, :chatId, :isPublic)");
    $stmt->bindParam('userMessage', $userMessage);
    $stmt->bindParam('sentTimestamp', $timestamp);
    $stmt->bindParam('userId', $userId);
    $stmt->bindParam('chatId', $chatId);
    $stmt->bindParam('isPublic', $isPublic);
    $stmt->execute();
    $conn = null;
    return 'Message posted!';
}

function get_all_chats() {
    $conn = get_db_connection();
    $currentUserId = $_SESSION['user']['user_id'];
    if (!$currentUserId) {
        return [];
    }
    $stmt = $conn->prepare("SELECT chats.id, chats.name FROM chats left join chat_users on chat_users.chat_id=chats.id left join users on users.id=chat_users.user_id where users.id=:userId;");
    $stmt->bindParam('userId', $currentUserId);
    $stmt->execute();
    $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $chatIds = [];
    foreach ($chats as $chat) {
        $chatIds[] = $chat['id'];
    }
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT DISTINCT chat_users.chat_id, users.fullname FROM users left join chat_users on chat_users.user_id = users.id where chat_users.chat_id in (" . implode(',', $chatIds) . ") and users.id != :currentUserId;");
    $stmt->bindParam('currentUserId', $currentUserId);
    $stmt->execute();
    $users = $stmt->fetchAll();
    $conn = null;
    $chatIdToUserName = array();
    foreach ($users as $user) {
        $chatIdToUserName[$user['chat_id']][] = $user['fullname'];
    }
    foreach ($chats as &$chat) {
        $chat['name'] = 'Chat with ' . $chatIdToUserName[$chat['id']][0];
    }
    return $chats;
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
    $stmt->bindParam(':createdBy', $createdBy['id']);
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
    
    // Check if the user is already participating in the event
    $stmt = $conn->prepare("SELECT * FROM event_participants WHERE user_id = :userId AND event_id = :eventId");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':eventId', $eventId);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // If the user is not already participating, insert a new record
        $stmt = $conn->prepare("INSERT INTO event_participants (user_id, event_id) VALUES (:userId, :eventId)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->execute();
    }
    
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
    $stmt = $conn->prepare("SELECT u.id as user_id, u.fullname, u.email, u.location, u.birthday, d.departmentname FROM users u LEFT JOIN departments d ON u.department=d.id WHERE email=:email AND `password`=:password LIMIT 1");
    $user_data = [
        'email' => $email,
        'password' => $password
    ];
    $stmt->execute($user_data);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function is_user_logged_in() {
    return $_SESSION && array_key_exists('user', $_SESSION) && $_SESSION['user'];
}
