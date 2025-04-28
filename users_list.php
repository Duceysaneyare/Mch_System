<!DOCTYPE html>
<html lang="en">

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
        <?php if ($_SESSION['role']== 'admin'){?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Users List</li>
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
                                    $readQry = mysqli_query($conn,"SELECT * FROM `users`");
                                    ?>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User_ID</th>
                                                <th>User_photo</th>
                                                <th>full_name</th>
                                                <th>User_name</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Created_at</th>
                                                <th>Massage</th>
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
                                                <td>
                                              <img src="<?php echo $row['user_photo'] ?>" height="50px"
                                               width="50px" alt="" class="img-circle">
                                                </td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['User_name'] ?></td>
                                                <td><?php echo $row['password'] ?></td>
                                                <td><?php echo $row['role'] ?></td>
                                                <td><?php echo $row['created_at'] ?></td>
                                                <td><?php echo $row['Massage'] ?></td>



                                                <td colspan="2">
                                                    <form action="userUpdate.php" method="post">
                                                        <input type="hidden" name="update_data"
                                                            value="<?php echo $row['id'] ?>">
                                                        <button type="submit" name="update_user"
                                                            class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger deletebtn"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
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
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="savemodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form Action="insert/insertuser.php" method="post"
                                                    enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="userphoto">User Photo</label>
                                                        <input type="File" class="form-control-sm form-control"
                                                            name="user_photo" id="userphoto" aria-describedby="userphoto"
                                                            placeholder="Upload Photo">

                                                    </div>
                                            
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name</label>
                                                        <input type="text" class="form-control-sm form-control"
                                                            name="name" id="name" aria-describedby="full_name"
                                                            placeholder="Enter Full Name" required="required" />

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user_name">user name</label>
                                                        <input type="text" class="form-control-sm form-control"
                                                            name="User_name" id="user_name" aria-describedby="user_name"
                                                            placeholder="Enter UserName" required="required" />
                                                        <span id="CheckUser"></span>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control-sm form-control"
                                                            name="password" id="password" placeholder="Password"
                                                            required="required" />
                                                        <span id="pass"></span>
                                                        <input type="checkbox" onchange="SHPassword(this);"><span
                                                            id="passEye">Show</span>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="confirm Password">Confirm Password</label>
                                                        <input type="password" class="form-control-sm form-control"
                                                            name="confirm" id="confirm" placeholder="Confirm Password"
                                                            required="required" />
                                                        <span id="passConfirm"></span>
                                                        <input type="checkbox" onchange="SHpassword(this);"><span
                                                            id="passeye"> Show</span>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="confirm Password">Role</label>
                                                        <select name="role" id="role"
                                                            class="form-control form-control-sm form-control" required>
                                                            <option value="">Select Role</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Mother">Mother</option>

                                                        </select>

                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="save" id="userID"
                                                    class="btn btn-primary">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.delete start -->
                                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete User Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form Action="delete/deleteUser.php" method="post"
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
        <!-- ?php }else if($_SESSION['role'] =='User'){

      echo '<script>window.location.href="attendance_list.php"</script>';
    
  }?> -->
        <!-- /.content-wrapper -->
        <!-- footer -->
        <<?php
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

    <!-- Page specific script -->
    <script>
//   $(document).ready(function()
//   {
//     $('.editbtn').on('click', function()
//     {
//       $('#editmodal').modal('show');

//       $tr = $(this).closest('tr');
      
//       var data = $tr.children('td').map(function()
//       {
//         return $(this).text();
//       }).get();
    
//       $('#update_id').val(data[0]);
//       $('#Department').val(data[1]);
      
//       //alert(data[1]);
//       console.log(data);
//     });

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


//   });
</script>
    <script>
    $(document).ready(function() {

        $("#confirm").keyup(function() {
            var passtwo = $("#password").val();
            var confPass = $(this).val();

            if (confPass == "") {
                $('#passConfirm').html("<span></span>");
            } else if (passtwo != confPass) {
                $("#passConfirm").html(
                    "<span class= 'badge badge-danger'><b>password misMatch </b></span>");
                $("#userID").prop("disabled", true);
            } else {
                $("#passConfirm").html(
                    "<span class= 'badge badge-success'><b>password Matched </b></span>");
                $("#userID").prop("disabled", false);
            }
        });


        $("#password").keyup(function() {
            var passOne = $(this).val();

            if (passOne == "") {
                $('#pass').html("<span></span>");
            } else if (passOne.length >= 1 && passOne.length <= 5) {
                $('#pass').html(
                    "<span class= 'badge badge-danger'><b>password is very weeek </b></span>");
            } else if (passOne.length >= 6 && passOne.length <= 10) {
                $('#pass').html(
                    "<span class= 'badge badge-primary'><b>password is very medium </b></span>");
            } else {
                $('#pass').html(
                    "<span class= 'badge badge-success'><b>password is very strong </b></span>");
            }
        });



        $("#user_name").keyup(function() {
            // alert('ok');
            var uname = $(this).val();
            $.ajax({
                url: 'usernameCheck.php',
                method: 'POST',
                data: {
                    user_name: uname
                },
                datatype: "text",
                success: function(res) {
                    $("#CheckUser").html(res);
                }
            });
        });
    });
    </script>
    <script>
    function SHPassword(x) {
        var checkbox = x.checked;
        if (checkbox) {
            document.getElementById("password").type = "text";
            document.getElementById("passEye").textcontent = "Hide";
        } else {
            document.getElementById("password").type = "password";
            document.getElementById("passEye").textcontent = "Show";
        }
    }

    function SHpassword(x) {
        var checkbox = x.checked;
        if (checkbox) {
            document.getElementById("confirm").type = "text";
            document.getElementById("passeye").textcontent = "Hide";
        } else {
            document.getElementById("confirm").type = "password";
            document.getElementById("passeye").textcontent = "Show";
        }
    }
    </script>

    <script>
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