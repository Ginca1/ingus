<?php

class TaskStatusHandler {
    private $db;

    public function __construct() {
        require_once('db.php'); 
        $this->db = new DB(); 
    }

    public function getTaskStatuses() {
        
        $query = "SELECT DISTINCT task_status FROM tasks";

        $result = $this->db->conn->query($query);

        $statuses = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $statuses[] = $row["task_status"];
            }
        }
        

        $this->db->closeConnection();

        
        echo json_encode($statuses);
    }
}

$taskStatusHandler = new TaskStatusHandler();
$taskStatusHandler->getTaskStatuses();
?>
