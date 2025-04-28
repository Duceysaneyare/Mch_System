<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>MCH</b></a>
    </div>
    <div class="card-body">
      <div id="alert-container"></div> <!-- Bootstrap alert container -->

      <p class="login-box-msg">Change your password now.</p>
      <form action="#" method="post">
        <div class="input-group ">
          <input type="text" class="form-control" name="User_name" id="User_name" placeholder="UserName" value="<?php echo $_SESSION['User_name'] ?>" readonly>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mt-2">
          <input type="password" class="form-control" name="Currentpass" id="Currentpass" placeholder="Current Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>&nbsp;
              <input type="checkbox" onchange="SHPassword(this);"> <span id="passCurrent"> Show</span>
            </div>
          </div>
        </div>
        <div class="input-group mt-2">
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>&nbsp;
              <input type="checkbox" onchange="SHowpassword(this);"><span id="passEye"> Show</span>
            </div>
          </div>
        </div>
        <span id="pass"></span>
        <div class="input-group mt-2">
          <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>&nbsp;
              <input type="checkbox" onchange="SHpassword(this);"><span id="Confirmpass"> Show</span>  
            </div>
          </div>
        </div>
        <span id="passConfirm"></span>

        <div class="row mt-2 ">
          <div class="col-6">
            <a href="Dashboard.php" class="btn btn-outline-danger btn-block"><i class="fas fa-solid fa-arrow-circle-left"></i> Back</a>
          </div>
          <div class="col-6">
            <button type="submit" name="change" id="change" class="btn btn-primary btn-block">Change password</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
include("src/conn.php");
if (isset($_POST['change'])){
  $userName = mysqli_real_escape_string($conn, $_POST['User_name']);
  $Current_pass = mysqli_real_escape_string($conn, $_POST['Currentpass']);
  $new_password = mysqli_real_escape_string($conn, $_POST['password']);

  $checkQry = "SELECT * FROM users WHERE User_name = '".$userName."' AND password ='".$Current_pass."' ";
  $query = mysqli_query($conn, $checkQry);
  $countRows = mysqli_num_rows($query);
  
  if ($countRows > 0) {
    $updateQry = "UPDATE users SET password ='".$new_password."' WHERE User_name = '".$userName."' ";
    $qry = mysqli_query($conn, $updateQry);

    if ($qry) {
      echo "<script>showAlert('Your password has been changed.', 'success');</script>";
    }
    echo '<script>window.location.href="logout.php"</script>';
  } else {
    echo '<script>showAlert("Current password is incorrect.", "danger");</script>';
  }
}
?>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
function SHPassword(x) {
    var checkbox = x.checked;
    if (checkbox) {
        document.getElementById("Currentpass").type = "text";
        document.getElementById("passCurrent").textContent = "Hide";
    } else {
        document.getElementById("Currentpass").type = "password";
        document.getElementById("passCurrent").textContent = "Show";
    }
}

function SHowpassword(x) {
    var checkbox = x.checked;
    if (checkbox) {
        document.getElementById("password").type = "text";
        document.getElementById("passEye").textContent = "Hide";
    } else {
        document.getElementById("password").type = "password";
        document.getElementById("passEye").textContent = "Show";
    }
}

function SHpassword(x) {
    var checkbox = x.checked;
    if (checkbox) {
        document.getElementById("confirm").type = "text";
        document.getElementById("Confirmpass").textContent = "Hide";
    } else {
        document.getElementById("confirm").type = "password";
        document.getElementById("Confirmpass").textContent = "Show";
    }
}

function showAlert(message, type) {
    $('#alert-container').html('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' + 
        message + 
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>');
}

$(document).ready(function() {
    $("#confirm").keyup(function() {
        var passtwo = $("#password").val();
        var confPass = $(this).val();

        if (confPass == "") {
            $('#passConfirm').html("<span></span>");
        } else if (passtwo != confPass) {
            $("#passConfirm").html("<span class='badge badge-danger'><b>password mismatch</b></span>");
            $("#change").prop("disabled", true);
        } else {
            $("#passConfirm").html("<span class='badge badge-success'><b>password matched</b></span>");
            $("#change").prop("disabled", false);
        }
    });

    $("#password").keyup(function() {
        var passOne = $(this).val();

        if (passOne == "") {
            $('#pass').html("<span></span>");
        } else if (passOne.length >= 1 && passOne.length <= 5) {
            $('#pass').html("<span class='badge badge-danger'><b>password is very weak</b></span>");
        } else if (passOne.length >= 6 && passOne.length <= 10) {
            $('#pass').html("<span class='badge badge-primary'><b>password is medium</b></span>");
        } else {
            $('#pass').html("<span class='badge badge-success'><b>password is strong</b></span>");
        }
    });
});
</script>
</body>
</html>