<?php
include("database.php");
session_start();
if (!isset($_SESSION['userid'])) {
    // header('location:home.php');
}

if (isset($_POST['submit'])) {
    $userid = $_POST['user_id'];
    $usertype = $_POST['usertype'];
    $cns = $_POST['course_and_section'];
    $contact = $_POST['contact_num'];
    $serial = $_POST['serial_num'];
    $date = $_POST['date'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];

    if ($userid == "" && $cns == "" && $contact == "" && $serial == "" && $date == "" && $stime == "" && $etime == "") {
        header("Location: dataentry.php?error=Please Input The Blanks");
    } else if (empty($_POST['user_id'])) {
        header("Location: dataentry.php?error=Please Enter User ID");
    } else if (empty($_POST['usertype'])) {
        header("Location: dataentry.php?error=Please Enter User Type");
    } else if (empty($_POST['course_and_section'])) {
        header("Location: dataentry.php?error=Please Enter Course and Section");
    } else if (empty($_POST['contact_num'])) {
        header("Location: dataentry.php?error=Please Enter Contact Number");
    } else if (empty($_POST['serial_num'])) {
        header("Location: dataentry.php?error=Please Enter Serial Number");
    } else if (empty($_POST['date'])) {
        header("Location: dataentry.php?error=Please Enter Date");
    } else if (empty($_POST['stime'])) {
        header("Location: dataentry.php?error=Please Enter The Start Time");
    } else if (empty($_POST['etime'])) {
        header("Location: dataentry.php?error=Please Enter The End Time");
    } else if ($userid != "" && $usertype != "" && $cns != "" && $contact != "" && $serial != "" && $date != "" && $stime != "" && $etime != "") {
        $result = mysqli_query($con, "INSERT into `reservationtbl`(`userid`,`usertype`, `courseandsection`, `contactnumber`, `serialnumber`, `dateofborrowed`, `starttime`, `endtime`)values('$userid', '$usertype', '$cns', '$contact', '$serial', '$date', '$stime', '$etime')");
        if ($result) {
            header("Location: dataentry.php?error=Success");
        }
    }
}
