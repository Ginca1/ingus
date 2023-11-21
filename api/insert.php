<?php
session_start();

include("../connections.php");
include("../functions.php");
require_once "db.php";
$user_data = check_login($con);

$id = $user_data['id'];
$db = new DB();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $taskName = $_POST["taskName"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $status = $_POST["status"];

    
    $id = $user_data['id'];

    
    $stmt = $db->conn->prepare("INSERT INTO tasks (id, task_name, description, due_date, task_status) 
                                VALUES (?, ?, ?, ?, ?)");

 
    $stmt->bind_param("issss", $id, $taskName, $description, $date, $status);

  
    if ($stmt->execute()) {
      
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}


$db->closeConnection();
?>