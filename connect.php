<?php
class Connect {
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "miniumbook";
    private $connect;

    public function __construct() {
        $this->connect = new mysqli(
            $this->hostname, 
            $this->username, 
            $this->password, 
            $this->database
        );

        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
        }
    }

    public function getConnection() {
        return $this->connect;
    }

    public function closeConnection() {
        $this->connect->close();
    }
}

/* Usage 
$db = new Connect();
$connect = $db->getConnection();
$db->closeConnection();
*/
?>
