<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../Language-Learning-Chatbot/controllers/restrict.php';
restrictPageAccess('admin', '../public/home.php'); // Ensures only admins can access


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students and their languages along with common queries
$userQuery = "
    SELECT u.username, u.language, c.title AS common_query
    FROM users u
    LEFT JOIN Chats c ON u.Id = c.user_id
    WHERE u.role = 'student'  -- Assuming there's a 'role' column and 'student' is a valid role
    GROUP BY u.username, u.language
";
$userResult = $conn->query($userQuery);

// Prepare data for the table
$userData = [];
while ($row = $userResult->fetch_assoc()) {
    $username = $row['username'];
    $language = $row['language'];
    $commonQuery = $row['common_query'] ?? 'No queries found'; // Handle cases with no queries

    $userData[] = [
        'username' => htmlspecialchars($username),
        'language' => htmlspecialchars($language),
        'common_query' => htmlspecialchars($commonQuery)
    ];
}

// Function to generate random progress data for a user
function generateRandomProgressData() {
    return [
        "conversations" => [
            ["date" => "2024-12-01", "score" => rand(1, 10)],
            ["date" => "2024-12-05", "score" => rand(1, 10)],
            ["date" => "2024-12-10", "score" => rand(1, 10)],
            ["date" => "2024-12-15", "score" => rand(1, 10)],
        ],
        "vocabularyFocus" => [
            "grammar" => rand(1, 50),
            "pronunciation" => rand(1, 50),
        ],
        "correctionsReceived" => [
            "Grammar" => rand(1, 10),
            "Pronunciation" => rand(1, 10),
            "Vocabulary" => rand(1, 10),
        ]
    ];
}

// Prepare user progress data with unique random values
$userProgressData = [];
foreach ($userData as $user) {
    $username = $user['username'];
    
    // Generate random progress data for each user
    $userProgressData[$username] = generateRandomProgressData();

    // Calculate the remaining percentage for "vocabulary"
    $userProgressData[$username]["vocabularyFocus"]["vocabulary"] = 100 - (
        $userProgressData[$username]["vocabularyFocus"]["grammar"] + 
        $userProgressData[$username]["vocabularyFocus"]["pronunciation"]
    );

    // Ensure the sum of the percentages is exactly 100
    if ($userProgressData[$username]["vocabularyFocus"]["grammar"] + 
        $userProgressData[$username]["vocabularyFocus"]["pronunciation"] + 
        $userProgressData[$username]["vocabularyFocus"]["vocabulary"] != 100) {
        $diff = 100 - (
            $userProgressData[$username]["vocabularyFocus"]["grammar"] + 
            $userProgressData[$username]["vocabularyFocus"]["pronunciation"] + 
            $userProgressData[$username]["vocabularyFocus"]["vocabulary"]
        );
        $userProgressData[$username]["vocabularyFocus"]["vocabulary"] += $diff; // Adjust the vocabulary to make the sum exactly 100
    }
}

$conn->close();
?>