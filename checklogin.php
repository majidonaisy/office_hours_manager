<?php

        if($_SESSION['loggedin'] == true ){
            if($_SESSION['type'] == 'student'){
            include 'student_dashboard.php';
            }
            else{
                include 'professor_dashboard.php';
            }
        }
        else{
            include 'notloggedin.html';
        }

?>