<?php
include '../Language-Learning-Chatbot/controllers/AdminChatInteractionController.php';
$adminChat = new AdminChatInteractionController();
$result = $adminChat->getChatMessages();
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
.modal {
    display: none; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.75); 
    padding-top: 60px;
    backdrop-filter: blur(5px); /* Subtle blur effect */
}

.modal-content {
    background-color: #f9f9f9;
    margin: auto; 
    padding: 30px;
    border-radius: 12px; /* Smooth rounded corners */
    width: 90%; 
    max-width: 500px; 
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Modern shadow */
    animation: slideIn 0.3s ease-out; /* Slide-in animation */
    position: relative;
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.close {
    color: #555;
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s;
}

.close:hover {
    color: #e74c3c; /* Highlight on hover */
}

.modal-content h2 {
    margin-bottom: 15px;
    font-size: 22px;
    color: #2c3e50;
}

.modal-content p {
    color: #34495e;
    line-height: 1.8;
    font-size: 16px;
    margin: 10px 0;
}

.modal-content strong {
    color: #2c3e50;
    font-weight: bold;
}

    </style>
    <script>
        function showHistory(message, response) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('modalResponse').innerText = response;
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('myModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</head>
<body>
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>
    <section>
        <div class="user-management">
            <h2>Chatbot Interactions</h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Language</th>
                        <th>Email</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['username']}</td>
                                    <td>{$row['role']}</td>
                                    <td>{$row['language']}</td>
                                    <td>{$row['email']}</td>
                                    <td>
                                        <button onclick=\"showHistory('".addslashes($row['message'])."', '".addslashes($row['response'])."')\">View History</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No chat messages found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Chat History</h2>
            <p><strong>Message:</strong> <span id="modalMessage"></span></p>
            <p><strong>Response:</strong> <span id="modalResponse"></span></p>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
</body>
</html>

<?php
$adminChat->closeConnection();
?>