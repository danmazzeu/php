<?php 
    function selectData($table, $columns, $where) {

        $columns = implode(', ', $columns);
        $sql = "SELECT $columns FROM $table WHERE $where";

        $result = mysqli_query($connect, $sql);
        if ($result) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    /*  USAGE
        $where_clause = "id = 10";
        $columns = ['id', 'name', 'email'];

        $userData = selectData('users', $columns, $where_clause);

        if ($userData) {
            foreach ($userData as $user) {
                echo $user['id'];
                echo $user['name'];
                echo $user['email'];
            }
        } else {
            echo "Error fetching data.";
        }
    */
?>