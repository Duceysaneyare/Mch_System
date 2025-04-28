<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maternal and Child Health System(MHCS)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
            <h1>Manage Maternal Health</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">maternal health records List</li>
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
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#savemodal">
               Add New 
               </button>
               <?php
               include("src/conn.php");
               $readQry = mysqli_query($conn, "SELECT * FROM maternal_health_records");
               ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>ID</th>
                  <th>Pregnancy ID</th>
                  <th>Checkup Date</th>
                  <th>Blood Pressure</th>
                  <th>Weight</th>
                  <th>Blood Sugar</th>
                  <th>Ultrasound</th>
                  <th>Notes</th>
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
                    <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['pregnancy_id']?></td>
                        <td><?php echo $row['checkup_date']?></td>
                        <td><?php echo $row['blood_pressure']?></td>
                        <td><?php echo $row['weight']?></td>
                        <td><?php echo $row['blood_sugar']?></td>
                        <td><?php echo $row['ultrasound_report']?></td>
                        <td><?php echo $row['notes']?></td>
                    <td colspan="2">
                      <button type="button" class="btn btn-success editbtn"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger deletebtn"><i class="fa fa-trash"></i></button>
                    </td>
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
              <!-- /.save start -->
              <div class="modal fade" id="savemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Maternal </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
              <form Action="insert/insertmaternal.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Pregnancy ID</label>
                        <input type="number" name="pregnancy_id" id="pregnancy_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Checkup Date</label>
                        <input type="date" name="checkup_date" id="checkup_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Blood Pressure</label>
                        <input type="text" name="blood_pressure"  id="blood_pressure" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" step="0.01" name="weight" id="weight" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Blood Sugar</label>
                        <input type="number" step="0.01" name="blood_sugar" id="blood_sugar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ultrasound Report</label>
                        <textarea name="ultrasound_report" id="ultrasound_report" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                      </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="save" class="btn btn-primary">Save</button>
            </div>
            </form> 
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.save end -->

        <!-- /.update start -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Maternal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
              <form Action="update/updatematernal.php" method="post"
               enctype="multipart/form-data">
               <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                        <label>Pregnancy ID</label>
                        <input type="number" name="pregnancy_id" id="pregnancyid" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Checkup Date</label>
                        <input type="date" name="checkup_date" id="checkupdate" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Blood Pressure</label>
                        <input type="text" name="blood_pressure" id="bloodpressure" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" step="0.01" name="weight" id="weights" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Blood Sugar</label>
                        <input type="number" step="0.01" name="blood_sugar" id="bloodsugar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ultrasound Report</label>
                        <textarea name="ultrasound_report" id="ultrasoundreport" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" id="note" class="form-control"></textarea>
                    </div>
         
                    </div>
                     <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="update" class="btn btn-success">Update</button>
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
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Maternal Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
              <form Action="delete/deletematernal.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="delete_id" id="delete_id"> 

                <h4>Do you want to delete this data?</h4>
         
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" name="delete" class="btn btn-danger">Yes !! Delete it</button>
            </div>
            </form> 
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div> 
          <!-- /.col -->
        </div>
        <!-- /.delete end -->
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
      $('#pregnancyid').val(data[1]);
      $('#checkupdate').val(data[2]);
      $('#bloodpressure').val(data[3]);
      $('#weights').val(data[4]);
      $('#bloodsugar').val(data[5]);
      $('#ultrasoundreport').val(data[6]);
      $('#note').val(data[7]);
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
