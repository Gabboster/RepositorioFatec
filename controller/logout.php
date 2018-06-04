<?php 
    session_start();

    if (isset($_SESSION['matricula'])) {
        setcookie(session_name(), '', 100);
        session_unset();
        session_destroy();

        header("Location: /login.php");
        die();
    }
?>