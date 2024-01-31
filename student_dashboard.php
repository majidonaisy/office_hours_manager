    <?php
    session_start();
        if(isset($_SESSION["loggedin"])){
            include'loggedinstudent.php';
        }
        else{
            include 'notloggedin.html';
        }

    ?>