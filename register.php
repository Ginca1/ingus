<?php
session_start();

include("connections.php");
include("functions.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="css/login.css">
    <title>Register</title>
</head>
<body>
    <div class="main">
        <div class="row">
            <div class="register-box">
                <div style="margin-top:10%;" class="row">
                    <div class="circle">
                        <div class="row">
                            <img style="width:130px; height:130px;" src="asset/logo.png" alt="">
                        </div>
                    </div>
                </div>
                <div style="margin-top:0%;margin-left:0%;" class="row">
                    <div class="register">
                        <form method="POST" id="taskForm" >
                            <div style="" class="row">
                                <h1>Register</h1>
                            </div>
                            <div style="justify-content:left; margin-top:5%; " class="row">
                                <input id="username" type="text" placeholder="Username">
                            </div>
                            <div class="row">
                                <p style="color: red;  font-weight: 700;" id="username-val"></p>
                            </div>
                            <div style="justify-content:left; " class="row">
                                <input id="email" type="text" placeholder="Email">
                            </div>
                            <div class="row">
                                <p style="color: red;  font-weight: 700;" id="email-val"></p>
                            </div>
                            <div style="justify-content:left; " class="row">
                                <input id="pass" type="password" placeholder="Password">
                            </div>
                            <div class="row">
                                <p style="color: red;  font-weight: 700;" id="pass-val"></p>
                            </div>
                            <div class="row">
                                <p>Choose profile picture</p>
                            </div>
                            <div style="margin-top:2%;" class="row">
                                <div id="picture-input">
                                    <input type="file" id="fileInput" accept="image/*" style="display: none;">
                                    <label for="fileInput" id="fileLabel">Select an image</label>
                                </div>
                                
                                <div class="row">
                                    <img src="" id="preview" width="150">
                                </div>
                            </div>
                            <div class="row">
                                <p style="color: red; font-weight: 700;" id="file-val"></p>
                            </div>
                            <div class="row">
                                <p style="color: green; font-weight: 700;" id="Succ"></p>
                            </div>
                            <div style="margin-top:0%; justify-content:space-between;" class="row">
                                <p style="color: black; cursor: pointer; transition: color 0.3s, transform 0.3s;" onmouseover="this.style.color='blue';
                                 this.style.transform='scale(1.1)';" onmouseout="this.style.color='black'; this.style.transform='scale(1)';"  onclick="window.location.href='login.php';"
                                  >Already have an account?</p>
                                <button type="submit" class="custom-button" id="registerButton"> <span>Register</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    $('#taskForm').submit(function (event) {
        event.preventDefault();

        const username = $('#username').val();
        const email = $('#email').val();
        const password = $('#pass').val();

        const imageInput = $('#fileInput')[0].files[0];

        let isValid = true;

      
        $("#username-val, #email-val, #pass-val, #file-val").text("");

        
        if (username === "") {
            $("#username-val").text("Please enter a username.");
            isValid = false;
        } else if (username.length < 3) {
            $("#username-val").text("Please enter a username that is longer.");
            isValid = false;
        } else if (username.length >= 7) {
            $("#username-val").text("Please enter a username that is shorter.");
            isValid = false;
        }

        
        if (email === "") {
            $("#email-val").text("Please enter an email.");
            isValid = false;
        } else if (!isValidEmail(email)) {
            $("#email-val").text("Please enter a valid email address.");
            isValid = false;
        }

        
        if (password === "") {
            $("#pass-val").text("Please enter a password.");
            isValid = false;
        } else if (password.length <= 8) {
            $("#pass-val").text("Please enter a password that is 9 characters long.");
            isValid = false;
        }

       
        if (!imageInput) {
            $("#file-val").text("Please select an image.");
            isValid = false;
        }

        if (isValid) {
            const formData = new FormData();
            formData.append('username', username);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('image', imageInput);

            $.ajax({
                url: 'api/insertRegister.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    response = JSON.parse(response);
                    if (response.message) {
                        $("#Succ").text(response.message);
                    }
                    
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while inserting data.');
                    
                } 
            });
        }
    });
});

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
     
        const dropArea = document.getElementById('picture-input');
        const fileInput = document.getElementById('fileInput');
        const fileLabel = document.getElementById('fileLabel');
        const preview = document.getElementById('preview');

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.style.border = '2px dashed #000';
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.style.border = '2px dashed #ccc';
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            handleFile(file);
        });

        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    document.querySelector('h3').style.display = 'none';
                    $("#file-val").text(""); 
                };
                reader.readAsDataURL(file);
            } else {
                $("#file-val").text("Invalid file. Please select an image.");
            }
        }
    </script>
</body>
</html>