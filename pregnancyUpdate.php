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
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'doctor') { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Pregnancy</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">pregnancy List</li>
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
                                    if(isset($_POST['update_per'])){
                                        $id = $_POST['update_data'];
                                        $query = mysqli_query($conn,"SELECT * FROM `pregnancies` WHERE `id` ='$id'");
                                        foreach($query as $row)
                                        { ?>

                                    <form Action="" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="update_data" id="update_data"
                                            value="<?php echo $row['id']?>">
                                       
                                       
                                              <div class="form-group">
                                             <label>Mother</label>
                                              <select name="mother_id" id="mother_id" class="form-control">
                                              <option value="">Select Mother</option>
                                              <?php
                                              $mothers = mysqli_query($conn, "SELECT id, mother_name FROM mothers");
                                              while ($mother = mysqli_fetch_assoc($mothers)) {
                                               $selected = ($mother['id'] == $row['mother_id']) ? "selected" : "";
                                              echo "<option value='{$mother['id']}' $selected>{$mother['mother_name']}</option>";
                                                }
                                                  ?>
                                                </select>
                                             </div>

                                             <div class="form-group">
                                           <label>Start Date</label>
                                           <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $row['start_date']?>" >
                                            </div>
                                              <div class="form-group">
                                              <label>Due Date</label>
                                             <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo $row['due_date']?>">
                                              </div>
                                              <div class="form-group">
                                                <label>Trimester</label>
                                                 <input type="number" name="trimester" id="trimester" class="form-control" min="1" max="3"  value="<?php echo $row['trimester']?>">
                                                          </div>
                                                   <div class="form-group">
                                                 <label>Notes</label>
                                                    <input  type="text" name="notes" id="notes" class="form-control" value="<?php echo $row['notes']?>">
                                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="pregnancy_list.php" class="btn btn-secondary" data-dismiss="modal">Back</a>
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
                $mother_id = $_POST['mother_id'];
                $start_date = $_POST['start_date'];
                $due_date = $_POST['due_date'];
                $trimester = $_POST['trimester'];
                $notes = $_POST['notes'];

                    $queryUpdate = mysqli_query($conn, "UPDATE `pregnancies` SET start_date ='$start_date', due_date='$due_date', trimester='$trimester',notes='$notes' WHERE id='$id' ");
                    if ($queryUpdate)
                    {
                        echo '<script>alert("Record Updated Successfully");</script>';
                        echo '<script>window.location.href="pregnancy_list.php"</script>';

                    }
                    else
                    {
                        echo '<script>alert("Record Not Updated Successfully ");</script>';
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
} else if (isset($_SESSION['User_name']) && $_SESSION['role'] == 'mother') {


echo '<script>window.location.href="mother_search.php"</script>';
    
  }?> 
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