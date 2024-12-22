<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "llchatbot_db";

if (!defined('TEST_ENVIRONMENT') || !TEST_ENVIRONMENT) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function checkUserRole($userId, $role, $conn) {
    $stmt = $conn->prepare("SELECT role FROM users WHERE Id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['role'] === $role;
    }
    return false;
}

return isset($conn) ? $conn : null;
?>
