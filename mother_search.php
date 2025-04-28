

<!DOCTYPE html>
<?php
include("src/conn.php");

// // Hubi in user uu login yahay
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mother Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Styles -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include("src/header.php"); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Mother Search</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Search Mother by Name</label>
                            <input type="text" id="searchMother" class="form-control" placeholder="Enter mother name...">
                        </div>

                        <table id="motherTable" class="table table-bordered table-striped" style="display: none;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mother Name</th>
                                    <th>Date of Birth</th>
                                    <th>Address</th>
                                    <th>Blood Type</th>
                                    <th>Medical History</th>
                                    <th>Massage</th>
                                  
                                </tr>
                            </thead>
                            <tbody id="motherTableBody">
                                <!-- Results go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include("src/footer.php"); ?>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    $('#searchMother').on('keyup', function() {
        let search = $(this).val().trim();

        if (search !== '') {
            $.ajax({
                url: 'ajax/mother_search_result.php',
                method: 'POST',
                data: { search: search },
                success: function(response) {
                    $('#motherTableBody').html(response);
                    $('#motherTable').show();
                }
            });
        } else {
            $('#motherTable').hide();
        }
    });
});
</script>
</body>
</html>