<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="home.css">
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

          <a href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
      </ul>
    </nav>
  </div>
  <section class="change-section">
    <form action="" method="post">
      <h2>Change Password</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <?php if (isset($_GET['success'])) { ?>
        <p class="success"><?php echo $_GET['success']; ?></p>
      <?php } ?>
      <label class="labels">Old Password</label>
      <input class="inputs" type="password" name="op" placeholder="Old Password" id="opass" required>
      <i class="far fa-eye" id="togglePassword" style="  font-size:15px;
                border:none; background:#fff; cursor: pointer; margin-left: -30px; "></i>
      <br>

      <label class="labels">New Password</label>
      <input class="inputs" type="password" name="np" placeholder="New Password" id="npass" required>
      <i class="far fa-eye" id="togglePassword2" style="  font-size:15px;
                border:none; background:#fff; cursor: pointer; margin-left: -30px; "></i>
      <br>

      <label class="labels">Confirm New Password</label>
      <input class="inputs" type="password" name="c_np" placeholder="Confirm New Password" id="cnpass" required>
      <i class="far fa-eye" id="togglePassword3" style="  font-size:15px;
                border:none; background:#fff; cursor: pointer; margin-left: -30px; "></i>
      <br>

      <button class="btn" type="reset">RESET</button>
      <button class="btn" type="submit" name="change">CHANGE</button>
      <br><br><br><br><br>
    </form>
    </div>
    <?php
    include('database.php');

    if (!empty($_POST['np'])) {

      $_SESSION['userid'] = $user;
      $op = $_POST['op'];
      $np = $_POST['np'];
      $c_np = $_POST['c_np'];
      $user = $_POST['user'];

      $number = preg_match('@[0-9]@', $np);
      $uppercase = preg_match('@[A-Z]@', $np);
      $lowercase = preg_match('@[a-z]@', $np);

      if (strlen($np) < 8 || !$number || !$uppercase || !$lowercase) {
        header("Location: changepass.php?error=Password must be at least 8 characters in length and must contain at least one number, one upper case letter and one lower case letter.");
      } else if (empty($op)) {
        header("Location: changepass.php?error=Old Password is required");
        exit();
      } else if (empty($np)) {
        header("Location: changepass.php?error=New Password is required");
        exit();
      } else if ($np !== $c_np) {
        header("Location: changepass.php?error=The confirmation password  does not match");
        exit();
      } else {
        $query = "SELECT * from users WHERE password='$op'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        echo $count;
        if ($count > 0) {
          $query = "UPDATE users set password ='$np' WHERE password='$op'";
          mysqli_query($con, $query);
          header("Location: changepass.php?success=Your password has been changed successfully");
          exit();
        } else {
          header("Location: changepass.php?error=Old password does not matched");
          exit();
        }
      }
    }
    ?>
  </section>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword2 = document.querySelector('#togglePassword2');
    const togglePassword3 = document.querySelector('#togglePassword3');
    const opass = document.querySelector('#opass');
    const npass = document.querySelector('#npass');
    const cnpass = document.querySelector('#cnpass');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = opass.getAttribute('type') === 'password' ? 'text' : 'password';
      opass.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });

    togglePassword2.addEventListener('click', function(e) {
      // toggle the type attribute

      const type2 = npass.getAttribute('type') === 'password' ? 'text' : 'password';
      npass.setAttribute('type', type2);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
    togglePassword3.addEventListener('click', function(e) {
      // toggle the type attribute

      const type3 = cnpass.getAttribute('type') === 'password' ? 'text' : 'password';
      cnpass.setAttribute('type', type3);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>


</body>

</html>