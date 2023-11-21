
<?php
 
session_start();

include("connections.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username))
    {

        
        $query = "select * from login where username = '$username' limit 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {

                    $_SESSION['id'] = $user_data['id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        
        echo "wrong username or password!";
    }else
    {
        echo "wrong username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="./css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="main">
        <div style="margin-top:0%;" class="row">
            <div class="login-box">
                <form method="POST" id="loginForm">
                    <div style="margin-top:10%;" class="row">
                        <div class="circle">
                            <div class="row">
                                <img style="width:130px; height130px;" src="asset/logo.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:13%;margin-left:6%;" class="row">
                        <div class="login">
                            <div style="" class="row">
                                <h1>Login</h1>
                            </div>

                            <div style="justify-content:left;" class="row">
                                <input type="text" name="username"  placeholder="Username">
                            </div>
                            <div class="row">
                                <p style="color: red;" id="userCheck-val"></p>
                            </div>

                            <div style="justify-content:left;" class="row">
                                <input type="password" name="password"  placeholder="Password">
                            </div>
                            <div class="row">
                                <p style="color: red;" id="passCheck-val"></p>
                            </div>
                            <div style="justify-content:right;" class="row">
                                <p class="effect">Forgot Password?</p>
                            </div>
                            <div class="row">
                                <p style="color: green;" id="Succes"></p>
                            </div>
                            <div style="margin-top:5%; justify-content:space-between;" class="row">
                                <p style="color: black; cursor: pointer; transition: color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.color='blue'; this.style.transform='scale(1.1)';"
                                    onmouseout="this.style.color='black'; this.style.transform='scale(1)';"
                                    onclick="window.location.href='register.php';">New here? Register</p>
                                <button type="submit" class="custom-button" id="loginButton"> <span>Login</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    

</body>
</html>