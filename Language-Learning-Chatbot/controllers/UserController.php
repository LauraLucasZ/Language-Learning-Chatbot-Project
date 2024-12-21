<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/UserModel.php';

class UserController extends Controller {
    
    private $userModel;

    // Constructor now accepts the UserModel instance (Singleton)
    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function edit() {
        // Now you call the handleProfileUpdate method from the Singleton instance of UserModel
        $this->userModel->handleProfileUpdate();
    }
}
?>
