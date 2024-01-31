<?php

$host = 'localhost';
$dbname = 'office_hours_db';
$user = 'root';
$password = '';
$db = @mysqli_connect($host, $user, $password);
@mysqli_select_db($db, $dbname);
if(isset($_POST['username']) && isset( $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `admins` WHERE username = '$username';";
    $result = mysqli_query($db, $sql);
    $rows = mysqli_num_rows($result);
        if($rows > 0){
            $asarr = @mysqli_fetch_array($result);
            if($asarr["password"] == $password){
                echo" 
                <div style = 'text-align : center; margin-top: 20%'>
                <h1 > Your Log in Was Successful</h1>
                <form action='admin.php' method='POST'>
                    <input type='submit' style = 'background-color: #4285f4;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;' value = 'Go To Dashboard'>
                </form>
                </div>"
                ;
            }
            else{
                include("wrongadmin.html");
            }
        }else{
            include("wrongadmin.html");
        }
    
}


?>