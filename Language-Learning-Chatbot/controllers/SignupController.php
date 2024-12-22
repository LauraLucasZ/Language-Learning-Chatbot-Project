<?php
// signupController.php
session_start();

if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: ../public/login.php");
    exit();
}

// Retrieve names from session
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

// Include the model
include_once(__DIR__ . '/../model/signupModel.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $role = htmlspecialchars($_POST["role"]);
    $language = htmlspecialchars($_POST["language"]);

    // Call the model function to handle signup
    $error = signup($email, $username, $password, $confirmPassword, $gender, $role, $language, $firstName, $lastName, $conn);

    if (empty($error)) {
        // Unset the session variables after successful signup
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        header("Location: ../public/login.php");
        exit();
    }
}
?>
