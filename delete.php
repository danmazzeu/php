<?php 
    function deleteData($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
    
        if (mysqli_query($connect, $sql)) {
            return true;
        } else {
            return false;
        }
    }
?>