<?php
$serverName = '127.0.0.1:3307';
$userName = 'root';
$password = '';
$dbname = 'eprsdatabase';

$con = new mysqli($serverName, $userName, $password, $dbname);
if (!$con) {
    die(mysqli_error($con));
}
