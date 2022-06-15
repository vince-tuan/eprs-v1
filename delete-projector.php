<?php

include "database.php";
session_start();

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM projector WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result == TRUE) {
        header("location: projector.php");
    } else {
        die(mysqli_error($con));
    }
}
