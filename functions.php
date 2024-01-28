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
