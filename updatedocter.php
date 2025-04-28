<!DOCTYPE html>
<html lang="en">
<?php 
include("src/conn.php");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maternal and Child Health System(MHCS)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
include("src/header.php")
?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <!-- ?php if ($_SESSION['role']== 'Admin'){?> -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Doctor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Doctor List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-10">


                            <div class="card ml-5">
                                <div class="card-body">
                                    <?php
                                    if(isset($_POST['update_d'])){
                                        $id = $_POST['update_data'];
                                        $query = mysqli_query($conn,"SELECT * FROM `doctors` WHERE `do_id` ='$id'");
                                        foreach($query as $row)
                                        { ?>

                                    <form Action="" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="update_data" id="update_data"
                                            value="<?php echo $row['do_id']?>">

                                            <div class="form-group">
                                             <label>Doctor</label>
                                               <input type="text" name="do_Name" id="do_Name" class="form-control"  value="<?php echo $row['do_Name']?>">
                                                </div>
                                            <div class="form-group">
                                            <label>Fee</label>
                                            <input type="text" name="fee" id="fee" class="form-control"  value="<?php echo $row['fee']?>">
                                           </div>
                                       
                                       
                                            <div class="form-group">
                                        <label>Select Specialization</label>
                                       <select name="sp_id" class="form-control" required>
                                       <option value="">Select Specialization</option>
                                            <?php
       
                                      $users = mysqli_query($conn, "SELECT sp_id, Name FROM specialization");
                                     while ($u = mysqli_fetch_assoc($users)) {
                                     $selected = ($u['sp_id'] == $row['sp_id']) ? 'selected' : '';
                                         echo "<option value='{$u['sp_id']}' $selected>{$u['Name']}</option>";
                                       }
                                        ?>
                                     </select>
                                      </div>
                                      <div class="form-group">
                                         <label>Mobile</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control"  value="<?php echo $row['mobile']?>">
                                        </div>
                                         <div class="form-group">
                                            <label>Address</label>
                                             <input type="text" class="form-control" name="address" id="address"  value="<?php echo $row['address']?>">
                                               </div>
                                    <div class="form-group">
                                     <label>Email</label>
                                  <div class="input-group">
                                   <div class="input-group-prepend">
                             <span class="input-group-text">@</span>
                                  </div>
                                  <input type="email" name="email" class="form-control" placeholder="Enter Email..." 
                                 value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
                                  </div>
                                  <div class="form-group">
                                           <label>Status</label>
                                           <select class="form-control" name="status" required>
                                         <option value="Verified" <?php if ($row['status'] == 'Verified') echo 'selected'; ?>>Verified</option>
                                            <option value="Unverified" <?php if ($row['status'] == 'Unverified') echo 'selected'; ?>>Unverified</option>
                                        
                                          </select>
                                            </div>
                  
                                </div>
                                <div class="modal-footer">
                                    <a href="doctor_list.php" class="btn btn-secondary" data-dismiss="modal">Back</a>
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                </div>
                                </form>

                                <?php }
                                    }
                                    ?>

                            </div>

                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <?php 
             if(isset($_POST['update']))
             {
                $id = $_POST['update_data'];
                $name = $_POST['do_Name'];
                $fee = $_POST['fee'];
                $sp_id = $_POST['sp_id'];
                $mobile = $_POST['mobile'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $status = $_POST['status'];

                    $queryUpdate = mysqli_query($conn, "UPDATE `doctors` SET do_Name ='$name', fee='$fee', sp_id='$sp_id', mobile='$mobile', address='$address', email='$email', status='$status' WHERE do_id='$id' ");
                    if ($queryUpdate)
                    {
                        echo '<script>alert("Record Updated Successfully");</script>';
                        echo '<script>window.location.href="doctor_list.php"</script>';

                    }
                    else
                    {
                        echo '<script>alert("Record Not Updated Successfully  '. mysqli_error($conn) . '");</script>';
                    }
                    
                } 
                ?>

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ?php }else if($_SESSION['role'] =='User'){

      echo '<script>window.location.href="attendance_list.php"</script>';
    
  }?> -->
        <!-- /.content-wrapper -->
        <!-- footer -->
        <?php
     include("src/footer.php");
     ?>
        <!-- end footer -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- Page specific script -->
    <script>
    //$(document).ready(function(){
    //$('#schadule_select').change(function(){
    //  var id = $(this).val();
    //   alert(id);
    //  });
    // });


    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>