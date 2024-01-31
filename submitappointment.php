<?php
session_start();
$host = 'localhost';
$dbname = 'office_hours_db';
$user = 'root';
$password = '';
$db = @mysqli_connect($host, $user, $password);
@mysqli_select_db($db, $dbname);

if(isset($_POST['officeHourId']) && isset($_POST["professorName"]) && isset($_POST["startTime"]) && isset($_POST["endTime"])){
    try{

    $start = $_POST["startTime"];
    $end = $_POST["endTime"];
    $professor = $_POST["professorName"];
    $officeHourId = $_POST['officeHourId'];
    $studentid = $_SESSION["studentid"];
    $sql = "INSERT INTO 
    `appointments`(`student_id`, `office_hour_id`) 
    VALUES ($studentid,$officeHourId)";
    $result = mysqli_query($db, $sql);
    if ($result && mysqli_affected_rows($db) > 0) {
        header("Location: successfulappointment.html");
        exit();
    }else{
        header("Location: unsuccessfulappointment.html");
        exit();
    }

}catch(Exception $e){
    header("Location: unsuccessfulappointment.html");
        exit();
}


        

}

?>