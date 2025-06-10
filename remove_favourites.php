<?php
require_once 'auth.php';
require_once 'db_config.php';

header('Content-Type: application/json');

if (!checkAuth()) {
    echo json_encode(['success' => false, 'error' => 'Non autorizzato']);
    exit;
}

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID mancante']);
    exit;
}

$userid = $_SESSION['userid'];
$articleid = $_POST['id'];

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Errore connessione: ' . mysqli_connect_error()]);
    exit;
}

$query = "DELETE FROM favourites WHERE userid = '$userid' AND articleid = '$articleid'";
$res = mysqli_query($conn, $query);

if (!$res) {
    echo json_encode(['success' => false, 'error' => 'Errore query: ' . mysqli_error($conn)]);
    exit;
}

if (mysqli_affected_rows($conn) > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => "Preferito non trovato. UserID: $userid, ArticleID: $articleid"]);
}

mysqli_close($conn);
?>