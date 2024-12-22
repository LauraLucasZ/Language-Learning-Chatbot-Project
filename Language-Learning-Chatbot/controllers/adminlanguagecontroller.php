<?php

class LanguageAnalysisDashboard {
    private $conn;
    private $totalUsers;
    private $languageData = [];
    private $chartData = [];

    public function __construct($servername, $username, $password, $dbname) {
        $this->connect($servername, $username, $password, $dbname);
        $this->fetchTotalUsers();
        $this->fetchLanguageUsage();
    }

    private function connect($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function fetchTotalUsers() {
        $totalUsersQuery = "SELECT COUNT(*) as total FROM users";
        $totalUsersResult = $this->conn->query($totalUsersQuery);
        $this->totalUsers = $totalUsersResult->fetch_assoc()['total'];
    }

    private function fetchLanguageUsage() {
        $languageUsageQuery = "
            SELECT language, COUNT(*) as count, 
                   SUM(CASE WHEN focus_area = 'grammar' THEN 1 ELSE 0 END) as grammar_count,
                   SUM(CASE WHEN focus_area = 'vocabulary' THEN 1 ELSE 0 END) as vocabulary_count,
                   SUM(CASE WHEN focus_area = 'writing' THEN 1 ELSE 0 END) as writing_count
            FROM users 
            GROUP BY language
        ";
        $languageUsageResult = $this->conn->query($languageUsageQuery);

        while ($row = $languageUsageResult->fetch_assoc()) {
            $language = $row['language'];
            $count = $row['count'];
            $usagePercentage = $this->totalUsers > 0 ? ($count / $this->totalUsers) * 100 : 0;

            // Prepare chart data
            $this->chartData[$language] = [
                $row['grammar_count'],
                $row['vocabulary_count'],
                $row['writing_count']
            ];

            // Fetch common chat titles for this language
            $commonTitlesQuery = "
                SELECT title 
                FROM Chats 
                WHERE user_id IN (SELECT Id FROM users WHERE language = '$language')
                GROUP BY title
                LIMIT 3
            ";
            $commonTitlesResult = $this->conn->query($commonTitlesQuery);
            $titles = [];
            while ($titleRow = $commonTitlesResult->fetch_assoc()) {
                $titles[] = $titleRow['title'];
            }
            $commonTitles = implode(", ", $titles);

            $this->languageData[] = [
                'language' => $language,
                'usagePercentage' => number_format($usagePercentage, 2) . '%',
                'commonTitles' => $commonTitles
            ];
        }
    }

    public function getLanguageData() {
        return $this->languageData;
    }

    public function getChartData() {
        return $this->chartData;
    }

    public function __destruct() {
        $this->conn->close();
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../Language-Learning-Chatbot/controllers/restrict.php';
restrictPageAccess('admin', '../public/home.php');

$dashboard = new LanguageAnalysisDashboard($servername, $username, $password, $dbname);
$languageData = $dashboard->getLanguageData();
$chartData = $dashboard->getChartData();

?>