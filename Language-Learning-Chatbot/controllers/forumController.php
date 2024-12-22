<?php
session_start();
require_once __DIR__ . '/../model/forumModel.php';

class forumController {
    private $forumModel;

    public function __construct() {
        $this->forumModel = new forumModel();
    }

    public function loadQuestions() {
        return $this->forumModel->getQuestions();
    }

    public function getTopUsers() {
        // Delegate to forumModel to handle the database query
        return $this->forumModel->getTopUsers();
    }

    public function loadUserQuestions($userId) {
        return $this->forumModel->getUserQuestions($userId);
    }
    
    public function likePost($postId) {
        // Increment the likes count in the database for the specific post
        $this->forumModel->increaseLikes($postId);

        header("Location: ../public/forum.php#$postId");
        exit();
    }
    
    public function getQuestionsByCategory($category) {
        return $this->forumModel->getQuestionsByCategory($category);
        
    }
    
    
}
?>
