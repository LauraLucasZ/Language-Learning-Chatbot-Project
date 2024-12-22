<?php
include '../Language-Learning-Chatbot/controllers/adminchartcontroller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Admin Dashboard</title>
    <link rel="stylesheet" href="../public/css/styleadmin.css">
    <link rel="stylesheet" href="../public/css/admintable.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .dashboard {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 95%;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6a1b9a;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #e1bee7;
        }
        button {
            padding: 8px 15px;
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #8c45a0;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0 , 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>
    <section>
        <div class="dashboard">
            <h2>User Progress Tracking</h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Language Learning</th>
                        <th>Common Queries</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php foreach ($userData as $user): ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['language']; ?></td>
                            <td><?php echo $user['common_query']; ?></td>
                            <td><button onclick="showProgress('<?php echo $user['username']; ?>')">View Progress</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Progress Modal -->
        <div id="progressModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 id="userName"></h2>
                <p id="progressDetails"></p>
                <canvas id="learningProgressChart"></canvas>
                <canvas id="vocabularyFocusChart"></canvas>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const userProgressData = <?php echo json_encode($userProgressData); ?>;

        function showProgress(userName) {
            const userProgress = userProgressData[userName];
            if (userProgress) {
                // Display user name
                document.getElementById('userName').innerText = userName;

                // Prepare data for charts
                const conversationScores = userProgress.conversations.map(conv => conv.score);
                const conversationDates = userProgress.conversations.map(conv => conv.date);
                const vocabularyFocus = userProgress.vocabularyFocus;
                const corrections = userProgress.correctionsReceived;

                // Update progress details
                document.getElementById('progressDetails').innerText = 
                    'Grammar Corrections: ' + corrections.Grammar + 
                    ' | Pronunciation Corrections: ' + corrections.Pronunciation + 
                    ' | Vocabulary Corrections: ' + corrections.Vocabulary;

                // Show modal
                document.getElementById('progressModal').style.display = 'block';

                // Create charts
                createCharts(conversationScores, conversationDates, vocabularyFocus);
            }
        }

        function createCharts(conversationScores, conversationDates, vocabularyFocus) {
    const ctxLine = document.getElementById('learningProgressChart').getContext('2d');
    if (window.learningChart) window.learningChart.destroy(); // Prevent overlapping charts
    window.learningChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: conversationDates,
            datasets: [{
                label: 'Conversation Scores',
                data: conversationScores,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxPie = document.getElementById('vocabularyFocusChart').getContext('2d');
    if (window.vocabularyChart) window.vocabularyChart.destroy(); // Prevent overlapping charts
    window.vocabularyChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: Object.keys(vocabularyFocus),
            datasets: [{
                data: Object.values(vocabularyFocus),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        },
        options: {
            responsive: true
        }
    });
}

            // Create pie chart for vocabulary focus
            const ctxPie = document.getElementById('vocabularyFocusChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: Object.keys(vocabularyFocus),
                    datasets: [{
                        data: Object.values(vocabularyFocus),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                },
                options: {
                    responsive: true
                }
            });
        

        function closeModal() {
            document.getElementById('progressModal').style.display = 'none';
        }

        // Close the modal when the user clicks anywhere outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('progressModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons.js"></script>
</body>
</html>