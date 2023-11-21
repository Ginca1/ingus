<?php

include("connections.php");


$user_id = $user_data['id'];


$sql = "SELECT picture FROM login WHERE id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($imageData);
    $stmt->fetch();
    $stmt->close();

   
    head("Content-Type: .jpg"); 

    
    echo $imageData;
} else {
    
    die("Error in database query: " . $con->error);
}
?>