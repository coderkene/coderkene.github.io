<?php
class Database
{

//    private $host = "premium59.web-hosting.com";
//    private $db_name = "adicdkuc_current";
//    private $username = "adicdkuc_user";
//    private $password = "connected";
//    public $conn;

    private $host = "localhost";
    private $db_name = "metaminingtrade";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
 {

     $this->conn = null;
        try
  {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
   $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
  catch(PDOException $exception)
  {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
