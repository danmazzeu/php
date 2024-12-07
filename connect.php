<?php
    class Connection {
        private $hostname;
        private $username;
        private $password;
        private $database;
        private $mysqli;
    
        public function __construct($hostname, $username, $password, $database) {
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
            $this->mysqli = new mysqli($hostname, $username, $password, $database);
    
            if ($this->mysqli->connect_error) {
                die("Connection failed: " . $this->mysqli->connect_error);
            }
        }

        public function closeConnection() {
            $this->mysqli->close();
        }
    }

    /* Usage 
        $connect = new Connection("127.0.0.1", "username", "password", "database");
        $connect->closeConnection();
    */
?>
