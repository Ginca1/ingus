<?php

session_start();

include("connections.php");
include("functions.php");

$user_data = check_login($con);

$sql = "SELECT id, username, email, picture FROM login WHERE username = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $user_data['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    
    $userData = $result->fetch_assoc();
    
   
    $stmt->close();
} else {
    
    die("Error in database query: " . $con->error);
}


$tasks_query = "SELECT * FROM tasks WHERE id = {$user_data['id']} AND task_status = 'todo'";
$tasks_result = mysqli_query($con, $tasks_query);

$done_tasks_query = "SELECT * FROM tasks WHERE id = {$user_data['id']} AND task_status = 'done'";
$done_tasks_result = mysqli_query($con, $done_tasks_query);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/head.css"></link>
    <title>Document</title>
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 1000;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="head">
   
    <div  href="javascript:void(0)" class="burger-icon" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
        <div class="hpart">
            <img src="asset/logo.png" href="cau">
        </div>
        <div class="hpart">
            <a onclick="showPopup('input.php')"class="butt">Add Task</a>
        </div>
        <div class="hpart">
            <a h onclick="showPopup('calendar.php')"class="butt">Calendar</a>
        </div>
        <div class="hpart">
            <a  onclick="showPopup('tasks.php')" class="butt">Tasks</a>
        </div>
       
        <div  style="width:20%;" class="hpart2">
            
               
        </div>
        <div class="hpart2">
            <div style="width:40%;  transition: background-color 0.3s; "  class="logbutt">
                <a class="butt" href="login.php">Login </a>
                <a class="butt" href="register.php">Signup </a>
            </div>
        </div>
        <div class="sidebar" id="mySidebar">
        
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()" style="border: none;">×</a>
        <a onclick="showPopup('input.php')"style="margin-top:20px;background-color: white;">New Task</a>
        <a onclick="showPopup('calendar.php')" style="margin-top:20px;background-color: white;">Calendar</a>
        <a onclick="showPopup('tasks.php')" style="margin-top:20px;background-color: white;">Tasks</a>

        <a href="login.php"  style="margin-top:20px;background-color: black;color: white;">Login</a>
        <a href="register.php"  style="margin-top:20px;background-color: black;color: white;">Signup</a>
       
    </div>
    
     <div class="popup" id="loginPopup">
        <p>You need to log in to access this feature.</p>
        
        <button  style="margin-left:45%;" onclick="hidePopup()">OK</button>
        </div>
    

      <div class="overlay" id="overlay" onclick="hidePopup()"></div>
    
    <script src="script.js"></script>

    <script>
        function showPopup(link) {
            document.getElementById('loginPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function hidePopup() {
            document.getElementById('loginPopup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

    </script>
</body>
      
        

</html>