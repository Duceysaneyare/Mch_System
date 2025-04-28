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
                            <h1>User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">User List</li>
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
                                    if(isset($_POST['update_user'])){
                                        $id = $_POST['update_data'];
                                        $query = mysqli_query($conn,"SELECT * FROM `users` WHERE `id` ='$id'");
                                        foreach($query as $row)
                                        { ?>

                                            <form Action="" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="id" id="id"
                                                    value="<?php echo $row['id']?>">
                                                    <div class="form-group">
                                                        <label for="userphoto">User Photo</label>
                                                        <input type="File" class="form-control-sm form-control"
                                                            name="user_photo" id="user_photo" aria-describedby="user_photo"
                                                            placeholder="Upload Photo">
                                                        <input type="hidden" name="user_photo_old" value="<?php echo $row['user_photo']?>">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name</label>
                                                        <input type="text" class="form-control-sm form-control"
                                                            name="name" id="name" value="<?php echo $row['name']?>" aria-describedby="full_name"
                                                            placeholder="Enter Full Name"  >

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user_name">user name</label>
                                                        <input type="text" class="form-control-sm form-control"
                                                            name="User_name" id="User_name" value="<?php echo $row['User_name']?>" aria-describedby="user_name"
                                                            placeholder="Enter UserName" >
                                                        <span id="CheckUser"></span>

                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control-sm form-control"
                                                            name="password" id="password" placeholder="Password"
                                                            >
                                                        <span id="pass"></span>
                                                        <input type="checkbox" onchange="SHPassword(this);"> <span
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

                                                    </div> -->

                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control form-control-sm">
                                                     <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                    <option value="mother" <?php echo ($row['role'] == 'mother') ? 'selected' : ''; ?>>Mother</option>
                                                    <option value="doctor" <?php echo ($row['role'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                                                 </select>
                                            </div>

                                            </div>
                                            <div class="modal-footer">
                                            <a href="users_list.php" class="btn btn-secondary" data-dismiss="modal">Back</a>
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
             $allowed =  array("png","jpg","jpeg","gif","PNG","JPG","JPEG","GIF","");
              $filename = $_FILES['user_photo']['name'];
               $EXT = pathinfo($filename, PATHINFO_EXTENSION);

               if(in_array($EXT, $allowed)){
                move_uploaded_file ($_FILES['user_photo']['tmp_name'],'img/'.$filename);
                if($filename == ""){
                    $path = $_POST['user_photo_old'];
                }else{
                    $path ='img/'.$filename;
                }
                //Variable from Input (update Data)
                    
                    $id = $_POST['id'];
                    $fullName = $_POST['name'];
                    $userName = $_POST['User_name'];
                    $role = $_POST['role'];
                    // $updated_at = date('Y-m-d');

                    $queryUpdate = mysqli_query($conn, "UPDATE `users` SET name ='$fullName', User_name='$userName',role='$role',user_photo='$path' WHERE id='$id' ");
                    if ($queryUpdate)
                    {
                        echo '<script>alert("Record Updated Successfully");</script>';
                        echo '<script>window.location.href="users_list.php"</script>';

                    }
                    else
                    {
                        echo '<script>alert("Record Not Updated Successfully '. mysqli_error($conn) . ' ");</script>';
                    }
                    
                } else 
                    {
                        echo $EXT."<script>alert('is not allowed pdf,docx, only use png, jpg, jpeg, gif');</script>";
                    }
             }
                ?>

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        <!-- </div>
        ?php }else if($_SESSION['role'] =='User'){

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
    <!-- <script>
    $(document).ready(function() {

        $("#user_name").keyup(function() {
            // alert('ok');
            var uname = $(this).val();
            $.ajax({
                url: 'usernameUpdateCheck.php',
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
    </script> -->
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