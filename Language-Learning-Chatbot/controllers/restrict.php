<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . '/../db/dbh.inc.php');

function restrictPageAccess($requiredRole, $redirectUrl) {
    if (!isset($_SESSION['userId'])) {
        header("Location: ../public/login.php");
        exit();
    }

    $userId = $_SESSION['userId'];
    global $conn;
    if (!checkUserRole($userId, $requiredRole, $conn)) {
        header("Location: restricted.php?role=" . $requiredRole);
        exit();
    }
}
?>
