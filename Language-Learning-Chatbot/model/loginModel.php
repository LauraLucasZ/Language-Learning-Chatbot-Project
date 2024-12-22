<?php
require_once __DIR__ . '/../db/dbh.inc.php';

/**
 * Get user details by email.
 *
 * @param string $email
 * @return array|null
 */
function getUserByEmail($email) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
?>
