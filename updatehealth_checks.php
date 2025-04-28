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
                            <h1>Update Health_Checks</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">children List</li>
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
                                    if(isset($_POST['update_hch'])){
                                        $id = $_POST['update_data'];
                                        $query = mysqli_query($conn,"SELECT * FROM `health_checks` WHERE `id` ='$id'");
                                        foreach($query as $row)
                                        { ?>

                                    <form Action="" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="update_data" id="update_data"
                                            value="<?php echo $row['id']?>">
                                       
                                       
                                            <div class="form-group">
                                            <label>Child</label>
                                            <select class="form-control" name="child_id" id="child_id">
                                         <option value="">Select Child</option>
                                             <?php
                                             $children = mysqli_query($conn, "SELECT * FROM children");
                                            while ($c = mysqli_fetch_assoc($children)) {
                                          $selected = ($c['id'] == $row['child_id']) ? 'selected' : '';
                                        echo "<option value='{$c['id']}' $selected>{$c['name']}</option>";
                                          }
                                         ?>
                                          </select>
                                   </div>
                                   <div class="form-group">
                                                <label>Doctor</label>
                                                <select name="doctor_id" id="doctor_id" class="form-control">
                                                 <option value="">Select Doctor</option>
                                                   <?php
                                              // Ensure connection is included
                                               $doctors = mysqli_query($conn, "SELECT do_id, do_Name FROM doctors ");
                                                while ($doctor = mysqli_fetch_assoc($doctors)) {
                                               $selected = ($doctor['do_id'] == $row['doctor_id']) ? "selected" : "";
                                               echo "<option value='{$doctor['do_id']}' $selected>{$doctor['do_Name']}</option>";
                                               }
                                                  ?>
                                                 </select>
                                               </div>
                                                 <div class="form-group">
                            <label>Check Date</label>
                            <input type="date" class="form-control" name="check_date" id="check_date" value="<?php echo $row['check_date']?>">
                             </div>

                             <div class="form-group">
                            <label>Notes</label>
                            <input  type="text" class="form-control" name="notes" id="notes" rows="4" placeholder="Enter any notes..." value="<?php echo $row['notes']?>">
                             </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="health_checks_list.php" class="btn btn-secondary" data-dismiss="modal">Back</a>
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
                $child_id = $_POST['child_id'];
                $doctor_id = $_POST['doctor_id'];
                $check_date = $_POST['check_date'];
                $notes = $_POST['notes'];

                    $queryUpdate = mysqli_query($conn, "UPDATE `health_checks` SET child_id ='$child_id', doctor_id='$doctor_id', check_date='$check_date',notes='$notes' WHERE id='$id' ");
                    if ($queryUpdate)
                    {
                        echo '<script>alert("Record Updated Successfully");</script>';
                        echo '<script>window.location.href="health_checks_list.php"</script>';

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