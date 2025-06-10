<?php
    
    require_once 'db_config.php';
    require_once 'auth.php';

    // se loggato reindirizza alla home
    if (checkAuth()) {
        header("Location: home.php"); //il browser invierà una nuova richiesta alla pagina indicata
        exit;
    }

    if(!empty($_POST['username']) && !empty($_POST['password'])){
        //se entrambi esistono e non sono vuoti 

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                // imposto variabili di sessione
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $entry['username'];
                $_SESSION['userid'] = $entry['id'];
                header("Location: home.php");
                mysqli_free_results($res);
                mysqli_close($conn);
                exit;
            }
        }
        
        mysqli_close($conn);
        $error = "Username e/o password errati.";

    }else if (isset($_POST['username']) || isset($_POST['password'])) {
        $error = "Inserisci username e password.";
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accedi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <main class='login'>
            <header>
                <img class='logo' src="https://www.thenorthface.it/img/logos/thenorthface/default.svg">
            </header>
            <section>
                <h2>Accedi al tuo account XPLR Pass</h2>
                <?php 
                    if(isset($error)){
                        echo "<p class='error'>$error</p>";
                    }
                ?>
                <form method='post'>
                    <!-- precompilo con l'ultimo valore-->
                    <label for='username'>Username</label>
                    <input type='text' name='username' id='username' value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>">

                    <label for='password'>Password</label>
                    <input type='password' name='password' id='password'>

                    <input type='submit' value='Accedi al tuo account XPLR Pass' id='login-button'>
                </form>
                <div class="not-registered">
                    <p>Non sono iscritto?</p>
                    <a href="signup.php" id="signup-button">Iscriviti ora</a>
                </div>
            </section>
        </main>
    </body>
</html>