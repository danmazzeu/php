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
?>