<?php
include 'database.php';
session_start();
if (!isset($_SESSION['userid'])) {
    // header('location:home.php');
}


if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $serial = $_POST['serial'];
    $description = $_POST['description'];





    $sql = "INSERT INTO projector (brand, serial, description) 
    VALUES ('$brand', '$serial', '$description')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: projector.php");
    } else {
        die(mysqli_error($con));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <title>Add Projector</title>
</head>

<body>
    <!-- <div class="wrapper">
        <input type="checkbox" id="btn" hidden>
        <label for="btn" class="menu-btn">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
        </label>
        <nav id="sidebar">
            <div class="title">
                EPRS
            </div>
            <ul class="list-items">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fas fa-user"></i>Account</a></li>
                <li> <button class="dropdown-btn"><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;Reports
                        <i class="fa fa-caret-down"></i> </button>
                    <div class="dropdown-container">
                        <a href="userlist.php">User List</a>
                        <a href="listofprojector.php">List of Projector</a>
                        <a href="reservation.php">Projector Reservation</a>
                <li><a href="#"><i class="fas fa-address-book"></i>Data Entry</a></li>
                <li><a href="#" class="open-button"><i class="fas fa-cog"></i>File Maintenance</a></li>
                <div class="icons">
                    <div class="student">
                        <h3>Vince Tuan</h3>
                        <p>Student</p>
                    </div>
                    <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </ul>
        </nav>
    </div> -->
    <div class="wrapper">
        <input type="checkbox" id="btn" hidden>
        <label for="btn" class="menu-btn">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
        </label>
        <nav id="sidebar">
            <div class="title">
                EPRS
            </div>
            <ul class="list-items">
                <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="changepass.php"><i class="fas fa-user"></i>Change Password</a></li>
                <li><a href="dataentry.php"><i class="fas fa-address-book"></i>Data Entry</a></li>
                <li><a href="projectoruser.php" class="open-button"><i class="fas fa-cog"></i>File Maintenance</a></li>
                <li> <button class="dropdown-btn"><i class="fas fa-envelope"></i>
                        &nbsp;&nbsp;&nbsp;Reports
                        <i class="fa fa-caret-down"></i> </button>

                    <div class="dropdown-container">
                        <a href="userlist.php">User List</a>
                        <a href="listofprojector">List of Projector</a>
                        <a href="reservation.php">Projector Reservation</a>
                    </div>
                </li>

                <div class="icons">
                    <div class="info">
                        <?php
                        require 'database.php';

                        $query = mysqli_query($con, "SELECT * FROM `users` WHERE `userid`='$_SESSION[userid]'") or die("Connection failed: " . mysqli_connect_error());
                        $fetch = mysqli_fetch_array($query);


                        echo "<h3>" . $fetch['firstname'] . "\n" . $fetch['lastname'] . "</h3>";
                        echo "<p>" . $fetch['usertype'] . "</p>";
                        ?>

                    </div>
                    <a href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </ul>
        </nav>
    </div>
    <div class="form-wrapper">
        <form class="add-user" method="POST">
            <h1>ADD PROJECTOR</h1>
            <input type="text" class="textField" name="brand" placeholder="Projector Brand" autocomplete="off" required>
            <input type="text" class="textField" name="serial" placeholder="Projector Serial" autocomplete="off" required>
            <input type="text" class="textField" name="description" placeholder="Projector Description" autocomplete="off" required>
            <input type="submit" value="ADD PROJECTOR" class="add-btn" name="submit" autocomplete="off">
        </form>
        <button class="back-btn"><a href="projector.php">Back to Home</a></button>
    </div>
    <div class="">

    </div>
</body>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

</html>