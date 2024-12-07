<?php
    class CRUD {
        public string $hostname;
        public string $username;
        public string $password;
        public string $database;
        public string $table;
        public array $parameters;
        public array $where;
        private mysqli $mysqli;

        public function connect() {
            $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($this->mysqli->connect_error) { die("Connection failed: " . $this->mysqli->connect_error); }
        }

        public function close() {
            $this->mysqli->close();
        }

        public function create(array $data): bool {
            $sql = "INSERT INTO $this->table (" . implode(", ", array_keys($data)) . ") VALUES (" . implode(", ", array_fill(0, count($data), "?")) . ")";
            $stmt = $this->mysqli->prepare($sql);
            $params = array_values($data);
            $types = str_repeat('s', count($params));  
            $stmt->bind_param($types, ...$params);
    
            if (!$stmt->execute()) {
                return false;
            }
    
            $stmt->close();
            return true;
        }
    
        public function read(array $where = []): array {
            $sql = "SELECT * FROM $this->table";
            if (!empty($where)) {
                $sql .= " WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = ?", array_keys($where), $where));
            }
    
            $stmt = $this->mysqli->prepare($sql);
    
            if (!empty($where)) {
                $params = array_values($where);
                call_user_func_array(array($stmt, 'bind_param'), $params);
            }
    
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = [];
            
            while ($row = $result->fetch_assoc()) { $rows[] = $row; }
    
            return $rows;
        }

        public function update(array $data, array $where): bool {
            $sql = "UPDATE $this->table SET ";
            $sql .= implode(", ", array_map(fn($k, $v) => "$k = ?", array_keys($data), $data));
            $sql .= " WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = ?", array_keys($where), $where));
        
            $stmt = $this->mysqli->prepare($sql);
        
            if (!$stmt) {
                die("Error preparing statement: " . $this->mysqli->error);
            }
        
            $params = array_merge(array_values($data), array_values($where));
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        
            if (!$stmt->execute()) {
                die("Error executing statement: " . $stmt->error);
            }
        
            $stmt->close();
            return true;
        }

        public function delete(array $where): bool {
            $sql = "DELETE FROM $this->table WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = ?", array_keys($where), $where));
        
            $stmt = $this->mysqli->prepare($sql);
        
            if (!$stmt) {
                die("Error preparing statement: " . $this->mysqli->error);
            }
        
            $params = array_values($where);
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        
            if (!$stmt->execute()) {
                die("Error executing statement: " . $stmt->error);
            }
        
            $stmt->close();
            return true;
        }
    }

/* Usage
    require_once('php/global/crud.php'); 

    $crud = new CRUD();
    $crud->hostname = "127.0.0.1";
    $crud->username = "root";
    $crud->password = "";
    $crud->database = "miniumbook";
    $crud->table = "condominiums";
    $crud->connect();

    // Create
    $data = [
        "username" => "johndoe",
        "email" => "johndoe@example.com",
        "password" => "password123"
    ];
    $crud->create($data);
    
    // Read
    $data = $crud->read();
    header('Content-Type: application/json');
    echo json_encode($data);

    // Update
    $where = ["id" => 1];
    $data = ["email" => "johndoe@newmail.com"];
    $crud->update($data, $where);

    // Delete
    $where = ["id" => 2];
    $crud->delete($where);

    $crud->close();
*/
?>
