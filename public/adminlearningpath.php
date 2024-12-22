<?php

include '../Language-Learning-Chatbot/controllers/adminlearningpathcontroller.php';
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
       /* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

/* Form Styles */
#user-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#user-form input,
#user-form select,
#user-form button {
    padding: 12px;
    font-size: 16px;
    border-radius: 6px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
}

#user-form input:focus,
#user-form select:focus {
    border-color: #6a1b9a;
    outline: none;
}

#user-form input[type="password"] {
    font-family: Arial, sans-serif;
}

#user-form button {
    background-color: #6a1b9a;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

#user-form button:hover {
    background-color: #4a0072;
}

/* Style for placeholders */
#user-form input::placeholder,
#user-form select::placeholder {
    color: #bbb;
    font-style: italic;
}

/* Optional: Add a background color for the inputs */
#user-form input,
#user-form select {
    background-color: #fafafa;
}

#user-form input[type="password"] {
    font-family: "Courier New", monospace;
}

h2 {
    color: #6a1b9a;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Button for opening the modal */
#add-user-btn {
    padding: 10px 20px;
    background-color: #6a1b9a;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#add-user-btn:hover {
    background-color: #4a0072;
}





        
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>

   
    <section>
        <div class="user-management">
            <h2>customizable learning path </h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Language</th>
                        <th>Difficulty Level</th>
                        <th>Focus Area</th>
                        <th>Personal Interest</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['language']) . "</td>";
                            echo "<td>" . (!empty($row['difficulty_level']) ? htmlspecialchars($row['difficulty_level']) : "Not Found") . "</td>";
                            echo "<td>" . (!empty($row['focus_area']) ? htmlspecialchars($row['focus_area']) : "Not Found") . "</td>";
                            echo "<td>" . (!empty($row['personal_interests']) ? htmlspecialchars($row['personal_interests']) : "Not Found") . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
   
</body>
</html>