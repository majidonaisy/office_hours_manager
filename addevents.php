<?php
    session_start();
    $host = 'localhost';
    $dbname = 'office_hours_db';
    $user = 'root';
    $password = '';
    $db = @mysqli_connect($host, $user, $password);
    @mysqli_select_db($db, $dbname);
    $id = $_SESSION['professorid'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $sqlinsert = "INSERT INTO office_hours(professor_id,title, start_time, end_time) VALUES ('$id','$title', '$start', '$end');";
    if(mysqli_query($db, $sqlinsert)){
        header("Location:calendar.php");
        exit();
    }
    else{
        header("Location:add.html");
        $_SESSION["errormsg"] = "Couldn't insert event";
        exit();
    }
?>