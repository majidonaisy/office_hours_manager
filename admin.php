<?php
$host = 'localhost';
$dbname = 'office_hours_db';
$user = 'root';
$password = '';
$db = @mysqli_connect($host, $user, $password);
@mysqli_select_db($db, $dbname);

$sqlapproved = "SELECT p.professor_name, COUNT(*) AS approved_count FROM office_hours oh JOIN appointments app ON oh.office_hour_id = app.office_hour_id join professors p on oh.professor_id = p.professor_id WHERE app.status = 'Approved' GROUP BY oh.professor_id ORDER BY approved_count DESC;";
$sqldeclined = "SELECT p.professor_name, COUNT(*) AS declined_count FROM office_hours oh JOIN appointments app ON oh.office_hour_id = app.office_hour_id join professors p on oh.professor_id = p.professor_id WHERE app.status = 'Declined' GROUP BY oh.professor_id ORDER BY declined_count DESC;";

$resultapproved =  mysqli_query($db, $sqlapproved);
$resultdeclined =  mysqli_query($db, $sqldeclined);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
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


        
    </style>
</head>
<body>
    
    <table>
        <thead>
            <tr>
                <th>Professor</th>
                <th>Approve Count</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resultapproved)) {
                echo "<tr>";
                echo "<td>{$row['professor_name']}</td>";
                echo "<td>{$row['approved_count']}</td>";
                echo "</tr>";
                
            }
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Professor</th>
                <th>Decline Count</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resultdeclined)) {
                echo "<tr>";
                echo "<td>{$row['professor_name']}</td>";
                echo "<td>{$row['declined_count']}</td>";
                echo "</tr>";
                
            }
            ?>
        </tbody>
    </table>

    <a href="adminlogout.php" class="button">Log Out</a>

</body>
</html>