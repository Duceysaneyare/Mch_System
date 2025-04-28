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
        <?php if ($_SESSION['role'] == 'admin' ) { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage Specialization</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">specialization List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#savemodal">
                                        Add New
                                    </button>
                                    <?php
                                    include("src/conn.php");
                                    $readQry = mysqli_query($conn,"SELECT * FROM `specialization`");
                                    ?>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                            <th>Specialization</th>
                                            <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if($readQry)
                                        {
                                            foreach($readQry as $row)
                                            {
                                            
                                        
                                        ?>
                                            <tr>
                                            <td><?php echo $row['sp_id']; ?></td>
                                            <td><?php echo $row['Name']; ?></td>
                                            

                                            <td colspan="2">
                                                    <button type="button" class="btn btn-success editbtn"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger deletebtn"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>

                                                <!-- <td colspan="2">
                                                    <form action="EmployeeUpdate.php" method="post">
                                                        <input type="hidden" name="update_data"
                                                            value="?php echo $row['employee_id'] ?>">
                                                        <button type="submit" name="update_emp"
                                                            class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger deletebtn"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td> -->

                                            </tr>
                                            <?php }
                                        }
                                        else
                                        {
                                            echo "No Record Found!";
                                        } ?>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="modal fade" id="savemodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Specialization</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="insert/insertSpecialization.php" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                            <label>Specialization</label>
                                            <input class="form-control" name="Name" id="Name" required>
                                               </div>
                                             
                                            
                                                </div>
                                                <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" name="save" class="btn btn-primary">Save</button>
                                                  </div>
                                                   </div>
                                             </form>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <!-- /.update start -->
                                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Specialization</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form Action="update/updatespecialization.php" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="update_id" id="update_id">
                                                    <div class="form-group">
                                                      <label>Specialization</label>
                                                     <input class="form-control" name="Name" id="name" required>
                                                      </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="update"
                                                    class="btn btn-success">Update</button>
                                            </div>
                                            </form>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.update end -->

                                <!-- /.delete start -->
                                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Specialization Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form Action="delete/deletespecialization.php" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="delete_id" id="delete_id">

                                                    <h4>Do you want to delete this data?</h4>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <button type="submit" name="delete" class="btn btn-danger">Yes !! Delete
                                                    it</button>
                                            </div>
                                            </form>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.delete end -->
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        
        <!-- /.content-wrapper -->
        <!-- footer -->
        <?php
} else if (isset($_SESSION['User_name']) && $_SESSION['role'] == 'mother') {


echo '<script>window.location.href="mother_search.php"</script>';

} else if (isset($_SESSION['User_name']) && $_SESSION['role'] == 'doctor') {

  echo '<script>window.location.href="mother_list.php"</script>';
    
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

    <script>
  $(document).ready(function()
  {
    $('.editbtn').on('click', function()
    {
      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');
      
      var data = $tr.children('td').map(function()
      {
        return $(this).text();
      }).get();
    
      $('#update_id').val(data[0]);
      $('#name').val(data[1]);
      
      
      //alert(data[1]);
      console.log(data);
    });

    $('.deletebtn').on('click', function()
    {
      $('#deletemodal').modal('show');
      $tr = $(this).closest('tr');
      
      var data = $tr.children('td').map(function()
      {
        return $(this).text();
      }).get();
      $('#delete_id').val(data[0]);
      console.log(data);
    });


  });
</script>
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