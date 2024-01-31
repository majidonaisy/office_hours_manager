<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            
    background: linear-gradient(to bottom right, #aeefff, #b7f1c9);

            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-container {
            width: 800px;
            background-color:#fff ;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            height: 200px;
            border-radius: 20px;
        }

        h1 {
            
            color: #333;
        }

        .dashboard-buttons {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .dashboard-button {
            background-color: #68a992;/* A slightly darker shade of blue */
    color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .dashboard-button:hover {
            background-color: #527d73;
        }
        
    </style>
</head>
<body>
    
    <div class="dashboard-container">
        <h1>Welcome, <?php 
        echo"$_SESSION[name]"?></h1>
        <div class="dashboard-buttons">
        <a href="calendar.php" class="dashboard-button">View Calendar</a>
            
            <a href="viewstudentappointments.php" class="dashboard-button">View Appointments</a>
            <a href="logout.php" class="dashboard-button">Log Out</a>
        </div>
    </div>
</body>
</html>
