<?php
    session_start();
        if(isset($_SESSION["loggedin"])){
            include'loggedinprofessor.php';
        }
        else{
            include 'notloggedin.html';
        }

    ?>