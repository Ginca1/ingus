<?php

class Database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "trio");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function deleteTask($taskId)
    {
        $sql = "DELETE FROM tasks WHERE task_id = $taskId";

        if ($this->conn->query($sql) === TRUE) {
            $response = array('message' => 'Task deleted successfully');
            echo json_encode($response);
        } else {
            $response = array('message' => 'Error deleting task: ' . $this->conn->error);
            echo json_encode($response);
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['task_id'];

    $db = new Database();
    $db->deleteTask($taskId);

    $db->closeConnection();
}

?>