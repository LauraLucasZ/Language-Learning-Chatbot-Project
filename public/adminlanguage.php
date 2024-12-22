<?php
include '../Language-Learning-Chatbot/controllers/adminlanguagecontroller.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Analysis Dashboard</title>
    <link rel=" stylesheet" href="../public/css/styleadmin.css">
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

        th,
        td {
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
            background-color: rgba(0, 0, 0, 0.4);
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

        .chart-container {
            width: 100%;
            height: 300px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>
    <section>
        <div class="dashboard">
            <h2>Language Analysis</h2>
            <table>
                <thead>
                    <tr>
                        <th>Language Name</th>
                        <th>Usage Percentage</th>
                        <th>Common Topics</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="languageTable">
                    <?php foreach ($languageData as $data): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['language']); ?></td>
                            <td><?php echo htmlspecialchars($data['usagePercentage']); ?></td>
                            <td><?php echo htmlspecialchars($data['commonTitles']); ?></td>
                            <td><button onclick="showAnalysis('<?php echo htmlspecialchars($data['language']); ?>')">View Analysis</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal for Language Analysis -->
    <div id="analysisModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="analysisTitle">Analysis for</h2>
            <div id="chartContainer">
                <canvas id="analysisChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/adminmainjs.js"></script>

    <script>
        const chartData = <?php echo json_encode($chartData); ?>;

        let analysisChart;

        function showAnalysis(language) {
            const data = chartData[language];
            const ctx = document.getElementById('analysisChart').getContext('2d');

            if (analysisChart) {
                analysisChart .destroy();
            }

            analysisChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Grammar', 'Vocabulary', 'Writing'], 
                    datasets: [{
                        label: 'Focus Area Distribution',
                        data: data, 
                        backgroundColor: [
                            'rgba(105, 240, 174, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)'
                        ],
                        borderColor: [
                            'rgba(105, 240, 174, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'User  Count'
                            }
                        }
                    }
                }
            });

            document.getElementById('analysisTitle').innerText = `Analysis for ${language}`;
            document.getElementById('analysisModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('analysisModal').style.display = 'none';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons.js"></script>
</body>
</html>