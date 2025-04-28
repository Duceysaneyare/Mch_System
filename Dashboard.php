<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maternal and Child Health System (MHCS)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  
<?php
include("src/header.php")
?>
  <!-- Content Wrapper. Contains page content -->
  <?php if ($_SESSION['role']== 'admin'){?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `mothers`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Mothers</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-female"></i>
              </div>
              <a href="mother_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `children`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Children</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-child"></i>
              </div>
              <a href="children_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `doctors`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Doctors</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-user-md"></i> <!-- Changed to doctor icon -->
              </div>
              <a href="doctor_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `users`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Users</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-users"></i> <!-- Changed to users icon -->
              </div>
              <a href="users_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `appointments`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Appointments</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-calendar-check"></i> <!-- Changed to calendar check icon -->
              </div>
              <a href="appointments_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `growth_records`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Growth Records</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-chart-line"></i> <!-- Changed to chart line icon -->
              </div>
              <a href="growth_records_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `maternal_health_records`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Maternal Health Records</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-heartbeat"></i>
              </div>
              <a href="maternal_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php
                  include("src/conn.php");
                  $read = mysqli_query($conn,"SELECT COUNT(*) FROM `vaccinations`");
                  while($array = mysqli_fetch_row($read)){  
                   echo $array[0];
                  }
                ?></h3>
                <p>All Vaccinations</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-syringe"></i>
              </div>
              <a href="vaccinations_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
} else if (isset($_SESSION['User_name']) && $_SESSION['role'] == 'mother') {
  echo '<script>window.location.href="mother_search.php"</script>';
} else if (isset($_SESSION['User_name']) && $_SESSION['role'] == 'doctor') {
  echo '<script>window.location.href="mother_list.php"</script>';
}?> 

  <!-- /.content-wrapper -->
 <?php
 include("src/footer.php");
 ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>