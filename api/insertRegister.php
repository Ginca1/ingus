<?php
require 'dbReg.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
if (isset($_FILES['image'])) {
    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error    = $_FILES['image']['error'];

    if ($error === 0) {
        if ($img_size > 1000000) {
            $em = "Sorry, your file is too large.";
            $error = array('error' => 1, 'em' => $em);
            echo json_encode($error);
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $upload_dir = 'C:/xampp/htdocs/darbi/Trio/pictures/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $img_upload_path = $upload_dir . $new_img_name;

                move_uploaded_file($tmp_name, $img_upload_path);

                $db = new Database();

                if ($db->conn->connect_error) {
                    die("Connection failed: " . $db->conn->connect_error);
                }

                $sql = "INSERT INTO login (username, email, password, picture) VALUES ('$username', '$email', '$password', '$new_img_name')";

                if ($db->conn->query($sql) === TRUE) {
                    $image_path = $upload_dir . $new_img_name;
                    $response = array('message' => 'Registration successful!', 'image_path' => $image_path);
                    echo json_encode($response);
                    exit();
                } else {
                    $response = array('message' => 'Error: ' . $db->conn->error);
                    echo json_encode($response);
                }

                $db->conn->close();
            } else {
                $em = "You can't upload files of this type";
                $error = array('error' => 1, 'em' => $em);
                echo json_encode($error);
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
        exit();
    }
}
}
?>