<?php
    $host = 'localhost';
    $dbname = 'office_hours_db';
    $user = 'root';
    $password = '';
    $db = @mysqli_connect($host, $user, $password);
    @mysqli_select_db($db, $dbname);

    session_start();
    if(isset($_SESSION['type']) && $_SESSION['type'] == "student"){
        $id  = $_SESSION['studentid'];
        $query = "select * from office_hours oh join professors p on oh.professor_id = p.professor_id join teaches t on t.professor_id = p.professor_id where t.student_id = $id ;";
        $result = mysqli_query($db, $query);

    }
    else if(isset($_SESSION['type']) && $_SESSION['type'] == "professor"){
        $id  = $_SESSION['professorid'];
        $query = "select * from office_hours oh join professors p on oh.professor_id = p.professor_id where p.professor_id = $id ;";
        $result = mysqli_query($db, $query);
        
    }
        $fullcalendar = [];
        // Fetch associative data
        while ($row = mysqli_fetch_assoc($result)) {
            // Access data using associative keys
            $fullcalendar[] = [
                'id' => $row['office_hour_id'],
                'professor' => $row['professor_name'],
                'title' => $row['title'],
                'start' => $row['start_time'],
                'end' => $row['end_time']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($fullcalendar);
    
    
    

?>