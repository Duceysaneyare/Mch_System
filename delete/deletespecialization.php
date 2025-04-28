<?php
include("../src/conn.php");

if(isset($_POST['delete']))
{
    $id = $_POST['delete_id'];

    $deleteQry = mysqli_query($conn,"DELETE FROM specialization WHERE sp_id ='$id'");

    if($deleteQry)
    {
        echo '<script>alert("deleted Successfully");</script>';
        echo '<script>window.location.href="../specialization_list.php"</script>';
    }else

    {
        echo '<script>alert("Not deleted ");</script>';
    }
}