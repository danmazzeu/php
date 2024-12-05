<?php
    require_once('connect.php');

    $stmt = mysqli_prepare($connect, "SELECT $columns FROM $table WHERE $where");

    mysqli_stmt_bind_param($stmt, 's', $whereValue);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);

    header('Content-Type: application/json');
    echo json_encode($data);
?>
