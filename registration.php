<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "office_hours_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username, password, and ID from form
$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id']; // Assuming the ID field is provided in the form

// Check if the ID exists in the students table
$query = "SELECT * FROM students WHERE student_id = $id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // ID exists in the students table
    $updateQuery="UPDATE `students` SET `Username`='$username',`Password`='$password' WHERE `student_id` = $id;";
    $insertResult = $conn->query($updateQuery);

    if ($insertResult) {
        header('Location: login.html'); // Redirect to login page after successful registration
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Check if the ID exists in the professors table
    $query = "SELECT * FROM professors WHERE professor_id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // ID exists in the professors table
        $updateQuery = "UPDATE `professors` SET `Username`='$username',`Password`='$password' WHERE `professor_id` = $id;";
        $updateResult = $conn->query($updateQuery);

        if ($updateResult) {
            header('Location: login.html'); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // ID not found in both tables, display registration denied message
        echo "Registration denied: ID not found";
    }
}

$conn->close();
?>
