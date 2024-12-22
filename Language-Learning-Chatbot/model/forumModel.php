<?php
require_once __DIR__ . '/../model/Model2.php';

class forumModel extends Model2 {

    public function getQuestions() {
        $sql = "SELECT forum_posts.post_id, forum_posts.title, forum_posts.content, forum_posts.category, forum_posts.created_at, forum_posts.likes, users.username,users.role, users.profileImage
                FROM forum_posts
                INNER JOIN users ON forum_posts.user_id = users.Id
                ORDER BY forum_posts.created_at DESC";
        
        $result = $this->conn->query($sql);
        $questions = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Decode both title and content before returning
                $row['title'] = html_entity_decode($row['title'], ENT_QUOTES, 'UTF-8');
                $row['content'] = html_entity_decode($row['content'], ENT_QUOTES, 'UTF-8');
                $questions[] = $row;
            }
        }
    
        return $questions;
    }    

    public function getTopUsers() {
        $sql = "SELECT username, profileImage, postsCount FROM users ORDER BY postsCount DESC LIMIT 5";
        $result = $this->conn->query($sql);

        $topUsers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topUsers[] = $row;
            }
        }
        return $topUsers;
    }

    public function getUserQuestions() {
        // Get the user ID from the session
        $userId = $_SESSION['userId']; // Assuming user ID is stored in the session after login
    
        // Update SQL query to fetch only questions from the logged-in user
        $sql = "SELECT forum_posts.post_id, forum_posts.title, forum_posts.content, forum_posts.category, forum_posts.created_at, forum_posts.likes, users.username,users.role, users.profileImage
                FROM forum_posts
                INNER JOIN users ON forum_posts.user_id = users.Id
                WHERE forum_posts.user_id = $userId
                ORDER BY forum_posts.created_at DESC";
        
        // Execute the query
        $result = $this->conn->query($sql);
        
        // Fetch the results
        $questions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Decode both title and content before returning
                $row['title'] = html_entity_decode($row['title'], ENT_QUOTES, 'UTF-8');
                $row['content'] = html_entity_decode($row['content'], ENT_QUOTES, 'UTF-8');
                $questions[] = $row;
            }
        }
        
        return $questions;
    }

    public function increaseLikes($postId) {
        $sql = "UPDATE forum_posts SET likes = likes + 1 WHERE post_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $stmt->close();
    }

    public function getQuestionsByCategory($category) {
        // Start the base SQL query
        $sql = "SELECT forum_posts.post_id, forum_posts.title, forum_posts.content, forum_posts.category, forum_posts.created_at, forum_posts.likes, users.username,users.role, users.profileImage
                FROM forum_posts
                INNER JOIN users ON forum_posts.user_id = users.Id";
        
        // Modify the query if the category is not 'all'
        if ($category != 'all') {
            $sql .= " WHERE forum_posts.category = ?";
        }
        
        // Always order by the latest created_at
        $sql .= " ORDER BY forum_posts.created_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        
        // If category is provided, bind it to the query
        if ($category != 'all') {
            $stmt->bind_param("s", $category);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $questions = [];
        
        // Fetch the questions and decode title and content
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['title'] = html_entity_decode($row['title'], ENT_QUOTES, 'UTF-8');
                $row['content'] = html_entity_decode($row['content'], ENT_QUOTES, 'UTF-8');
                $questions[] = $row;
            }
        }
        
        return $questions;
    }
    
    }
    

?>
