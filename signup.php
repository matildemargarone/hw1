<?php
    require_once 'auth.php';
    require_once 'db_config.php';

    // se l'utente è loggato reindirizza alla home
    if(checkAuth()){
        header("Location: home.php");
        exit;
    }

    //js può essere bypassato, effettuo controlli lato server

    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['username']) && !empty($_POST['email']) && 
        !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['allow']))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        
        //controlla se la stringa dell’username corrisponde al pattern definito
        if(!preg_match('/^[a-zA-Z0-9_]{3,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già in uso";
            }
        }
        
        $password = $_POST['password'];

        if (strlen($password) < 8) {
            $error[] = "La password deve contenere almeno 8 caratteri";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $error[] = "La password deve contenere almeno una lettera maiuscola";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $error[] = "La password deve contenere almeno una lettera minuscola";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $error[] = "La password deve contenere almeno un numero";
        }
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $error[] = "La password deve contenere almeno un simbolo speciale";
        }

        if (strcmp($password, $_POST['confirm_password']) != 0) {
            $error[] = "Le password non coincidono";
        }

        //controlla se il formato dell'email è valido
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già in uso";
            }
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userid'] = mysqli_insert_id($conn); //id dell'utente appena registrato
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if (!empty($_POST)) {
        $error = array("Riempi tutti i campi");
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Iscriviti</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="signup.css?v=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="signup.js?v=2" defer></script>
    </head>
    <body>
        <main class='signup'>
            <header>
                <img class='logo' src="https://www.thenorthface.it/img/logos/thenorthface/default.svg">
            </header>
            <section>
                <h2>Unisciti a XPLR Pass</h2>
                <p>
                    Sei già member di XPLR Pass? <a href="login.php">Accedi ora</a>
                </p>
                <form method="post" enctype="multipart/form-data">
                    <div class="field">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>>
                        <span class="error-message"></span>
                    </div>

                    <div class="field">
                        <label for="surname">Cognome</label>
                        <input type="text" name="surname" id="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> >
                        <span class="error-message"></span>
                    </div>

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                        <span class="error-message"></span>
                    </div>

                    <div class="field">
                        <label for="email">Indirizzo e-mail</label>
                        <input type="text" name="email" id="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                        <span class="error-message"></span>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                        <span class="error-message"></span>
                    </div>

                    <div class="field">
                        <label for="confirm_password">Conferma password</label>
                        <input type="password" name="confirm_password" id="confirm_password">
                        <span class="error-message"></span>
                    </div>

                    <div class="checkbox-container">
                        <input type="checkbox" name="allow" id="allow">
                        <label for="allow">
                            Accetto i <a href="#">Termini e Condizioni</a> del programma XPLR Pass, 
                            <a href="#">Termini e Condizioni di The North Face</a> e dichiaro di aver letto e compreso 
                            <a href="#">l'Informativa sulla Privacy</a>.<br>
                            <span class="error-message"></span>
                        </label>
                    </div>

                    <div id="form-error">
                        <span class="error-message">
                            <?php 
                                if(isset($error)) {
                                    foreach($error as $err) {
                                        echo "$err<br>";
                                    }
                                }
                            ?>
                        </span>
                    </div>

                    <input type="submit" value="Iscriviti ora" id="signup-button">
                </form>
            </section>
        </main>
    </body>
</html>