<?php
    $localhost = "localhost";
    $username = "root";
    $pw = "";
    $db = "raportdigital";

    $conn = mysqli_connect($localhost, $username, $pw, $db);

    if (mysqli_connect_errno()) {
        echo "
        <script>
            alert('Database Tidak tersambung!');
        </script>
        ";
        exit;
    }
?>