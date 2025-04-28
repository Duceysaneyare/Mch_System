<?php
include("../src/conn.php");

if(isset($_POST['delete']))
{
    $id = $_POST['delete_id'];

    $deleteQry = mysqli_query($conn,"DELETE FROM health_checks WHERE id ='$id'");

    if($deleteQry)
    {
        echo '<script>alert("deleted Successfully");</script>';
        echo '<script>window.location.href="../health_checks_list.php"</script>';
    }else

    {
        echo '<script>alert("Not deleted ");</script>';
    }
}