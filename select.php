<?php 
    $columns = $_POST['columns'];
    $table = $_POST['table'];
    $where = isset($_POST['where']) ? $_POST['where'] : '';

    $sql = "SELECT " . implode(', ', $columns) . " FROM " . $table;
    if (!empty($where)) {
        $sql .= " WHERE " . $where;
    }

    $stmt = mysqli_prepare($connect, $sql);

    if (!empty($where)) {
        mysqli_stmt_bind_param($stmt, $_POST['where']);
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($data);

    mysqli_close($connect);
?>
