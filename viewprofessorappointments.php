<?php
    session_start();
    $host = 'localhost';
    $dbname = 'office_hours_db';
    $user = 'root';
    $password = '';
    $db = @mysqli_connect($host, $user, $password);
    @mysqli_select_db($db, $dbname);
    if(isset($_SESSION['professorid'])){
        $id = $_SESSION['professorid'];
        $sqlnonpending = "SELECT * FROM appointments a join office_hours oh on a.office_hour_id = oh.office_hour_id join students s on a.student_id = s.student_id WHERE oh.professor_id = $id and (a.status = 'Declined' or a.status = 'Approved')";
        $sqlpending = "SELECT * FROM appointments a join office_hours oh on a.office_hour_id = oh.office_hour_id join students s on a.student_id = s.student_id WHERE oh.professor_id = $id and a.status = 'Pending'";
        $resultnonpending = mysqli_query($db, $sqlnonpending);
        $resultpending = mysqli_query($db, $sqlpending);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['accept'])) {
            $sql = "UPDATE appointments SET status = 'Approved' WHERE office_hour_id = $_POST[ohid] and student_id = $_POST[sid]";
            mysqli_query($db, $sql);
        } elseif (isset($_POST['reject'])) {
            $sql = "UPDATE appointments SET status = 'Declined' WHERE office_hour_id = $_POST[ohid] and student_id = $_POST[sid]";
            mysqli_query($db, $sql);
        }
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <style>
        button {
    padding: 12px 24px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background-color: #45a049;
}
a{
    text-decoration: none;
    color: black;
}
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #68a992;
            color: #fff;
        }

        .button {
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            background-color: #68a992;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        .button.reject {
            background-color: #e74d4d;
        }
    </style>
</head>
<body>
    <input type="hidden" name="sid">
    <h1></h1>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resultpending)) {
                echo "<tr>";
                echo "<td>{$row['student_name']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='sid' value = '{$row['student_id']}'>";
                echo "<input type = 'hidden' name='ohid' value='$row[office_hour_id]'>";
                echo "<button class='button' type='submit' name='accept'>Accept</button>";
                echo "<button class='button reject' type='submit' name='reject'>Reject</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <h1 style="text-align : center">Answered Appointments</h1>
            <?php
            while ($row = mysqli_fetch_assoc($resultnonpending)) {
                echo "<tr>";
                echo "<td>{$row['student_name']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            <br>
    </table>
    <a href="professor_dashboard.php"><button style = 'background-color: #68a992'>Go Back To Dashboard</button></a>
</body>
</html>