<?php
class Connect {
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "database";
    private $connect;

    public function getConnection() {
        $this->connect = new mysqli(
            $this->hostname, 
            $this->username, 
            $this->password, 
            $this->database
        );

        if ($this->connect->connect_error) {
            throw new Exception("Falha na conexão: " . $this->connect->connect_error);
        }

        return $this->connect;
    }

    public function closeConnection() {
        $this->connect->close();
    }
}

/* Usage 
$newConnect = new Connect();
$connect = $newConnect->getConnection();
$newConnect->closeConnection();
*/
?>
