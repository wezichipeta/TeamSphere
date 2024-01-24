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

function create_new_user(array $user_data) {
// [
//     'fullname' => 'Patty',
//     'email' => 'pattyhsu.0815@gmail.com',
//     'location' => 'Los Angeles, CA',
//     'department' => 4,
//     'birthday' => '08/01/1991',
//     'password' => 'mysecretpassword',
// ]
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, `location`, department, birthday, `password`) VALUES (:fullname, :email, :location, :department, :birthday, :password)");
    $stmt->execute($user_data);
    $conn = null;
}
