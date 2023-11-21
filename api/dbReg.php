<?php



class Database
{
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;
    public $conn;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "trio";
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}



?>