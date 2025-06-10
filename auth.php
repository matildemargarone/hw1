<?php
    // avvia o riprende sessione
    session_start();

    // controlla se l'utente è autenticato
    function checkAuth() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
?>