<?php
include "database.php";
session_start();
if (!isset($_SESSION['userid'])) {
    // header('location:home.php');
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>EPRS SCAS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="app.js"></script>
</head>

<body>
    <!-- 
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
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fas fa-user"></i>Account</a></li>
                <li> <button class="dropdown-btn"><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;Reports
                        <i class="fa fa-caret-down"></i> </button>
                    <div class="dropdown-container">
                        <a href="userlist.php">User List</a>
                        <a href="listofprojector.php">List of Projector</a>
                        <a href="reservation.php">Projector Reservation</a>
                <li><a href="#"><i class="fas fa-address-book"></i>Data Entry</a></li>
                <li><a href="projectoruser.php"><i class="fas fa-cog"></i>File Maintenance</a></li>
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
    <div class="top-1">
        <img src="images/logo.png" alt="scaslogo">
        <h1>SCAS Projector Reservation System</h1>
    </div>
    <div class="top-2">
        <h2>Registered User</h2>
        <button class="add-user-btn"><a href="add-user.php">Add User</a> </button>
        <button class="viewprojector-btn"><a href="projector.php">View Projector</a> </button>
    </div>
    <div class="searchbox">
        <input type="text" placeholder="Search" id="search">
    </div>
    <div class="view-table">
        <table>
            <thead>
                <tr>
                    <th scope="col">User Id</th>
                    <th scope="col">Password</th>
                    <th scope="col">First name</th>
                    <th scope="col">Middle Initial</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Contact number</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody id="table">
                <?php
                $sql = "SELECT * FROM users";
                $result = $con->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $userid = $row['userid'];
                        $password = $row['password'];
                        $firstname = $row['firstname'];
                        $middleinitial = $row['middleinitial'];
                        $lastname = $row['lastname'];
                        $contactno = $row['contactno'];
                        $usertype = $row['usertype'];
                        echo '<tr>
                <td scope="row">' . $userid . '</td>
                <td scope="row">' . $password . '</td>
                <td scope="row">' . $firstname . '</td>
                <td scope="row">' . $middleinitial . '</td>
                <td scope="row">' . $lastname . '</td>
                <td scope="row">' . $contactno . '</td>
                <td scope="row">' . $usertype . '</td>
                <td scope="row">
                    <button class="update-btn"><a href="update-user.php?updateid=' . $userid . '">Update</a></button>
                    <button class="delete-btn"><a href="delete-user.php?deleteid=' . $userid . '">Delete</a></button>
                </tr>';
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="content">
        <dialog class="modal" id="modal">
            <h2>Strictly for admin only</h2>
            <button class="button close-button">close</button>
        </dialog>
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
<script src="app.js"></script>

</html>