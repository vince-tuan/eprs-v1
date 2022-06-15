<?php
include 'database.php';
session_start();

if (!isset($_SESSION['userid'])) {
    // header('location:home.php');
}

$userid = $_GET['updateid'];
$sql = "SELECT password, firstname, middleinitial, lastname, contactno, usertype FROM users WHERE userid = $userid";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
$password = $row['password'];
$firstname = $row['firstname'];
$middleinitial = $row['middleinitial'];
$lastname = $row['lastname'];
$contactno = $row['contactno'];
$usertype = $row['usertype'];


if (isset($_POST['update-user'])) {
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $middleinitial = $_POST['middleinitial'];
    $lastname = $_POST['lastname'];
    $contactno = $_POST['contactno'];
    $usertype = $_POST['usertype'];


    $sql = "UPDATE users SET password = '$password', firstname = '$firstname', middleinitial = '$middleinitial', lastname = '$lastname', contactno = '$contactno', usertype = '$usertype' WHERE `userid` = $userid";
    $result = mysqli_query($con, $sql);

    if ($result == TRUE) {
        header("location: projectoruser.php");
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
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <title>Document</title>
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
            <h1>UPDATE USER</h1>
            <input type="password" class="textField" name="password" placeholder="Password" autocomplete="off" required value=<?php echo $password; ?>>
            <input type="text" class="textField" name="firstname" placeholder="First name" autocomplete="off" required value=<?php echo $firstname; ?>>
            <input type="text" class="textField" name="middleinitial" placeholder="Middle Initial" autocomplete="off" required value=<?php echo $middleinitial; ?>>
            <input type="text" class="textField" name="lastname" placeholder="Last name" autocomplete="off" required value=<?php echo $lastname; ?>>
            <input type="text" class="textField" name="contactno" placeholder="Contact Number" pattern="[0-9]{11}" autocomplete="off" required value=<?php echo $contactno; ?>>
            <label for="cars">Select User Type</label>
            <select class="textField" name="usertype" required value=<?php echo $usertype; ?>>
                <option value=" Admin">Admin</option>
                <option value="Professor">Professor</option>
                <option value="Student">Student</option>
            </select>
            <input type="submit" value="UPDATE USER" class="add-btn" name="update-user" autocomplete="off">
        </form>
        <button class="back-btn"><a href="projectoruser.php">Back to Users</a></button>
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