<?php
session_start();
require_once __DIR__ . '/../model/loginModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sign Up
    if (isset($_POST['firstName']) && isset($_POST['lastName'])) {
        $_SESSION['firstName'] = htmlspecialchars($_POST['firstName']);
        $_SESSION['lastName'] = htmlspecialchars($_POST['lastName']);
        header("Location: ../public/signup.php");
        exit();
    }

    // Login
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        $loginEmail = htmlspecialchars($_POST['loginEmail']);
        $loginPassword = $_POST['loginPassword'];

        // Use loginModel to validate user
        $user = getUserByEmail($loginEmail);

        if ($user) {
            // Verify password
            if (password_verify($loginPassword, $user['password'])) {
                // Set session variables
                $_SESSION['userId'] = $user['Id']; 
                $_SESSION['firstName'] = $user['firstName']; 
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['role'] = $user['role']; 
                $_SESSION['email'] = $user['email'];
                $_SESSION['language'] = $user['language'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['profileImage'] = $user['profileImage'];
                $_SESSION['confirmPassword'] = $user['confirmPassword'];
                $_SESSION['score'] = $user['score'];  
                $_SESSION['difficulty_level'] = $user['difficulty_level'];

                // Redirect based on role
                switch ($user['role']) {
                    case 'student':
                        header("Location: ../public/home.php");
                        exit();
                    case 'tutor':
                        header("Location: ../public/forum.php");
                        exit();
                    case 'admin':
                        header("Location: ../public/admindashboard.php");
                        exit();
                    default:
                        echo "Unexpected role.";
                        break;
                }
            } else {
                $loginError = "Incorrect password. Please try again.";
            }
        } else {
            $loginError = "It looks like you don't have an account. Please sign up.";
        }
    }
}
