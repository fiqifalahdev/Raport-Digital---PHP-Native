<?php 
    session_start();
    session_unset();
    session_destroy();

    setcookie("id", "", time() + 3600);
    setcookie("keyname", "", time() + 3600);

    header("Location: index.php");
    exit;
?>