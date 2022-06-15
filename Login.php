<?php

include('database.php');

$result = mysqli_query($con, "SELECT * FROM users ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <div class="title">
        <div class="text"> <img src="logo.png" alt="" class="img"><span> SUMULONG COLLEGE OF ARTS AND SCIENCES</span></div>
        <h1>E-PROJECTOR RESERVATION SYSTEM</h1>
    </div>
    <br>

    <form action="Log.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?><br>
        <label class="labels">User ID</label>
        <input type="text" name="userid" placeholder="Enter user ID" required><br>

        <label class="labels">Password</label>
        <input type="password" name="pass" placeholder="Enter password" id="pass" required>
        <i class="far fa-eye" id="togglePassword" style="  font-size:15px;
                border:none; background:#fff; cursor: pointer; margin-left: -30px; "></i><br>
        <button class="btn" name="login">LOGIN</button>



    </form>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const pass = document.querySelector('#pass');
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
            pass.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>