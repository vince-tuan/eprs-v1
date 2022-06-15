<?php
session_start();
if (!isset($_SESSION['userid'])) {
  // header('location:home.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation</title>
  <link rel="stylesheet" href="dataentry.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
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

  <div class="container">
    <form action="insert.php" method="post">
      <h2>Reservation</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?><br>
      <input type="text" name="user_id" class="inputs " placeholder="USER ID"><br>
      User Type: <br><select name="usertype" class="inputs">
        <option value="Professor">Professor</option>
        <option value="Student">Student</option>
      </select><br>
      <input type="text" name="course_and_section" class="inputs" placeholder="Course & Section"><br>
      <input type="text" name="contact_num" class="inputs" placeholder="Contact No."><br>
      <input type="text" name="serial_num" class="inputs" placeholder="Serial No."><br>
      Date: <br>
      <input type="date" name="date" class="inputs"><br>
      Start time: <br>
      <input type="time" name="stime" class="inputs"><br>
      End time: <br>
      <input type="time" name="etime" class="inputs"><br>
      <input type="submit" value="Request" name="submit" class="btn"><br>
    </form>
  </div>
</body>

</html>

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