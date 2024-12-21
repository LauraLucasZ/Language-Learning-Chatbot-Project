<?php
// signupModel.php

include_once(__DIR__ . '/../db/dbh.inc.php');

function signup($email, $username, $password, $confirmPassword, $gender, $role, $language, $firstName, $lastName, $conn) {
    $error = '';
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 0) {
        if ($password === $confirmPassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $confirmhash = password_hash($confirmPassword, PASSWORD_DEFAULT);
            $defaultProfileImage = '../public/images/user.png';
            $defaultScore = 0;
            $defaultDifficultyLevel = 'Beginner';

            $sql = "INSERT INTO users (firstName, lastName, username, password, confirmPassword, email, gender, role, language, profileImage, score, difficulty_level) 
                    VALUES ('$firstName', '$lastName', '$username', '$hash', '$confirmhash', '$email', '$gender', '$role', '$language', '$defaultProfileImage', '$defaultScore', '$defaultDifficultyLevel')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                return '';
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Username or email not available.";
    }

    return $error;
}
?>
