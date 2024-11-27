<?php
    $hostname = "seu_servidor";
    $username = "seu_usuario";
    $password = "sua_senha";
    $database = "seu_banco_de_dados";

    $connect = new mysqli($hostname, $username, $password, $database);

    if ($connect->connect_error) {
        die("Conexão falhou: " . $connect->connect_error);
    }
?>