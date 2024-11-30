<?php 
    function updateData($table, $set, $where) {
        $sets = implode(', ', $set);
        $sql = "UPDATE $table SET $sets WHERE $where";
    
        if (mysqli_query($connect, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    /*
        $table = "users";
        $set = ["name" => "New Name", "email" => "new_email@example.com"];
        $where = "id = 10";

        if (updateData($table, $set, $where)) {
            echo "Data updated successfully!";
        } else {
            echo "Error updating data.";
        }
    */
?>