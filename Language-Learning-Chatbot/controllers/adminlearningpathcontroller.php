<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../Language-Learning-Chatbot/controllers/restrict.php';
restrictPageAccess('admin', '../public/home.php'); // Ensures only admins can access


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT username, role, language, difficulty_level, focus_area , personal_interests	FROM users WHERE role = 'student' ";
$result = $conn->query($sql);

?>