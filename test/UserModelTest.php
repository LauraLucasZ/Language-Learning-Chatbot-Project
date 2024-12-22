<?php

define('TEST_ENVIRONMENT', true);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Language-Learning-Chatbot/db/dbh.inc.php';
require_once __DIR__ . '/../Language-Learning-Chatbot/model/UserModel.php';

use LanguageLearningChatbot\UserModel;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase {

    private $mockConn;
    private $userModel;

    protected function setUp(): void {
        $this->mockConn = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->userModel = new UserModel($this->mockConn);

        $_SESSION = [];
    }

    public function testGetUserById() {
        $userId = 1;
        $userData = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com'
        ];

        // Mock the prepare and execute methods
        $stmtMock = $this->getMockBuilder(mysqli_stmt::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockConn->method('prepare')->willReturn($stmtMock);

        // Mock result fetching
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);
        
        // Corrected mock for get_result
        $mysqliResultMock = $this->getMockBuilder(mysqli_result::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mysqliResultMock->method('fetch_assoc')->willReturn($userData);

        $stmtMock->method('get_result')->willReturn($mysqliResultMock);

        $result = $this->userModel->getUserById($userId);

        // Assertions
        $this->assertEquals($userData, $result);
    }
}

