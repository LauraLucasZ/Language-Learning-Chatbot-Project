<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../Language-Learning-Chatbot/controllers/UserController.php';
require_once '../Language-Learning-Chatbot/model/UserModel.php';
require_once '../Language-Learning-Chatbot/db/dbh.inc.php';
$userModel = new UserModel($conn);
$userController = new UserController($userModel);
$userController->edit();

$errors = $_SESSION['errors'] ?? [];
$updateMessage = $_SESSION['update_message'] ?? '';



if (!isset($_SESSION['userId'])) {
    header("Location: ../public/error.php");
    exit();
}

$difficulty = $focusArea = $personalInterests = $language = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $difficulty = $_POST['difficulty'] ?? '';
    $focusArea = $_POST['focusArea'] ?? '';
    $personalInterests = $_POST['personalInterests'] ?? '';
    $language = $_POST['languages'] ?? '';

    $userId = $_SESSION['userId'];

    $stmt = $conn->prepare("UPDATE users SET difficulty_level = ?, focus_area = ?, personal_interests = ?, language = ? WHERE Id = ?");
    $stmt->bind_param("ssssi", $difficulty, $focusArea, $personalInterests, $language, $userId);

    if ($stmt->execute()) {
        $_SESSION['update_message'] = "Your learning path has been updated successfully.";
    } else {
        $_SESSION['errors'][] = "Error updating your learning path.";
    }

    $stmt->close();

    header("Location: ../public/learningpath.php");
    exit();
}
