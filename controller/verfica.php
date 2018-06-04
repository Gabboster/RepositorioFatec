<?php
    session_start();

    if (!$_SESSION['matricula']) {
        header('login.php');
    }

?>