<?php
class AdminChatInteractionController {
    private $conn;

    public function __construct() {
        // Database connection setup
        include_once '../Language-Learning-Chatbot/model/ChatbotModel.php';
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getChatMessages() {
        $sql = "SELECT u.username, u.email, u.role, u.language, cm.message, cm.response 
                FROM ChatMessages cm 
                JOIN users u ON cm.user_id = u.Id
                WHERE u.role = 'student'";
        return $this->conn->query($sql);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
