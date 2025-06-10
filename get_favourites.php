<?php
require_once 'auth.php';
require_once 'db_config.php';

header('Content-Type: application/json');

if (!checkAuth()) {
    echo json_encode(['error' => 'Non autorizzato']);
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = $_SESSION['userid'];

$query = "SELECT articleid, article_name, article_src FROM favourites WHERE userid = '$userid'";
$res = mysqli_query($conn, $query);

$favourites = [];

while ($row = mysqli_fetch_assoc($res)) {
    $favourites[] = $row;
}

echo json_encode($favourites);
?>