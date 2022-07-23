<?php
require "config.php";

function show($sql)
{
    global $conn;
    $query = mysqli_query($conn, $sql);

    $rows = [];
    if (mysqli_num_rows($query)) {
        while ($item = mysqli_fetch_assoc($query)) {
            $rows[] = $item;
        }
    }
    return $rows;
}

function addData($sql)
{
    global $conn;
    $query = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        return $query;
    } else {
        echo "
            <p style='color: red; text-style:italic;' class='startingContent alert alert-danger' role='alert'>Terjadi Kesalahan</p>
        ";
        // var_dump(mysqli_error($conn));
        // die;
    }
}
