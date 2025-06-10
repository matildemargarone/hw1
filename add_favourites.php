<?php 

    header('Content-Type: application/json');
    require_once 'auth.php'; 
    require_once 'db_config.php';

    if (!checkAuth()){     
        header("Location: login.php");     
        exit; 
    }  

    $userid = $_SESSION['userid'];  

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']); 

    $articleid = intval($_POST['id']); //converte in int
    $articlename = mysqli_real_escape_string($conn, $_POST['name']);
    $articlesrc = mysqli_real_escape_string($conn, $_POST['src']);

    $check_query = "SELECT id FROM favourites WHERE userid = '$userid' AND articleid = '$articleid'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode(array('ok' => false, 'error' => 'Articolo già nei preferiti'));
        mysqli_close($conn);
        exit;
    }

    // Inserisci nuovo preferito
    $query = "INSERT INTO favourites(userid, articleid, article_name, article_src) 
              VALUES ('$userid', '$articleid', '$articlename', '$articlesrc')";  

    if(mysqli_query($conn, $query)) {     
        echo json_encode(array('ok' => true, 'message' => 'Preferito aggiunto con successo')); 
    } else {     
        echo json_encode(array('ok' => false, 'error' => 'Errore inserimento: ' . mysqli_error($conn))); 
    }  

    mysqli_close($conn);

?>