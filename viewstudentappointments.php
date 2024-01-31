<?php
    session_start();
    $host = 'localhost';
    $dbname = 'office_hours_db';
    $user = 'root';
    $password = '';
    $db = @mysqli_connect($host, $user, $password);
    @mysqli_select_db($db, $dbname);
    if(isset($_SESSION['studentid'])){
        $id = $_SESSION['studentid'];
        $sqlnonpending = "SELECT * FROM appointments a join office_hours oh on a.office_hour_id = oh.office_hour_id join students s on a.student_id = s.student_id join professors p on p.professor_id = oh.professor_id where s.student_id = $id and (a.status = 'Declined' or a.status = 'Approved')";
        $sqlpending = "SELECT * FROM appointments a join office_hours oh on a.office_hour_id = oh.office_hour_id join students s on a.student_id = s.student_id join professors p on p.professor_id = oh.professor_id where s.student_id = $id and a.status = 'Pending'";
        $resultnonpending = mysqli_query($db, $sqlnonpending);
        $resultpending = mysqli_query($db, $sqlpending);
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
    background-color: #536dfe;
            color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
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
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        .button.reject {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Professor Name</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <h1 style="text-align : center">Appointments Awaiting Action</h1>
            <?php
            while ($row = mysqli_fetch_assoc($resultpending)) {
                echo "<tr>";
                echo "<td>{$row['professor_name']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            <br>
    </table>
    
    <table>
        <thead>
            <tr>
                <th>Professor Name</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <h1 style="text-align : center">Answered Appointments</h1>
            <?php
            while ($row = mysqli_fetch_assoc($resultnonpending)) {
                echo "<tr>";
                echo "<td>{$row['professor_name']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            <br>
    </table>
    <a href="student_dashboard.php"><button style = 'background-color: #68a992'>Go Back To Dashboard</button></a>
</body>
</html>
