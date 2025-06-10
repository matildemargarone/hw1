<?php
    header('Content-Type: application/json');
    
    if (!isset($_GET["q"])) {
        echo json_encode(['error' => 'Parametro mancante']);
        exit;
    }

    require_once 'db_config.php';

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    
    if (!$conn) {
        echo json_encode(['error' => 'Errore connessione database']);
        exit;
    }

    $username = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT username FROM users WHERE username = '$username'";

    $res = mysqli_query($conn, $query);
    
    if (!$res) {
        echo json_encode(['error' => 'Errore query database']);
        mysqli_close($conn);
        exit;
    }

    echo json_encode(['exists' => mysqli_num_rows($res) > 0]);

    mysqli_close($conn);
?>