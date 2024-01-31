<?php
$host = 'localhost';
$dbname = 'office_hours_db';
$user = 'root';
$password = '';
$db = @mysqli_connect($host, $user, $password);
@mysqli_select_db($db, $dbname);
if(isset($_POST['username']) && isset( $_POST['password']) && isset( $_POST['usertype'])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    if($usertype == "student"){
        $sql = "SELECT * FROM `students` WHERE username = '$username';";
        $result = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $asarr = @mysqli_fetch_array($result);
            if($password == $asarr["password"]){
                
                $_SESSION["name"] = $asarr["student_name"];
                $_SESSION["loggedin"] = true;
                $_SESSION["type"] = $usertype;
                $_SESSION["studentid"] = $asarr["student_id"];

                echo" 
                <div style = 'text-align : center; margin-top: 20%'>
                <h1 > Your Log in Was Successful</h1>
                <form action='student_dashboard.php' method='POST'>
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
            }else{
                include("wronglogin.html");
                /*echo"<h1>Incorrect Username or Password<h1><br>
                <form action='login.html' method='POST'>
                <button type='submit'>Log In</button>
                    </form>";*/
            }
        }else{
            include("wronglogin.html");
            /*echo"<h1>Incorrect Password<h1><br>
            <form action='login.html' method='POST'>
                    <input type='submit' value = 'Go Back'>
                </form>";*/
            
        }
    }
    elseif($usertype == "professor"){
        $sql = "SELECT * FROM `professors` WHERE username = '$username';";
        $result = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $asarr = @mysqli_fetch_array($result);
            if($password == $asarr["password"]){
                $_SESSION["loggedin"] = true;
                $_SESSION["name"] = $asarr["professor_name"];
                $_SESSION["professorid"] = $asarr["professor_id"];
                $_SESSION["type"] = $usertype;
                echo" 
                <div style = 'text-align : center; margin-top: 20%'>
                <h1 > Your Log in Was Successful</h1>
                <form action='professor_dashboard.php' method='POST'>
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
            }else{include("wronglogin.html");/*
                echo"<div style = 'text-align : center; margin-top: 20%'>
                <h1 style = 'color:red'>Incorrect Username or Password<h1><br>
                <form action='login.html' method='POST'>
                        <input type='submit' value = 'Go Back'
                        style = 'background-color: #4285f4;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;'>
                    </form>
                </div>    
                    ";*/
            }
    }else{include("wronglogin.html");
        /*
        echo"<h1>Incorrect Password<h1><br>
        <form action='login.html' method='POST'>
                <input type='submit' value = 'Go Back'>
            </form>";*/
        
    }

    }
}
?>