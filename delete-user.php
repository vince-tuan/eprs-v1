<?php

include "database.php";
session_start();

if (isset($_GET['deleteid'])) {
    $userid = $_GET['deleteid'];

    $sql = "DELETE FROM users WHERE userid = '$userid'";
    $result = mysqli_query($con, $sql);

    if ($result == TRUE) {
        header("location: projectoruser.php");
    } else {
        die(mysqli_error($con));
    }
}
