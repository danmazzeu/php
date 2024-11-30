<?php 
    function insertData($table, $columns, $values) {
        $fields = implode(', ', $columns);
        $formatted_values = implode(', ', array_map('mysqli_real_escape_string', $connect, $values));

        $sql = "INSERT INTO $table ($fields) VALUES ($formatted_values)";
    
        if (mysqli_query($connect, $sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    /* USAGE
        $table = "users";
        $columns = ["name", "email", "password"];
        $values = ["John Doe", "johndoe@example.com", "password123"];
        
        if (insertData($table, $columns, $values)) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data.";
        }
    */
?>