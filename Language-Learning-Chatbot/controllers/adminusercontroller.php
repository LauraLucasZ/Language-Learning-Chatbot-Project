<?php
// UserManager.php

class UserManager {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function addUser($data) {
        $error = '';
        $firstName = htmlspecialchars($data['first_name']);
        $lastName = htmlspecialchars($data['last_name']);
        $email = htmlspecialchars($data['email']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $confirmPassword = htmlspecialchars($data['confirm_password']);
        $role = htmlspecialchars($data['role']);
        $language = htmlspecialchars($data['language']);
        $gender = htmlspecialchars($data['gender']);
        $defaultProfileImage = '../public/images/user.png';
    
        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($this->conn, $sql);
    
        if (mysqli_num_rows($result) == 0) {
            if ($password === $confirmPassword) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users 
                        (username, email, password, firstName, lastName, role, language, gender, profileImage, score, difficulty_level) 
                        VALUES 
                        ('$username', '$email', '$passwordHash', '$firstName', '$lastName', '$role', '$language', '$gender', '$defaultProfileImage', 0, 'Beginner')";
                if (mysqli_query($this->conn, $sql)) {
                    $error = 'User added successfully!';
                } else {
                    $error = 'Error adding user: ' . mysqli_error($this->conn);
                }
            } else {
                $error = 'Passwords do not match.';
            }
        } else {
            $error = 'Username or email already exists.';
        }
    
        return $error;
    }
    

    public function editUser($data) {
        $error = '';
        $id = $data['id'];
        $firstName = htmlspecialchars($data['first_name']);
        $lastName = htmlspecialchars($data['last_name']);
        $username = htmlspecialchars($data['username']);
        $email = htmlspecialchars($data['email']);
        $role = htmlspecialchars($data['role']);
        $language = htmlspecialchars($data['language']);
        $password = htmlspecialchars($data['password']);
        $confirmPassword = htmlspecialchars($data['confirm_password']);

        $sql = "SELECT * FROM users WHERE (username='$username' OR email='$email') AND Id != '$id'";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            if (!empty($password) && !empty($confirmPassword)) {
                if ($password === $confirmPassword) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET username='$username', email='$email', password='$passwordHash', firstName='$firstName', lastName='$lastName', role='$role', language='$language' WHERE Id='$id'";
                } else {
                    $error = 'Passwords do not match.';
                }
            } else {
                $sql = "UPDATE users SET username='$username', email='$email', firstName='$firstName', lastName='$lastName', role='$role', language='$language' WHERE Id='$id'";
            }

            if (mysqli_query($this->conn, $sql)) {
                $error = 'User updated successfully!';
            } else {
                $error = 'Error updating user: ' . mysqli_error($this->conn);
            }
        } else {
            $error = 'Username or email already exists.';
        }

        return $error;
    }

    public function removeUser($id) {
        $sql = "DELETE FROM users WHERE Id='$id'";
        if (!mysqli_query($this->conn, $sql)) {
            die("Error removing user: " . mysqli_error($this->conn));
        }
        return true;
    }

    public function fetchUsers() {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("Error fetching users: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

abstract class UserManagerDecorator {
    protected $userManager;

    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    abstract public function addUser($data);
    abstract public function editUser($data);
    abstract public function removeUser($id);
    abstract public function fetchUsers();
}

// Concrete decorator for logging
class LoggingUserManagerDecorator extends UserManagerDecorator {
    public function addUser($data) {
        error_log("Adding user: " . $data['username']);
        return $this->userManager->addUser($data);
    }

    public function editUser($data) {    
        error_log("Editing user: " . $data['username']);
        return $this->userManager->editUser($data);
    }

    public function removeUser($id) {
        error_log("Removing user with ID: " . $id);
        return $this->userManager->removeUser($id);
    }

    public function fetchUsers() {
        return $this->userManager->fetchUsers();
    }
}
?>