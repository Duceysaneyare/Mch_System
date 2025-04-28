<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-color: #ff95fb">
<div class="login-box" style="width: 500px;">
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>MCH</b> SYSTEM</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <!-- Alert div positioned above the form -->
      <div id="alert" class="alert" style="display: none;"></div>

      <form action="" method="post">
        <div class="input-group mb-4">
          <input type="text" name="username" id="username" class="form-control" placeholder="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>&nbsp;
              <input type="checkbox" onchange="SHPassword(this);">
              <span id="passEye"> Show</span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember"> Remember Me </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

      <?php
      include("src/conn.php");
      if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $login = mysqli_query($conn,"SELECT * FROM users WHERE User_name ='$username' AND password ='$password'");
        $countResult = mysqli_num_rows($login);
        $result = mysqli_fetch_array($login);
        if ($countResult > 0){
          $_SESSION['id']= $result[0];
          $_SESSION['name']= $result[1];
          $_SESSION['User_name']= $result[2];
          $_SESSION['password']= $result[3];
          $_SESSION['role']= $result[4];
          $_SESSION['user_photo']= $result[5];

          echo '<script>document.getElementById("alert").className = "alert alert-success"; document.getElementById("alert").innerHTML = "Login Successfully"; document.getElementById("alert").style.display = "block"; setTimeout(function(){ window.location.href="Dashboard.php"; }, 2000);</script>';

        } else {
          echo '<script>document.getElementById("alert").className = "alert alert-danger"; document.getElementById("alert").innerHTML = "Invalid Username or Password, Please try again"; document.getElementById("alert").style.display = "block";</script>';
        }
      }
      ?>

    </div>
  </div>
</div>

<script>
    function SHPassword(x) {
        var checkbox = x.checked;
        if (checkbox) {
            document.getElementById("password").type = "text";
            document.getElementById("passEye").textContent = "Hide";
        } else {
            document.getElementById("password").type = "password";
            document.getElementById("passEye").textContent = "Show";
        }
    }
</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>