<?php 
    function deleteData($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
    
        if (mysqli_query($connect, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    /* USAGE
        $table = "users";
        $where = "id = 10";

        if (deleteData($table, $where)) {
            echo "Data deleted successfully!";
        } else {
            echo "Error deleting data.";
        }
    */
?>